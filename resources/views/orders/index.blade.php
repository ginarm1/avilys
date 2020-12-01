<?php
$_SESSION['active'] = '';
//$_SESSION['is_approved'] = '';
?>
@extends('layouts.app')

<style>
    #plan-name{
        font-family: "Arial Black", sans-serif;
    }
    .content{
        text-align: center;
        background: white;
    }

</style>

@section('content')
    <div class="container">
        <div class="content p-3">
            @if($order == null )
                <h3 class="mb-4">Jūs šiuo metu plano neturite</h3>
            @elseif($order->id > 0 && $order-> is_approved == 2)
                <h3 class="mb-4">Jūsų plano galiojimas baigėsi</h3>
                <h3 class="mb-4">Kviečiame užsisakyti naują</h3>
            @elseif($order-> id > 0 && $order-> is_approved == 0)
                    <h3 class="mb-4">Palaukite administratoriaus patvirtinimo</h3>

            @elseif($order-> id > 0 && $order-> is_approved == 1 && $order-> is_current_plan ==1)

                    @if($plan == null)
                        <h3>Planas nerastas</h3>
                    @else
                        <h3 class="mb-4">Jūsų dabartinis planas:</h3>

                        <p>Plano pavadinimas: <b>{{$plan->name}}</b></p>
                        <p>Plano kaina mėn: {{$plan->cost_month}} eur</p>
                        <p>Sutarties pabaiga: {{$order -> ends_at}}</p>
                    @endif


            @endif
        </div>


    </div>
@endsection
