<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductsModel extends Model
{
    use HasFactory;
    protected $guarded=['id'];
    function rel_to_category(){
        return $this->belongsTo(CategoryModel::class,'category_id');

    }
    function rel_to_inventories(){
        return $this->hasMany(Inventory::class,'product_id');

    }
    
}
