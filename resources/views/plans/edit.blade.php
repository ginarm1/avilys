@extends('layouts.app')
<header>
<?php
$_SESSION['active'] = 'plans';
?>
</header>
@section('content')
    <div class="container">
        <h4>Redaguoti planą</h4>

        {!! Form::open(['action' => ['PlansController@update', $plan->id],'method'=>'POST' ]) !!}
        <div class="form-group">
            {{Form::label('title','Pavadinimas')}}
            {{Form::text('name',$plan->name,['class'=>'form-control','placeholder'=>'Pavadinimas'])}}
        </div>
        <div class="form-group">
            {{Form::label('title','Aprašymas')}}
            {{Form::textarea('description',$plan->description,['id'=>'article-ckeditor','class'=>'form-control','placeholder'=>'Aprašymas'])}}
        </div>
        <div class="form-group">
            {{Form::label('title','Kaina mėnesiui')}}
            {{Form::text('cost_month',$plan->cost_month,['class'=>'form-control','placeholder'=>'Kaina mėn'])}}
        </div>
        <div class="form-group">
            {{Form::label('title','Kaina mėnesiui su nuolaida')}}
            {{Form::text('lower_cost_month',$plan->lower_cost_month,['class'=>'form-control','placeholder'=>'Mažesnė kaina mėn'])}}
        </div>
        <div class="form-group">
            {{Form::label('title','Galiojimo laikas')}}
            {{Form::text('evaluation_time',$plan->evaluation_time,['class'=>'form-control','placeholder'=>'Galiojimo laikas mėnesiais'])}}
        </div>
        <div class="form-group">
            {{Form::label('title','Interneto kiekis')}}
            {{Form::text('internet_data_mb',$plan->internet_data_mb,['class'=>'form-control','placeholder'=>'Interneto kiekis (MB)'])}}
        </div>
        @csrf
        {{Form::hidden('_method','PUT')}}
        {{Form::submit('Pridėti',['class'=>'btn btn-primary'])}}
        {!! Form::close() !!}
    </div>
@endsection
