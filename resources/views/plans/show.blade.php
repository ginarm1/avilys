@extends('layouts.app')
<header>
    <?php
    $_SESSION['active'] = 'plans';

    ?>
</header>
@section('content')
{{--Sukuriamas patvirtinimo langas--}}
<script>
    $(document).ready(function (){
        $("#btn_delete_real").hide();
        $('#btn_delete').click(function (){
            $.confirm({
                title: "Ar tikrai norite pašalinti planą?",
                buttons: {
                    taip: function (){
                        $("#btn_delete_real").show();
                        $("#btn_delete").hide();

                    },
                    ne: function () {
                        $.alert('Atšaukta!');
                    }
                }
            });
        });
    })
</script>

    <div class="container">
        <div class="container-fluid">
            <a href="../planai"><button class="btn btn-light mb-3">Atgal</button></a>
                <div class="row padding" >

                        <div class="col-md-5 col-sm-8">
                            <div class="card mb-3" style="border-radius: 10px;color:whitesmoke;background: black">

                                <div class="card-title p-4">
                                    <h5>{{$plan -> name}}</h5>
                                    <?php $internet_data_gb = $plan-> internet_data_mb / 1000 ?>

        {{--                       <h1 class="pt-3" style="text-align: center"><b>{{$plan-> internet_data_mb}} MB</b></h1>--}}
                                    <h1 class="pt-3" style="text-align: center"><b>{{$internet_data_gb}} GB</b></h1>
                                    <p class="pt-1" style="text-align: center">Lietuvoje ir ES</p>
{{--                                    <br style="color: #0c5460">--}}
                                </div>

                                <div class="card-body">
                                    <div class="card-text">
                                        <p class="p-2 offset-1"><i class="fas fa-mobile-alt mb-3" style="display: block;text-align: center;" ></i>{{$plan->description}}</p>
                                        <br>
                                        <div id="cost" style="display: flex">
                                            @if($plan -> lower_cost_month != null && $plan -> lower_cost < $plan -> cost_month)
                                                <h3 style="color: #e90505"><b>{{$plan -> lower_cost_month}} eur</b></h3>

                                                <p class="mt-2 offset-1" ><b>{{$plan -> cost_month}} eur /mėn.</b></p>
                                            @else
                                                <h4><b>{{$plan -> cost_month}} eur</b></h4>
                                                <p class="mt-1 ml-1">/mėn.</p>
                                            @endif
                                        </div>
                                        <p>Su {{$plan->evaluation_time}} mėn. sutartimi</p>
{{--                                        @if($order == null)--}}
{{--                                            <p>Užsakymo nėra</p>--}}
{{--                                        @endif--}}

                                        @if($order != null)
                                            <?php if($order -> is_approved == 0 && $order->is_current_plan == 1)
                                            {echo '<p class="pt-3" style="color: red">Palaukite naujo plano patvirtinimo</p>';}
                                                else if($order->is_approved == 1 && $order->is_current_plan == 1 && $order->plan_id == $plan -> id){
                                                    echo '<p class="pt-3 offset-1">Tai yra Jūsų dabartinis planas</p>';
                                                }
                                            else
                                            {
                                                if($order->is_approved == 1 && $order->is_current_plan == 1)
                                                {
                                                    $btn_name = "Pakeisti planą";
                                                }
                                                else{
                                                    $btn_name = "Tęskite";
//                                                    echo $order -> is_approved;
//                                                    echo $order -> is_current_plan;
                                                }
                                                echo '<a href="/Projects/avilys/public/uzsakymas/create" style="text-decoration: none;color: white"><button class="btn btn-success mt-3" style="width: 95%; border-radius: 20px;">'.$btn_name.'</button></a>';
                                            }
                                            ?>
                                        @else
                                             <a href="/Projects/avilys/public/uzsakymas/create" style="text-decoration: none;color: white"><button class="btn btn-success mt-3" style="width: 95%; border-radius: 20px;">Tęskite</button></a>

                                        @endif


                                        @if(Gate::allows('administrators-only',Auth::user()))
                                            <a href="./{{$plan->id}}/edit" style="text-decoration: none;color: white"><button class="btn btn-light mt-3" style="width: 95%; border-radius: 20px;">Redaguoti</button></a>
                                            <button class="btn btn-danger m-3" id="btn_delete">Pašalinti</button>
                                            {!! Form::open(['action' => ['PlansController@destroy', $plan->id],'method'=>'POST' , 'class' => 'mt-3']) !!}
                                            {{Form::hidden('_method','DELETE')}}
                                            {{Form::submit('PATVIRTINTI',['class' => 'btn btn-danger', 'id'=>'btn_delete_real'])}}
                                            {!! Form::close() !!}
                                        @endif

                                    </div>
                                 </div>
                            </div>
                        </div>
                </div>
            </div>
    </div>

@endsection
