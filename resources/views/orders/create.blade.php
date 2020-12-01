@extends('layouts.app')
<header>
    <?php
    $_SESSION['active'] = '';
    ?>
</header>
<style>
    .container{
        text-align: center;
        background: white;
    }
</style>

@section('content')
    <div class="container">

        <?php if(isset($_GET['order_new'])) $has_current_plan = 0; ?>
        @if($has_current_plan == 1 )
            {!! Form::open(['method'=>'GET' ]) !!}
                <h3>Ar tikrai norite pakeisti planą?</h3>
                {{Form::hidden('has_current_plan',0,['class'=>'form-control','placeholder'=>'Ar yra patvirtintas'])}}
                {{Form::submit('Patvirtinu',['class'=>'btn btn-primary mb-4', 'name'=>'order_new'])}}
            {!! Form::close() !!}
                <a href="{{url('planai')}}"><button class="btn btn-light">Atšaukti</button></a>

        @else

        {!! Form::open(['action' => 'OrdersController@store','method'=>'POST' ]) !!}

        <h3 class="mb-3">Patvirtinkite užsakymą</h3>
        <div class="form-group">
            {{Form::label('title','Užsakymo data: '.now()->format('Y-m-d'))}}
            {{Form::hidden('is_approved','0',['class'=>'form-control','placeholder'=>'Ar yra patvirtintas'])}}
            {{Form::hidden('is_current','1',['class'=>'form-control','placeholder'=>'Ar yra dabartinis'])}}
        </div>
        <div class="form-group">

            {{Form::label('title','Plano pavadinimas: '.$plan['plan_name'])}}
        </div>
            @if($plan['lower_cost_month'] != null && $plan['lower_cost_month'] < $plan['cost_month'])
                <div class="form-group">
                    {{Form::label('title','Plano kaina mėnesiui su nuolaida: '.$plan['lower_cost_month'])}}
                </div>
                <div class="form-group">
                    {{Form::label('title','Plano galutinė kaina: '.$plan['total_cost'])}}
                    {{Form::hidden('total_cost',$plan['total_cost'],['class'=>'form-control','placeholder'=>'Galutinė kaina'])}}
                </div>
            @elseif($plan['cost_month'] == 0)
                <p>Nėra kainos</p>
            @else
                <div class="form-group">
                    {{Form::label('title','Plano kaina mėnesiui: '.$plan['cost_month'])}} eur
                </div>
                <div class="form-group">
                    {{Form::label('title','Plano galutinė kaina: '.$plan['total_cost'])}} eur
                    {{Form::hidden('total_cost',$plan['total_cost'],['class'=>'form-control','placeholder'=>'Galutinė kaina'])}}
                </div>
            @endif
        <div class="form-group">
            {{Form::label('title','Kliento vardas ir pavardė: '. Auth::user()->name . ' ' . Auth::user()->surname)}}
            {{Form::hidden('created_at',\Carbon\Carbon::now(),['class'=>'form-control','placeholder'=>'Galiojimo pradžia'])}}
        </div>
        <div class="form-group">
            {{Form::label('title','Galiojimo pabaigos data: '. \Carbon\Carbon::now()->addMonths($plan['evaluation']) ->format('Y-m-d'))}}
            {{Form::hidden('ends_at',\Carbon\Carbon::now()->addMonths($plan['evaluation']) ->format('Y-m-d'),['class'=>'form-control','placeholder'=>'Galiojimo laikas mėnesiais'])}}
        </div>
        <div class="form-group">
            {{Form::hidden('plan_id',$plan['plan_id'],['class'=>'form-control','placeholder'=>'Galiojimo laikas mėnesiais'])}}
            {{Form::hidden('plan_sold_quantity',$plan['plan_sold_quantity'] = $plan['plan_sold_quantity'] + 1,['class'=>'form-control','placeholder'=>'Pardavimų kiekis'])}}

            {{Form::hidden('user_id',Auth::user()->id,['class'=>'form-control','placeholder'=>'Galiojimo laikas mėnesiais'])}}
        </div>
        <div id="form-btn">
            {{Form::submit('Patvirtinu',['class'=>'btn btn-primary mb-4'])}}

            {!! Form::close() !!}
            <a href="/Projects/avilys/public/" class="btn btn-secondary mb-4" >Atšaukti</a>
        </div>
        @endif


    </div>
@endsection
