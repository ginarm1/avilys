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

@section('content')

    <div class="container p-4" style="background: white">
            <div class="mb-3">Naudotojų bei planų ataskaita. Pasirinkite tipą:</div>
        <a href="./ataskaita/uzsakymai"><button class="btn btn-light">Klientai ir užsakymų istorija</button></a>
        <a href="./ataskaita/vadybininkai"><button class="btn btn-light">Vadybininkai</button></a>
        <a href="./ataskaita/admins"><button class="btn btn-light">Administratoriai</button></a>
        <a href="./ataskaita/planai"><button class="btn btn-light">Planai</button></a>

    </div>

    <script>
        $(document).ready(function (){
            $('table').hide();
        });
        $('#clients').click(function (){
            $('table').show();
        });
        $('#clients').click(function (){
            $('table').show();
        });
        $('#clients').click(function (){
            $('table').show();
        });
    </script>
@endsection
