@extends('layouts.app')
<header>
    <?php
    $_SESSION['active'] = 'reports';
    ?>
</header>
@section('content')
    <div class="container">
        <h4>Redaguoti užsakymą</h4>
        <p>1 = Taip, 0 = Ne</p>
        @if($orders != null)
            <p>{{$orders}}</p>
{{--        @foreach($orders as $orderr)--}}
{{--        <p>{{$orderr}}</p>--}}
{{--        @endforeach--}}
        @else
            <p>Orders = null</p>
        @endif
        <p>Plano galiojimas: {{$expiration_date}}</p>
        <p>Plano laikas: {{$plan_eval}}</p>
{{--        {!! Form::open(['action' => ['OrdersController@update', $order->id],'method'=>'POST' ]) !!}--}}
{{--        <div class="form-group">--}}
{{--            {{Form::label('title','Ar patvirtinti')}}--}}
{{--            {{Form::text('is_approved',$order->is_approved,['class'=>'form-control'])}}--}}

{{--        </div>--}}
{{--        <div class="form-group">--}}
{{--            {{Form::label('title','Ar yra dabartinis planas')}}--}}
{{--            {{Form::text('is_current_plan',$order->is_current_plan,['class'=>'form-control'])}}--}}
{{--            Atnaujinamas pasibaigimo laikotarpis--}}
{{--            {{Form::hidden('ends_at',\Carbon\Carbon::now()->addMonths($plan['evaluation']) ->format('Y-m-d'),['class'=>'form-control','placeholder'=>'Galiojimo laikas mėnesiais'])}}--}}
{{--        </div>--}}


{{--        {{Form::hidden('_method','PUT')}}--}}
{{--        {{Form::submit('Patvirtinti',['class'=>'btn btn-primary'])}}--}}
{{--        {!! Form::close() !!}--}}
    </div>
@endsection
