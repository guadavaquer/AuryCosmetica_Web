<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostalCodePrice extends Model
{
    use HasFactory;
    protected $fillable = [
        'from_postal_code',
        'to_postal_code',
        'price'
    ];
}
