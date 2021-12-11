<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActicityHistory extends Model
{
    use HasFactory;
    protected $table = 'activity_history';
    protected $guarded = [];
    public $timestamps = true;
    protected $perPage = 15;

    public function user(){
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
