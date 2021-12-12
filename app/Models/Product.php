<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Database\Eloquent\SoftDeletes; // add soft delete

class Product extends Model
{
    use SoftDeletes;// add soft delete
    use HasFactory;
    protected $table = 'product';
    protected $guarded = [];
    public $timestamps = true;
    protected $perPage = 9;

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function comments()
    {
        return $this->hasMany(Comments::class);
    }

    public function scopeId($query, $request){
        if($request->id){
            $query->where('id', $request->id)->onlyTrashed();
        }
        return $query;
    }
}
