<?php

namespace App\Http\Controllers;

use App\Mail\ApproveMail;
use App\Model\Plan;
use App\Models\Order;
use http\Client\Curl\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class OrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        $user_id  = Auth::user()->id;
        $order = Order::where( 'user_id',$user_id) -> orderBy('id','desc') -> first();


        $plan = null;
        if($order != null){
            $order_id = $order->id;
            $plan_id = $order->plan_id;

            $plan = Plan::all() -> where('id',$plan_id) -> first();

            if($order -> is_current_plan == 1 && $order -> ends_at < Carbon::now()){

                $order = Order::find($order_id);
                $order->is_current_plan = 0;
                $order->is_approved = 2;
                $order->save();

                return redirect('../uzsakymas')->with('success','Užsakymo galiojimas baigtas');
            }
            return view('orders.index',compact('order','plan','user_id'));
        }

        return view('orders.index',compact('order','plan','user_id'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $has_plan_with_id = session()-> get('has_plan_with_id');
        $has_current_plan = false;
        $plan = array(
            'plan_id' => $request -> session() -> get('plan_id'),
            'plan_name' => $request -> session() -> get('plan_name'),
            'cost_month' => $request -> session() -> get('plan_cost_month'),
            'lower_cost_month' => $request -> session() -> get('plan_lower_cost_month'),
            'total_cost' => $request -> session() -> get('plan_total_cost'),
            'description' =>  $request -> session() -> get('plan_description'),
            'evaluation' => $request -> session() -> get('plan_evaluation'),
            'plan_sold_quantity' => $request -> session() -> get('plan_sold_quantity'),

        );
        if(isset($has_plan_with_id) && $has_plan_with_id == $plan['plan_id']){
            $has_current_plan = true;
            return view('orders.create', compact('plan','has_current_plan'));
        }
        return view('orders.create', compact('plan','has_current_plan'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $order = new Order;

        $order -> is_approved = $request -> input('is_approved');
        $order -> is_current_plan = $request -> input('is_current');
        $order -> created_at = $request -> input('created_at');
        $order -> ends_at = $request -> input('ends_at');
        $order -> total_cost = $request -> session() -> get('plan_total_cost');
        $order -> plan_id = $request -> input('plan_id');
        $order -> user_id = $request -> input('user_id');

//        Find the plan and increase sold quantity
        $plan = Plan::find($request -> input('plan_id'));
        $plan -> sold_quantity = $request -> input('plan_sold_quantity');
        $plan -> save();
        $order ->save();
        $request -> session() -> put('has_plan_with_id',$request -> input('plan_id'));
        return redirect('/')->with('success','Užsakymas pateiktas. Laukite patvirtinimo');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function show($id)
    {
        $order = Order::find($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    //    For approving the orders
    public function edit($id)
    {
        $order = Order::find($id);
        $orders = Order::find($id)->get('id');

//        Panaikina dabartinio užsakymo galiojimą
        $not_current_order = Order::where('user_id',2)->where('is_current_plan',1) -> update(['is_current_plan' => 0]);
        $plan = Plan::where('id',$order->plan_id)->get('evaluation_time')->first();
        $expiration_date = Carbon::now()->addMonths($plan->evaluation_time);

//        Atnaujiną užsakymą, kuris tampa dabartiniu
        $approve_order = Order::where('user_id',2)->where('id',$order->id)->
            update(['is_current_plan' => 1,'is_approved'=>1,'ends_at'=> $expiration_date]);


//        return view('orders.edit',compact('order','orders','expiration_date','plan_eval'));
//        Išsiunčiamas laiškas užsakymo patvirtinimo
        $user_email  = Auth::user()-> email;
        Mail::to($user_email)->send(new ApproveMail());
        $order->save();
        return redirect('./ataskaita/uzsakymai') -> with('success','Užsakymas patvirtintas');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {
;
    }
//    -------------------------------
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
