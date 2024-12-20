<?php

namespace Database\Seeders;

use App\Models\BankDetail;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BankDetailsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        BankDetail::create([
            "bank_name" => "Banco Agrícola",
            "account_number" => "123456789",
            "account_holder" => "Miguitas",
            "account_type" => "savings",
            "currency" => "USD",
        ]);
    }
}