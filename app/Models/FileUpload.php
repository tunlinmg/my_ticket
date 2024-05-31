<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FileUpload extends Model
{
    use HasFactory;

    protected $fillable = [
        'file_name',
        'product_id',
    ];

    // Define the inverse relationship with Product
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
