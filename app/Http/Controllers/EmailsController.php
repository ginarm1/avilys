<?php

namespace App\Http\Controllers;

use App\Mail\ApproveMail;
use App\Model\Plan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class EmailsController extends Controller
{
    public function index(){

//        if(Auth::user()!= null){
//            if(Auth::user()->fk_role>1){
//                $plan_name = Plan::where('id',3) -> get('name') -> first();
//                return new ApproveMail();
//            }
//        }
        Mail::to('test@email.com')->send(new ApproveMail());
        return new ApproveMail();
    }
}
