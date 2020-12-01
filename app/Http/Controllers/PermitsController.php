<?php

namespace App\Http\Controllers;

use App\Model\Role;
use App\Model\Roles_leidimai;
use App\Models\Permit;
use Illuminate\Http\Request;

class PermitsController extends Controller
{
    public function show(){

        $role = Role::find(2);

        return view('pages.index')->with('role',$role);

    }
}
