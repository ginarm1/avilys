@extends('layouts.app')
<header>
    <?php
    $_SESSION['active'] = 'reports';
    ?>
</header>
@section('content')

<div class="container p-4" style="background: white">
        <a href="../ataskaita"><button class="btn btn-light mb-3">Atgal</button></a>
        <table class="table">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Vardas</th>
                <th scope="col">Pavardė</th>
                <th scope="col">El. paštas</th>
                <th scope="col">Telefono nr.</th>
                <th scope="col">Sukūrimo data</th>
            </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
                @if($user->fk_role == 2)
                    <tr>
                        <th scope="row">{{$user -> id}}</th>
                        <td>{{$user -> name}}</td>
                        <td>{{$user -> surname}}</td>
                        <td>{{$user -> email}}</td>
                        <td>{{$user -> phone_nr}}</td>
                        <td>{{$user -> created_at}}</td>
                    </tr>
                @endif
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
