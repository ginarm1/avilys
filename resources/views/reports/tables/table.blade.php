<?php if(isset($_SESSION['table'])){
    if($_SESSION['table'] == 'orders'){
    ?>
    <tr>
        <th scope="col">{{$order->id}}</th>
        <td>{{$user_name}}</td>
        <td>{{$user_surname}}</td>
        <td>{{$user_phone_nr}}</td>
        <td>{{$plan_name}}</td>
        <td>{{$order->total_cost}}</td>
        <td>{{$is_plan_accepted}}</td>
        <td>{{$is_plan_current}}</td>
        @if($is_plan_accepted == "NE")
            <td>NEPATVIRTINTA</td>
            @else
            <td>{{$order-> updated_at}}</td>
        @endif

        <td>{{$plan_ends_at}}</td>
        @if($is_plan_accepted == "NE" && \Illuminate\Support\Facades\Auth::user()->fk_role == 3)
            <td><a href="../uzsakymas/{{$order->id}}/edit"> <button class="btn btn-success">Patvirtinti</button></a></td>
        @endif
    </tr>
    <?php }
    if($_SESSION['table'] == 'clients'){
        ?>

        <tr>
            <th scope="row">{{$user -> id}}</th>
            <td>{{$user -> name}}</td>
            <td>{{$user -> surname}}</td>
            <td>{{$user -> email}}</td>
            <td>{{$user -> phone_nr}}</td>
            <td>{{$plan_name}}</td>
            <td>{{$is_current_plan}}</td>
            <td>{{$new_ordered}}</td>
            <td>{{$accepted_date}}</td>
            <?php if(isset($_SESSION['client_delete']) ) {?>
                <td>
{{--                {!! Form::open(['action' => ['ReportsController@destroy', $user->id],'method'=>'POST' , 'class' => 'mt-3']) !!}--}}
                    <button class="btn btn-danger" id="btn_delete">Delete</button>
                    <div class="btn-delete-real">
                    @if(Gate::allows('administrators-only',Auth::user()))
{{--                        NEVEIKIA ŠALINIMAS  --}}

{{--                        {!! Form::open(['action' => ['ReportsController@destroy', $user->id],'method'=>'POST' , 'class' => 'mt-3']) !!}--}}
{{--                        {{Form::hidden('_method','DELETE')}}--}}

{{--                        {{Form::submit('ŠALINTI',['class' => 'btn btn-danger', 'id' =>'btn_delete_t','name' =>'btn_delete'])}}--}}
{{--                        {!! Form::close() !!}--}}
                            <a href="../{{$user -> id}}/destroy"><button class="btn btn-danger">ŠALINTI</button></a>
                        @else
                        <p style="color: red">Tik administratorius gali šalinti klientus</p>
                    @endif
                    </div>
                </td>
            <?php}?>

        </tr>

   <?php
        }
    }
}?>

