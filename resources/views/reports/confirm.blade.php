{{--@extends('inc.head')--}}
@extends('layouts.app')
<head>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>

</head>
<header>
    <?php
    $_SESSION['active'] = 'reports';
    ?>
</header>
<style>
    .container{
        text-align: center;
    }
</style>
@section('content')

    <div class="container pb-4" style="background: white">
        <div class="mb-3">Ar tikrai norite pašalinti naudotoją?</div>

{{--        {!! Form::open(['action' => ['ReportsController@destroy', $user->id],'method'=>'POST' , 'class' => 'mt-3']) !!}--}}
{{--        {{Form::text('_method','DELETE')}}--}}
{{--        {{Form::submit('DELETE',['class' => 'btn btn-danger'])}}--}}
{{--        {!! Form::close() !!}--}}
    </div>

@endsection

