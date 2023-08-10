<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;


class CategoryModel extends Model
{
    use SoftDeletes;
    use HasFactory;

    protected $guarded=['id'];
    function rel_to_user(){
        return $this->belongsTo(User::class,'added_by');

    }
}
