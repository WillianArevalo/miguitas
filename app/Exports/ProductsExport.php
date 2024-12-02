<?php

namespace App\Exports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\FromCollection;

class ProductsExport implements FromCollection
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Product::all();
    }

    public function query()
    {
        return Product::query()->select(
            "id",
            "name",
            "price",
            "stock",
            "short_description",
            "long_description",
            "is_active",
            "is_top"
        );
    }

    public function headings(): array
    {
        return [
            "ID",
            "Name",
            "Price",
            "Stock",
            "Short Description",
            "Long Description",
            "Activo",
            "Top"
        ];
    }
}
