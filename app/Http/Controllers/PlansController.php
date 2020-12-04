<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Plan;
use Illuminate\Support\Facades\Auth;
use function PHPUnit\Framework\isEmpty;


class PlansController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return
     */
    public function index()
    {
        $plans = Plan::all();
        return view('plans.index')->with('plans',$plans);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create()
    {
        if(Auth::user()->fk_role >1){
            return view('plans.create');
        }else {
            abort(404);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'name' =>'required',
            'description' => 'required',
            'cost_month' => 'required|numeric',
            'evaluation_time' => 'required',
            'internet_data_mb' => 'required'
        ]);
//        Create plan
        $plan = new Plan;
        $plan->name = $request->input('name');
        $plan->description = $request->input('description');
        $plan->cost_month = $request->input('cost_month');
        $plan->evaluation_time = $request->input('evaluation_time');
        $plan->internet_data_mb = $request->input('internet_data_mb');
        $plan->save();

        return redirect('/planai')->with('success','Planas sukurtas');
    }

    /**
     * Display the specified resource.
     *
     * @param Request $request
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function show(Request $request,$id)
    {
        $user_id  = Auth::user()->id;
        $order =  Order::all()  -> where('user_id',$user_id) -> sortByDesc('id') ->first();
        $plan = Plan::find($id);

        $plan_total_cost = $plan -> cost_month * $plan -> evaluation_time;

        $request->session()->put('plan_id', $id);
        $request->session()->put('plan_name', $plan -> name);
        $request->session()->put('plan_cost_month', $plan -> cost_month);
        $request->session()->put('plan_lower_cost_month', $plan -> lower_cost_month);
        $request->session()->put('plan_total_cost', $plan_total_cost);
        $request->session()->put('plan_description', $plan -> description);
        $request->session()->put('plan_evaluation', $plan -> evaluation_time);
        $request->session()->put('plan_sold_quantity', $plan -> sold_quantity);

        if(Auth::user()->fk_role >0){
            return view('plans.show',compact('plan','order'));
        }else {
            abort(404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function edit($id)
    {
        $plan = Plan::find($id);
        if(Auth::user()->fk_role >2){
            return view('plans.show',compact('plan','order'));
        }else {
            abort(404);
        }
        return view('plans.edit')->with('plan',$plan);
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
        $this->validate($request,[
            'name' =>'required',
            'description' => 'required',
            'cost_month' => 'required',
            'evaluation_time' => 'required',
            'internet_data_mb' => 'required'
        ]);
//        Update plan
        $plan = Plan::find($id);
        $plan->name = $request->input('name');
        $plan->description = $request->input('description');
        $plan->cost_month = $request->input('cost_month');
        $plan->lower_cost_month = $request->input('lower_cost_month');
        $plan->evaluation_time = $request->input('evaluation_time');
        $plan->internet_data_mb = $request->input('internet_data_mb');
        $plan->save();

        return redirect('/planai')->with('success','Planas atnaujintas');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        if(Auth::user()->fk_role >2) {
            $plan = Plan::find($id);
            $plan->delete();
            return redirect('/planai')->with('success', 'Planas ištrintas');
        }
    }
}
