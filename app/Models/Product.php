<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class Product extends Model
{
    use HasFactory;
    protected $table = 'product';
    protected $guarded = [];
    public $timestamps = true;
    protected $perPage = 5;

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function scopeId($query, $request){
        if($request->id){
            $query->where('id', $request->id);
        }
        return $query;
    }
}
