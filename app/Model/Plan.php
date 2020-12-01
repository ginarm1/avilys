<?php

namespace App\Model;

use App\Models\Order;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    protected $table = 'plans';

    protected $fillable = [

        'name',
        'photo',
        'description',
        'internet_data_mb',
        'cost_month',
        'lower_cost_month',
        'evaluation_time',
        'sold_quantity',
        'created_at',
        'updated_at'
    ];
    public function orders(){
        return $this->hasMany(Order::class);
    }
//    public $timestamps = true;
}
