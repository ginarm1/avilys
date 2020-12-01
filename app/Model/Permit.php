<?php

namespace App\Models;

use App\Model\Role;
use App\Model\Roles_leidimai;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permit extends Model
{
    protected $table = 'permits';

   protected $fillable = [
        'id',
        'name'
   ];

   public function roles(){
       return $this->belongsToMany(Role::class);
   }
}
