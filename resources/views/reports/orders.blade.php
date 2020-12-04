@extends('layouts.app')
<header>
    <?php
    $_SESSION['active'] = 'reports';
    $_SESSION['table'] = 'orders';
    ?>
</header>

@section('content')
@include('reports.bonus-head')


    <div class="container p-4" style="background: white;">
        <a href="../ataskaita"><button class="btn btn-light mb-3">Atgal</button></a>
        <a href="../ataskaita/klientai"><button class="btn btn-secondary mb-3" id="btn-clients">Klientai</button></a>

        <div class="offset-5">

            <form class="form-group" id="panel-orders-history" method="get">
                <select name="orders-history-type" id="orders-history-type" required>
                    <option value="" name="">---</option>
                    <option value="name_and_surname" name="name_and_surname">Vardas ir pavardė</option>
                    <option value="name" name="name">Vardas</option>
                    <option value="surname" name="surname">Pavarde</option>
                    <option value="phone_nr" name="phone_nr">Telefono nr.</option>
                    <option value="plan_name" name="plan_name">Plano pavadinimas</option>
                </select>
                <div class="box-2">
                    <input class="form-item" type="text" placeholder="Įveskite" id="name-input" name="name" value=<?php if (isset($_GET['name'])) echo $_GET['name']?>>
                    <input class="form-item" type="text" placeholder="Įveskite pavardę" id="surname-input" name="surname" value=<?php if (isset($_GET['surname'])) echo $_GET['surname']?>>
                </div>

                <div class="box-3">
                    <label for="plan_start">Plano patvirtinimo data (nuo - iki)</label>
                    <input type="date" id="plan_from" name="plan_from"
                           value="2020-11-25"
                           min="2020-11-01" max="2030-01-01" required>
                    <input type="date" id="plan_to" name="plan_to"
                           value="2023-11-25"
                           min="2020-11-01" max="2030-01-01" required>
                </div>
                <div class="box-4">
                    <label for="is_approved_check">Ar planas patvirtintas</label>
                    <input class="mr-3"  type="checkbox" value="1" name="is_approved_check">
                    <input type="submit" value="Ieškoti" class=" btn btn-dark" id="search" name="search"><a href="#"></a>
                    <a href="../ataskaita/klientai"><input type="submit" class="btn btn-light" name="cancel" value="Atšaukti"></a>
                </div>
            </form>

        </div>

        @if(isset($_GET['cancel']))
            <?php $_GET['name'] = null; $_GET['surname'] = null; ?>
        @endif

        <h4>Viso sumokėta: {{$sum}} eur</h4>
        <table class="table" id="orders-history" width="55%">
            <thead>
            <tr>
                <th scope="col">Užsakymo nr.</th>
                <th scope="col">Vardas</th>
                <th scope="col">Pavardė</th>
                <th scope="col">Telefono nr.</th>
                <th scope="col">Plano pavadinimas</th>
                <th scope="col">Sumokėta</th>
                <th scope="col">Ar planas patvirtintas</th>
                <th scope="col">Ar dabartinis</th>
                <th scope="col">Plano patvirtinimo data</th>
                <th scope="col">Plano galiojimo pabaiga</th>
                @if(Gate::allows('administrators-only',Auth::user()))
                <th scope="col">Patvirtinti planą</th>
                @endif
            </tr>
            </thead>
            <tbody>
            @if($orders->isEmpty())
                <th>Nėra užsakymų</th>
            @else
{{--            <tr>--}}

