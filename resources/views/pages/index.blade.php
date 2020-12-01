@extends('layouts.app')
<header>
    <?php
    $_SESSION['active'] = 'index';
    ?>
</header>
@section('content')
    <div class="container">
        <div class="jumbotron text-center">
            @guest
                <h2 class="mb-5">Jūs esate svečias</h2>
                <p>Norėdami užsisakyti planą, prisijunkite</p>
                <p>Jūsų galimybės: </p>
                <ul class="list-group mb-4">
                    @foreach ($role->permits as $permit)
                    <li class="list-group-item">{{$permit -> name}} </li>
                    @endforeach
                </ul>

                <div class="row pt-3">
                    <div class="col-8 offset-2">
                        <button class="btn btn-dark" ><a href="{{ route('login') }}" style="color: #ffffff; text-decoration: none">Prisijungti</a> </button>
                        <button class="btn btn-light"><a href="{{ route('register') }}" style="color: #000000; text-decoration: none">Registruotis</a> </button>
                    </div>
                </div>

            @else
                @if(Auth::user()->fk_role == 1)
                    <h2 class="mb-5">Jūs esate registruotas vartotojas</h2>
                        <p>Jūsų galimybės: </p>

                        <ul class="list-group mb-4">
                            <li class="list-group-item">Peržiūrėti planus</li>
                            <li class="list-group-item">Užsisakyti planą</li>
                            <li class="list-group-item">Atšaukti planą</li>

                        </ul>
                @endif
                @if(Auth::user()->fk_role == 2)
                    <h2 class="mb-5">Jūs esate vadybininkas</h2>

                        <ul class="list-group mb-4">
                            <li class="list-group-item">Peržiūrėti planus</li>
                            <li class="list-group-item">Užsisakyti planą</li>
                            <li class="list-group-item">Atšaukti planą</li>
                            <li class="list-group-item">Peržiūrėti klientų duomenis</li>
                            <li class="list-group-item">Peržiūrėti planų ataskaitą</li>
                        </ul>
                @endif
                @if(Auth::user()->fk_role == 3)
                    <h2 class="mb-5">Jūs esate administratorius</h2>

                        <ul class="list-group mb-4">
                            <li class="list-group-item">Peržiūrėti planus</li>
                            <li class="list-group-item">Užsisakyti planą</li>
                            <li class="list-group-item">Atšaukti planą</li>
                            <li class="list-group-item">Pašalinti planą</li>
                            <li class="list-group-item">Pašalinti klientą</li>
                            <li class="list-group-item">Peržiūrėti klientų duomenis</li>
                            <li class="list-group-item">Peržiūrėti planų ataskaitą</li>
                        </ul>
                @endif

            @endguest
        </div>
    </div>
@endsection
