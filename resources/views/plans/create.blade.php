@extends('layouts.app')
<header>
<?php
    $_SESSION['active'] = 'create-plan';
?>
</header>
@section('content')
    <div class="container">
        @csrf
        {!! Form::open(['action' => 'PlansController@store','method'=>'POST' ]) !!}
            <div class="form-group">
                {{Form::label('title','Pavadinimas')}}
                {{Form::text('name','',['class'=>'form-control','placeholder'=>'Pavadinimas'])}}
            </div>
            <div class="form-group">
                {{Form::label('title','Aprašymas')}}
                {{Form::textarea('description','',['id'=>'article-ckeditor','class'=>'form-control','placeholder'=>'Aprašymas'])}}
            </div>
            <div class="form-group">
                {{Form::label('title','Kaina mėnesiui')}}
                {{Form::text('cost_month','',['class'=>'form-control','placeholder'=>'Kaina mėn'])}}
            </div>
            <div class="form-group">
                {{Form::label('title','Galiojimo laikas')}}
                {{Form::text('evaluation_time','',['class'=>'form-control','placeholder'=>'Galiojimo laikas mėnesiais'])}}
            </div>
            <div class="form-group">
                {{Form::label('title','Interneto kiekis')}}
                {{Form::text('internet_data_mb','',['class'=>'form-control','placeholder'=>'Interneto kiekis (MB)'])}}
            </div>

            {{Form::submit('Pridėti',['class'=>'btn btn-primary'])}}
        {!! Form::close() !!}
    </div>
@endsection
