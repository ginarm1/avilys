@extends('layouts.app')
<?php
$_SESSION['active'] = '';
?>
@section('content')
    <div class="container">
        <h4>Redaguoti profilį</h4>

        {!! Form::open(['action' => ['AccountController@update', $user->id],'method'=>'POST' ]) !!}
        <div class="form-group">
            {{Form::label('title','Telefono nr.')}}
            {{Form::text('phone_nr',$plan->phone_nr,['class'=>'form-control','placeholder'=>'Tel. nr.'])}}
        </div>

        {{Form::hidden('_method','PUT')}}
        {{Form::submit('Pridėti',['class'=>'btn btn-primary'])}}
        {!! Form::close() !!}
    </div>
@endsection
