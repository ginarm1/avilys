<?php

namespace App\Http\Controllers;

//use App\Model\User;
use App\Model\Plan;
use App\Models\Order;
use App\Providers\AuthServiceProvider;
use App\Policies\PostPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReportsController extends Controller
{
    public function index(){
        if(Auth::user()->fk_role > 1) {
            return view('reports.index');
        }
        else{
            return redirect('index');
        }

    }
    public function clients(){
        if(Auth::user()->fk_role > 1) {
            $users= User::all() -> where('fk_role',1)-> sortByDesc('id') ;
            $plans = Plan::all();
            $orders = Order::all();
            return view('reports.clients',compact('users','plans','orders'));
        }
        else{
            return redirect('index');
        }
    }

    public function orders(){
        if(Auth::user()->fk_role > 1) {
            $users= User::all() -> where('fk_role',1);
            $plans = Plan::all();
            $orders = Order::all() -> sortByDesc('id');
            $ordersCol = Order::all();
            $orders_cost_sum = $ordersCol->map(function ($ordersCol){
                return $ordersCol-> only(['total_cost']);
             });
            $sum = $orders_cost_sum ->sum('total_cost');

            return view('reports.orders',compact('users','plans','orders','sum'));
        }
        else{
            return redirect('index');
        }
    }


    public function managers(){
        if(Auth::user()->fk_role > 1) {
            $users= User::all() -> where('fk_role',2);
            return view('reports.managers')->with('users',$users);
        }
        else{
            return redirect('index');
        }
    }
    public function admins(){
        if(Auth::user()->fk_role == 3) {
            $users= User::all() -> where('fk_role',3);
            return view('reports.administrators')->with('users',$users);
        }
        else{
            return redirect('index');
        }
    }
    public function plans(){
        if(Auth::user()->fk_role > 1) {
            $plans = Plan::all();
            return view('reports.plans')->with('plans',$plans);
        }
        else{
            return redirect('index');
        }
    }
    public function destroy($id){
        $user = User::find($id);
        $user ->delete();
        return redirect('../')->with('success','Naudotojas sėkmingai pašalintas');
    }

    public function confirmUserDelete($id){
        $user = User::find($id);
        return view('reports.confirm',compact('user'));
    }

}
