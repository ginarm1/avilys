<?php

namespace App\Model;

use App\Models\Permit;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = 'roles';

    protected $fillable = [
        'id',
        'name'
    ];

    public function permits(){
        return $this->belongsToMany(Permit::class);
    }
}
