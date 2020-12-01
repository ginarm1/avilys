@extends('layouts.app')
<header>
    <?php
    $_SESSION['active'] = 'reports';
    ?>
</header>
@section('content')
    <style>
        td,th{
            text-align: center;
        }
    </style>
    <div class="container p-4" style="background: white">
        <a href="../ataskaita"><button class="btn btn-light mb-3">Atgal</button></a>
        <table class="table">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Pavadinimas</th>
                <th scope="col">Aprasymas</th>
                <th scope="col">Interneto kiekis(MB)</th>
                <th scope="col">Kaina mėn</th>
                <th scope="col">Mažesnė kaina mėn</th>
                <th scope="col">Galiojimo laikas (mėn)</th>
                <th scope="col">Pardavimų kiekis</th>
                <th scope="col">Sukūrimo data</th>
                <th scope="col">Atnaujinimo data</th>
                <th scope="col">Redaguoti planą</th>
            </tr>
            </thead>
            <tbody>
            @foreach($plans as $plan)
                <tr>
                    <th scope="row">{{$plan -> id}}</th>
                    <td>{{$plan -> name}}</td>
                    <td>{{$plan -> description}}</td>
                    <td>{{$plan -> internet_data_mb}}</td>
                    <td>{{$plan -> cost_month}}</td>
                    <td>{{$plan -> lower_cost_month}}</td>
                    <td>{{$plan -> evaluation_time}}</td>
                    <td>{{$plan -> sold_quantity}}</td>
                    <td>{{$plan -> created_at}}</td>
                    <td>{{$plan -> updated_at}}</td>
                    <td><a href="../planai/{{$plan -> id}}/edit"><button class="btn btn-primary">Redaguoti</button></a></td>

                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
