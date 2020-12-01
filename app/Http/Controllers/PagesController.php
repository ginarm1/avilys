<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function index(){
        $user='Jūs esate svečias!';
        return view('pages.index') -> with('user',$user);
    }
    public function plans(){
        return view('pages.plans') -> with($this->show_plans());
    }



    public function show_plans(){
        $short_des = 'interneto duomenų ir neriboti skambučiai';
        $plans = array(
            'name' => ['Lengviau 1','Lengviau 5', 'Lengviau 10'],
            'description' => ['1GB '.$short_des, '5GB '.$short_des],
            'cost' => ['8,99','12,99']
        );
        return $plans;
    }
}
