<?php

namespace App\Models;

use App\Model\Plan;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';

    protected $fillable = [
        'is_approved',
        'created_at',
        'ends_at',
        'total_cost',
        'fk_plan',
        'user_id'
    ];


    public function plans(){
        return $this->hasMany(Plan::class);
    }
    public function users(){
        return $this->hasMany(User::class);
    }
}
