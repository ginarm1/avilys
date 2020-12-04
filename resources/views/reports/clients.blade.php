@extends('layouts.app')
<header>
    <?php
    $_SESSION['active'] = 'reports';
    $_SESSION['table'] = 'clients';
    ?>
</header>

@section('content')
@include('reports.bonus-head')
{{--Sukuriamas patvirtinimo langas--}}
<script>
    $(document).ready(function (){
        $(".btn-delete-real").hide();
        $('#btn_delete').click(function (){
            $.confirm({
                title: "Ar tikrai norite pašalinti klientą?",
                buttons: {
                    taip: function (){
                        $(".btn-delete-real").show();
                        $("#btn_delete").hide();

                    },
                    ne: function () {
                        $.alert('Canceled!');
                    }
                }
            });
        });
    })
</script>

<div class="container p-4" style="background: white;">
    <a href="../ataskaita"><button class="btn btn-light mb-3">Atgal</button></a>
    <a href="../ataskaita/uzsakymai"><button class="btn btn-secondary mb-3" id="btn-orders-history">Užsakymų istorija</button></a>

    <div class="offset-5">

        <form class="form-group" id="panel-clients" method="get">
            <select name="clients-type" id="clients-type" required>
                <option value="" name="">-</option>
                <option value="name_and_surname" name="name_and_surname">Vardas ir pavardė</option>
                <option value="name" name="vardas">Vardas</option>
                <option value="surname" name="pavarde">Pavarde</option>
                <option value="email" name="el_pastas">El. paštas</option>
                <option value="phone_nr" name="tel_nr">Telefono nr.</option>
            </select>

            <div class="box-2">
                <input class="form-item" type="text" placeholder="Įveskite" name="name" value=<?php if (isset($_GET['name'])) echo $_GET['name']?>>
                <input class="form-item" type="text" placeholder="Įveskite pavardę" id="surname-input2" name="surname" value=<?php if (isset($_GET['surname'])) echo $_GET['surname']?>>
            </div>

            <div class="box-4">
                <label for="is_current">Ar dabar turi planą</label>
                <input class="mr-3" id="is_current_checked" type="checkbox" value="1" name="is_current_checked">
                <input type="submit" value="Ieškoti" class=" btn btn-dark" id="search" name="search"><a href="#"></a>
                <a href="../ataskaita/klientai"><input type="submit" class="btn btn-light" name="cancel" value="Atšaukti"></a>
            </div>

        </form>
    </div>


    <table class="table" id="clients" style="width: 90%">
        <thead>
        <tr>
            <th scope="col">Klientų nr.</th>
            <th scope="col">Vardas</th>
            <th scope="col">Pavardė</th>
            <th scope="col">El. paštas</th>
            <th scope="col">Telefono nr.</th>
            <th scope="col">Plano pavadinimas</th>
            <th scope="col">Ar turi dabartinį planą</th>
            <th scope="col">Plano sukūrimo data</th>
            <th scope="col">Plano patvirtinimo data</th>
            <th scope="col">Pašalinti naudotoją</th>
        </tr>
        </thead>
        <tbody>
        @foreach($users as $user)

                <?php $new_ordered = '0000-00-00'; $accepted_date = '0000-00-00'; $plan_name = ''; $plan_id = 0;$is_current_plan = null;?>
                @foreach($orders as $order)
                    @if($user-> id == $order -> user_id)
                        <?php

                            $new_ordered = $order -> created_at;
                            $accepted_date = $order -> updated_at -> format('Y-m-d');
                            $plan_id = $order -> plan_id;

                            if($order -> is_current_plan == 1 && $order -> is_approved == 1){
                                $is_current_plan = "Taip";
                            }
                            elseif($order -> is_current_plan == 1 && $order -> is_approved == 0)
                                {
//                                    echo $user -> name;
//                                    echo $order -> id;
                                    $is_current_plan = "nepatvirtintas";
                                }
                            elseif ($order -> is_current_plan == 2)
                                {
                                    $is_current_plan = "baigėsi";
                                }
                             $is_current_plan = strtoupper($is_current_plan);
                        ?>

                    @endif

                    @foreach($plans as $plan)
                        @if($plan_id == $plan -> id)
                            <?php $plan_name = $plan -> name; ?>
                        @endif
                    @endforeach

                @endforeach
                    @if(!isset($_GET['name']) && !isset($_GET['search']))
                            @include('reports.tables.table')

                    @elseif($_GET['name'] == '')
                        @include('reports.tables.table')
                    @elseif(isset($_GET['search']))
                    <tr>
                        @if(isset($_GET['is_current_checked']) && $_GET['is_current_checked'] == 1 )
                            @switch($_GET['clients-type'])
                                @case('name_and_surname')
                                @if($user -> name == $_GET['name'] && $user -> surname == $_GET['surname']
                                            && $is_current_plan == "TAIP")
                                    <?php $_SESSION['client_delete'] = 1; ?>
                                    @include('reports.tables.table')

                                @endif
                                @break
                                @case('name')
                                @if($user -> name == $_GET['name'] && $is_current_plan == "TAIP" )
                                    @include('reports.tables.table')

                                @endif
                                @break
                                @case('surname')
                                @if($user -> surname == $_GET['name'] && $is_current_plan == "TAIP" )
                                    @include('reports.tables.table')
                                @endif
                                @break
                                @case('phone_nr')
                                @if($user -> phone_nr == $_GET['name'] && $is_current_plan == "TAIP" )
                                    @include('reports.tables.table')
                                @endif
                                @break
                                @case('email')
                                @if($user -> email == $_GET['name'] && $is_current_plan == "TAIP" )
                                    @include('reports.tables.table')
                                @endif
                                @break
                            @endswitch
                        @else
                            @switch($_GET['clients-type'])
                                @case('name_and_surname')
                                @if($user -> name == $_GET['name'] && $user -> surname == $_GET['surname'] )
                                    <?php $_SESSION['client_delete'] = 1; ?>
                                    @include('reports.tables.table')
                                @endif
                                @break
                                @case('name')
                                @if($user -> name == $_GET['name'] )

                                    @include('reports.tables.table')
                                @endif
                                @break
                                @case('surname')
                                @if($user -> surname == $_GET['name'] )
                                    @include('reports.tables.table')
                                @endif
                                @break
                                @case('phone_nr')
                                @if($user -> phone_nr == $_GET['name']  )
                                    @include('reports.tables.table')
                                @endif
                                @break
                                @case('email')
                                @if($user -> email == $_GET['name']  )
                                    @include('reports.tables.table')
                                @endif
                                @break
                            @endswitch
                        @endif


                    </tr>
                    </tr>
                    @endif

        @endforeach

        <?php $_GET['name'] = null;   ?>
        </tbody>
    </table>
</div>
@endsection
