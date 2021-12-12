<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderDetail extends Model
{
    use HasFactory;
    protected $table = 'order_detail';
    protected $guarded = [];
    public $timestamps = true;
    protected $perPage = 5;

    public function product(){
        return $this->hasOne(Product::class, 'id', 'product_id')->withTrashed();
    }
    public function voucher(){
        return $this->hasOne(Voucher::class, 'id', 'voucher_id');
    }

}
