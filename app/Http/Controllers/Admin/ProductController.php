<?php

namespace App\Http\Controllers\Admin;

use App\Exports\ProductsExport;
use App\Http\Controllers\Controller;
use App\Helpers\ImageHelper;
use App\Http\Requests\ProductEditRequest;
use App\Http\Requests\ProductRequest;
use App\Imports\ProductImport;
use App\Models\Categorie;
use App\Models\Label;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\ProductOption;
use App\Models\ProductOptionValue;
use App\Models\SubCategorie;
use App\Models\Tax;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with(['categories', 'subcategories', 'taxes', 'labels', 'images'])->paginate(20);
        $count = Product::count();
        $categories = Categorie::all();
        return view('admin.products.index', compact('products', 'count', 'categories'));
    }

    public function create()
    {
        $categories = Categorie::all();
        $taxes = Tax::all();
        $labels = Label::all();
        $options = ProductOption::with('values')->get();

        return view('admin.products.create', compact('categories', 'taxes', 'labels', 'options'));
    }

    public function store(ProductRequest $request)
    {
        DB::beginTransaction();
        try {
            $validated = $request->validated();
            $validated['offer_active'] = $request->has('offer_active') ? 1 : 0;
            $validated['is_active'] = $request->has('is_active') ? 1 : 0;
            $validated['is_the_month'] = $request->has('is_the_month') ? 1 : 0;
            $product = Product::create($validated);

            $optionsValues = $request->input('options');

            if ($optionsValues !== null) {
                $optionsValues = array_map(function ($option) {
                    return json_decode($option, true);
                }, $optionsValues);

                foreach ($optionsValues as $option) {
                    $createdOption =
                        ProductOptionValue::create([
                            "product_option_id" => $option["option_id"],
                            "value" => $option["value"]
                        ]);

                    $options[] = [
                        "product_option_value_id" => $createdOption->id,
                        "stock" => $option["stock"],
                        "price" => $option["price"]
                    ];
                }
                $product->options()->attach($options);
            }

            if ($request->has('subcategories')) {
                $product->subcategories()->attach($request->subcategories);
            }

            $folderPath = $this->getProductImageFolder($request->input('name'));
            $this->handleImages($request, $product, $folderPath);
            $this->syncTaxesAndLabels($request, $product);
            DB::commit();
            return response()->json(['success' => 'Producto creado correctamente', "redirect" => route('admin.products.index')]);
        } catch (\Exception $e) {
            DB::rollBack();
            dd($e->getMessage());
            return response()->json(['error' => 'Error al crear el producto', 'message' => $e->getMessage()]);
        }
    }

    public function show(string $id)
    {
        $product = Product::with(['categories', 'taxes', 'labels', 'reviews', 'options.option'])->findOrFail($id);
        $nextProduct = Product::where('id', '>', $id)->first();
        $previousProduct = Product::where('id', '<', $id)->first();

        return view('admin.products.show', compact('product', 'nextProduct', 'previousProduct'));
    }

    public function destroy(string $id)
    {
        DB::beginTransaction();
        try {
            $product = Product::findOrFail($id);
            $images = ProductImage::where('product_id', $id)->get();

            if ($product->main_image) {
                ImageHelper::deleteImage($product->main_image);
            }

            foreach ($images as $image) {
                ImageHelper::deleteImage($image->image);
            }

            ImageHelper::deleteDirectory($this->getProductImageFolder($product->name));

            $product->delete();
            DB::commit();
            return redirect()->route('admin.products.index')->with('success', 'Producto eliminado correctamente');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('admin.products.index')->with('error', 'Error al eliminar el producto');
        }
    }

    public function deleteSelected(Request $request)
    {
        DB::beginTransaction();
        try {
            $products = Product::whereIn('id', $request->input('products_ids'))->get();
            $isArray = is_array($request->input('products_ids'));

            if (!$isArray) {
                $products = [$products];
            }

            foreach ($products as $product) {
                $images = ProductImage::where('product_id', $product->id)->get();

                if ($product->main_image) {
                    ImageHelper::deleteImage($product->main_image);
                }

                foreach ($images as $image) {
                    ImageHelper::deleteImage($image->image);
                }

                ImageHelper::deleteDirectory($this->getProductImageFolder($product->name));
            }

            Product::whereIn('id', $request->input('products_ids'))->delete();
            DB::commit();
            return redirect()->route('admin.products.index')->with('success', 'Productos eliminados correctamente');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('admin.products.index')->with('error', 'Error al eliminar los productos');
        }
    }

    public function edit(string $id)
    {
        $product = Product::with(['categories', 'taxes', 'labels', 'images', 'options.option'])->findOrFail($id);
        $categories = Categorie::all();
        $taxes = Tax::all();
        $labels = Label::all();
        $options = ProductOption::with('values')->get();
        $subcategories = SubCategorie::where('categorie_id', $product->categorie_id)->get();
        return view('admin.products.edit', compact('product', 'categories', 'taxes', 'labels', 'options', 'subcategories'));
    }

    public function update(ProductEditRequest $request, string $id)
    {
        DB::beginTransaction();
        try {
            $product = Product::findOrFail($id);
            $validated = $request->validated();
            $validated['offer_active'] = $request->has('offer_active') ? 1 : 0;
            $validated['is_active'] = $request->has('is_active') ? 1 : 0;
            $validated['is_top'] = $request->has('is_top') ? 1 : 0;
            $validated['is_the_month'] = $request->has('is_the_month') ? 1 : 0;

            $currentFolderPath = $this->getProductImageFolder($request->input("name"));
            $newFolderPath = $this->getProductImageFolder($request->input('name'), $product->created_at);

            if ($currentFolderPath !== $newFolderPath) {
                $this->moveProductImages($request, $product, $currentFolderPath, $newFolderPath);
            }

            $product->update($validated);
            $this->syncTaxesAndLabels($request, $product);
            $this->handleImages($request, $product, $newFolderPath);

            if ($request->has('subcategories')) {
                $product->subcategories()->sync($request->subcategories);
            }

            DB::commit();
            return response()->json([
                'success' => 'Producto actualizado correctamente',
                "redirect" => route('admin.products.index')
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'error' => 'Error al actualizar el producto'
            ]);
        }
    }

    private function syncTaxesAndLabels(Request $request, Product $product)
    {
        if ($request->has('tax_id')) {
            $product->taxes()->sync($request->input('tax_id'));
        }

        if ($request->has('labels')) {
            $labelIds = array_map(function ($labelName) {
                return Label::firstOrCreate(['name' => $labelName])->id;
            }, $request->input('labels'));
            $product->labels()->sync($labelIds);
        }
    }

    private function handleImages(Request $request, Product $product, $folderPath = null)
    {
        $folderPath = $folderPath ?? $this->getProductImageFolder($product);

        if ($request->hasFile('main_image')) {
            if ($product->main_image) {
                ImageHelper::deleteImage($product->main_image);
            }
            $product->update(['main_image' => ImageHelper::saveImage($request->file('main_image'), $folderPath)]);
        }

        if ($request->hasFile('gallery_image')) {
            $this->saveGalleryImages($request->file('gallery_image'), $product, $folderPath);
        }
    }

    private function saveGalleryImages($galleryImages, Product $product, $folderPath)
    {
        $existingImages = $product->images;
        foreach ($existingImages as $image) {
            ImageHelper::deleteImage($image->image);
            $image->delete();
        }

        $imagesPaths = array_map(function ($image) use ($folderPath, $product) {
            return ['image' => ImageHelper::saveImage($image, $folderPath), 'product_id' => $product->id];
        }, $galleryImages);

        $product->images()->createMany($imagesPaths);
    }

    private function moveProductImages(Request $request, Product $product, $currentFolderPath, $newFolderPath)
    {
        Storage::makeDirectory("public/$newFolderPath");

        if (!$request->hasFile('main_image')) {
            $mainImageFileName = basename($product->main_image);
            Storage::move("public/$currentFolderPath/$mainImageFileName", "public/$newFolderPath/$mainImageFileName");
            $product->update(['main_image' => "$newFolderPath/$mainImageFileName"]);
        }

        if (!$request->hasFile('gallery_image')) {
            foreach ($product->images as $image) {
                $imageFileName = basename($image->image);
                Storage::move("public/$image->image", "public/$newFolderPath/$imageFileName");
                $image->update(['image' => "$newFolderPath/$imageFileName"]);
            }
        }

        Storage::deleteDirectory("public/$currentFolderPath");
    }

    private function getProductImageFolder($name, $createdAt = null)
    {
        return 'images/products/' . Str::slug($name);
    }

    public function import(Request $request)
    {
        // Obtén el archivo CSV del request
        $file = $request->file('document');

        // Abre el archivo en modo de solo lectura
        if (($handle = fopen($file->getRealPath(), 'r')) !== false) {
            // Lee la primera fila para ignorar los encabezados
            $header = fgetcsv($handle, 1000, ',');

            // Recorre cada fila del CSV
            while (($data = fgetcsv($handle, 1000, ',')) !== false) {
                // Mapea los datos del CSV a los campos de la base de datos

                $productData = [
                    'name' => $data[0],
                    'is_active' => (bool) $data[1],
                    'is_top' => (bool) $data[2],
                    'short_description' => $data[3],
                    'long_description' => $data[4],
                    'stock' => (int) $data[5] ?? 0,
                    'price' => (float) $data[6] ?? 0,
                    'main_image' => $data[7] ?? 'default.jpg',
                    'sku' => "XXXX",
                    'categorie_id' => 1,
                ];

                // Crea un nuevo producto en la base de datos
                Product::create($productData);
            }

            // Cierra el archivo
            fclose($handle);

            return response()->json(['success' => 'Productos importados correctamente.'], 200);
        }

        return response()->json(['error' => 'No se pudo abrir el archivo CSV.'], 500);
    }

    public function export()
    {
        try {
            $fileName = "productos_" . now()->format('Y-m-d H-i-s') . ".xlsx";
            return Excel::download(new ProductsExport, $fileName);
        } catch (\Exception $e) {
            return redirect()->route('admin.products.index')->with('error', 'Error al exportar los productos');
        }
    }

    public function deleteImage(string $id)
    {
        DB::beginTransaction();
        $image = ProductImage::findOrFail($id);
        $product = $image->product;
        try {
            ImageHelper::deleteImage($image->image);
            $image->delete();
            DB::commit();
            return response()->json(['success' => 'Imagen eliminada correctamente']);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => 'Error al eliminar la imagen']);
        }
    }

    public function search(Request $request)
    {
        $query = Product::query();

        if ($search = $request->input("inputSearch")) {
            $query->where("name", "like", "%$search%");
        }

        $products = $query->get();

        if ($request->ajax()) {
            return view("layouts.__partials.ajax.admin.product.row-product", compact("products"))->render();
        }
    }
}
