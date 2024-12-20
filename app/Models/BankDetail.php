<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BankDetail extends Model
{
    protected $fillable =
    [
        "bank_name",
        "bank_logo",
        "account_holder",
        "account_number",
        "account_type",
        "currency",
        "branch_code",
        "swift_code",
        "iban",
        "reference",
    ];
}