<?php

namespace App\Imports;

use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ProductImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        DB::beginTransaction();
        try {
            $product =  new Product([
                'name' => $row["name"] ?? 'Product Name',
                'is_active' => $row["is_active"],
                'is_top' => $row["is_top"],
                'short_description' => $row["short_description"],
                'long_description' => $row["long_description"],
                'stock' => $row["stock"] ?? 0,
                'price' => $row["price"] ?? 0,
                'main_image' => $row["main_image"] ?? 'default.jpg',
                'sku' => $row["sku"] ?? 'XXXX',
                'categorie_id' => 3,
            ]);
            $product->save();
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return null;
        }
    }
}
