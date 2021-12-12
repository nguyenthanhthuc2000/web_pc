<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class Order extends Model
{
    use HasFactory;
    protected $table = 'order';
    protected $guarded = [];
    public $timestamps = true;
    protected $perPage = 5;

    public function scopeOrderCode($query, $request){
        if($request->order_code){
            $query->where('order_code', $request->order_code);
        }
        return $query;
    }
}