{{--            </tr>--}}
            @foreach($orders  as $order)
                    <?php   $user_name = null; $user_surname = null; $user_phone_nr = null;
                            $plan_name = null;
                            $is_plan_accepted = null; $is_plan_current = null;
                            $plan_begin_date = null; $plan_ends_at = null; ?>

                    @foreach($users as $user)
                        @if($order -> user_id == $user->id)
                            <?php   $user_name  = $user -> name;
                            $user_surname   = $user -> surname;
                            $user_phone_nr  = $user -> phone_nr;

                            ?>
                        @endif

                    @endforeach
                    @foreach($plans as $plan)
                        @if($order -> plan_id == $plan -> id)
                            <?php
                            $plan_name = $plan -> name;
                            ?>
                        @endif
                    @endforeach
{{--                    Ar užsakymas yra priimtas--}}
                    <?php  if ($order -> is_approved == 0){
                        $plan_begin_date = '-';
                        $plan_ends_at = '-';
                        $is_plan_accepted = "NE";
                    }else if($order -> is_approved == 2){
                        $is_plan_accepted = "BAIGĖSI";
                        $plan_begin_date    = $order -> updated_at;
                        $plan_ends_at       =  $order -> ends_at;
                        $plan_begin_date = date("Y-m-d",strtotime($plan_begin_date));
                        $plan_ends_at = date("Y-m-d",strtotime( $plan_ends_at ));
                    }

                    else{
                        $plan_begin_date    = $order -> updated_at;
                        $plan_ends_at       =  $order -> ends_at;
                        $plan_begin_date = date("Y-m-d",strtotime($plan_begin_date));
                        $plan_ends_at = date("Y-m-d",strtotime( $plan_ends_at ));


                        $is_plan_accepted = "TAIP";
                    }
//                   Ar užsakymas yra dabartinis
                    if($order -> is_current_plan == 0){
                            $is_plan_current = "NE";
                        }else{
                            $is_plan_current = "TAIP";
                        }
                    ?>

                    @if(!isset($_GET['name']) && !isset($_GET['search']))

                        @include('reports.tables.table')


{{--                        </tr>--}}
                    @elseif($_GET['name'] == '')


                        @include('reports.tables.table')

                    @elseif(isset($_GET['search']))
                        <tr>
                            <?php  $plan_from_input =  $_GET['plan_from'];$plan_to_input =$_GET['plan_to'];
                                if(isset($_GET['is_approved_check'])){
                                    $is_approved =  $_GET['is_approved_check'];
                                }
                            ?>
                    <!--Jei "patvirtintas" varnelė pažymėta-->
                            @if(isset($is_approved))
                                @switch($_GET['orders-history-type'])
                                    @case('name_and_surname')
                                    @if($user_name == $_GET['name'] && $user_surname == $_GET['surname']
                                                && $plan_begin_date > $plan_from_input  && $plan_begin_date < $plan_to_input )
                                        @include('reports.tables.table')

                                    @endif
                                    @break
                                    @case('name')
                                    @if($user_name == $_GET['name'] && $is_plan_accepted == "TAIP"
                                                 && $plan_begin_date > $plan_from_input  && $plan_begin_date < $plan_to_input )
                                        @include('reports.tables.table')
                                    @endif
                                    @break
                                    @case('surname')
                                    @if($user_name == $_GET['name'] && $order -> is_approved == 1
                                           && $plan_begin_date > $plan_from_input  && $plan_begin_date < $plan_to_input )
                                        @include('reports.tables.table')
                                    @endif
                                    @break
                                    @case('phone_nr')
                                    @if($user_phone_nr == $_GET['name'] && $order -> is_approved == 1
                                             && $plan_begin_date > $plan_from_input  && $plan_begin_date < $plan_to_input )
                                        @include('reports.tables.table')
                                    @endif
                                    @break
                                    @case('plan_name')
                                    @if($plan_name == $_GET['name'] && $order -> is_approved == 1
                                          && $plan_begin_date > $plan_from_input  && $plan_begin_date < $plan_to_input )
                                        @include('reports.tables.table')
                                    @endif
                                    @break
                                @endswitch
            {{--          Jei nepatvirtintas užsakymas                      --}}
                            @else
                                @switch($_GET['orders-history-type'])

                                    @case('name_and_surname')
                                    @if($user_name== $_GET['name'] && $user_surname== $_GET['surname'])

                                        @include('reports.tables.table')

                                    @endif
                                    @break
                                    @case('name')
                                    @if($user_name == $_GET['name'] )

                                        @include('reports.tables.table')
                                    @endif
                                    @break
                                    @case('surname')
                                    @if($user_surname == $_GET['surname'])
                                        @include('reports.tables.table')
                                    @endif
                                    @break
                                    @case('phone_nr')
                                    @if($user_phone_nr == $_GET['name'])
                                        @include('reports.tables.table')
                                    @endif
                                    @break
                                    @case('plan_name')
                                    @if($plan_name == $_GET['name'] )
                                        @include('reports.tables.table')
                                    @endif
                                    @break
                                @endswitch
                            @endif


                        </tr>
                        </tr>
                    @endif

                @endforeach
            @endif
            </tbody>
        </table>
    </div>
@endsection
