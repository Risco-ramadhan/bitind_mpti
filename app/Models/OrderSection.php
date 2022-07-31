<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderSection extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'userid',
        'id_product',
        'domain','color1',
        'color2','color3',
        'url_reference',
        'image_reference',
        'bussiness_name',
        'description_detail'
    ];
}
