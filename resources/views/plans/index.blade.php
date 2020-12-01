@extends('layouts.app')
<header>
<?php
    $_SESSION['active'] = 'plans';
?>
</header>
@section('content')

    <div class="container">
        <h3 class="mb-4"><b>Planai</b></h3>
        @if(count($plans) > 0)
            <div class="container-fluid">
                <div class="row padding" >
            @foreach($plans as $plan)
                        <div class="col-md-4 col-sm-8">
                            <div class="card mb-3" style="border-radius: 10px;color:whitesmoke;background: black">

                                    <div class="card-title p-4">
                                        <h5>{{$plan -> name}}</h5>
                                         <?php $internet_data_gb = $plan-> internet_data_mb / 1000 ?>

    {{--                                    <h1 class="pt-3" style="text-align: center"><b>{{$plan-> internet_data_mb}} MB</b></h1>--}}
                                        <h1 class="pt-3" style="text-align: center"><b>{{$internet_data_gb}} GB</b></h1>
                                        <p class="pt-1" style="text-align: center">Lietuvoje ir ES</p>
    {{--                                    <br style="color: #0c5460">--}}
                                    </div>

                                <div class="card-body">
                                        <div class="card-text">
                                            <p class="p-2 offset-1"><i class="fas fa-mobile-alt mb-3" style="display: block;text-align: center;" ></i>{{$plan->description}}</p>
                                            <br>
                                            <div id="cost" style="display: flex">
                                                @if($plan -> lower_cost_month != null && $plan -> lower_cost < $plan -> cost_month)
                                                    <h3 style="color: #e90505"><b>{{$plan -> lower_cost_month}} eur</b></h3>

                                                    <p class="mt-2 offset-1" ><b>{{$plan -> cost_month}} eur /mėn.</b></p>
{{--                                                    <p class="mt-2 ml-1">/mėn.</p>--}}
                                                @else
                                                    <h4><b>{{$plan -> cost_month}} eur</b></h4>
                                                    <p class="mt-1 ml-1">/mėn.</p>
                                                @endif


                                            </div>
                                            <p class="mt-3">Su {{$plan->evaluation_time}} mėn. sutartimi</p>
                                        </div>
                                    @guest
                                        <h4 style="text-align: center; color: #a7a74f">Norėdami užsisakyti planą, prisijunkite</h4>
                                    @else
                                    @if(Auth::user()->fk_role >0)
                                        <a href="./planai/{{$plan->id}}" style="text-decoration: none;color: white"><button class="btn btn-dark mt-3" style="width: 95%; border-radius: 20px;">Užsakyti ></button></a>
                                    @endif
                                    @endguest
                                </div>
                            </div>
                        </div>
            @endforeach

                </div>
            </div>
        @else
            <p>Nėra planų</p>
        @endif
    </div>

@endsection
