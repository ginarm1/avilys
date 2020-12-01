
 <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm" style="font-family:'Montserrat'; ">
        <div class="container">


            <div class="panel-body">
                <a class="navbar-brand" href="{{ url('') }}">
                    <img src="{{ asset('/images/img-avilys.jpg') }}" style="height: 40px;">
                    {{ config('app.name', 'Avilys') }}
                </a>
            </div>


            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->

                <ul class="navbar-nav mr-auto">
                <?php
                    if( $_SESSION['active'] == 'index' ){
                        echo '<li class="nav-item active">';
                } else{
                        echo '<li class="nav-item">';
                }
                ?>

                        <a class="nav-link" href="{{url('')}}">Pradžia<span class="sr-only">(current)</span></a>
                    </li>
                <?php
                if( $_SESSION['active'] == 'plans' ){
                    echo '<li class="nav-item active">';
                } else{
                    echo '<li class="nav-item">';
                }
                ?>
                        <a class="nav-link" href="{{url('planai')}}">Planai</a>
                    </li>
{{--                    if the user is the manager--}}

                        <?php
                                if( $_SESSION['active'] == 'reports' ){
                                    echo '<li class="nav-item active">';
                                } else{
                                    echo '<li class="nav-item">';
                                }

                        ?>

                    @if(Gate::allows('managers-only',Auth::user()))
{{--                    @if(Auth::user()->fk_role > 1)--}}
                        <a class="nav-link" href="{{url('ataskaita')}}">Ataskaita</a>
                        </li>
                    @endif
                    @if(Gate::allows('administrators-only',Auth::user()))
{{--                    @if(Auth::user()->fk_role > 1)--}}
                        <a class="nav-link" href="{{url('ataskaita')}}">Ataskaita</a>
                        </li>
                    @endif

                    </li>


                </ul>


                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto">
                    <!-- Authentication Links -->
                    @guest

                        @if (Route::has('login'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                        @endif

                        @if (Route::has('register'))
                            <div class="register">
                                <li class="nav-item" >
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            </div>

                        @endif
                    @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{url('uzsakymas')}}">
                                    {{__('Mano planas')}}
                                </a>
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                         document.getElementById('logout-form').submit();">
                                    {{__('Atsijungti')}}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endguest
                    <?php
                    if( $_SESSION['active'] == 'create-plan' ){
                        echo '<li class="nav-item active">';
                    } else{
                        echo '<li class="nav-item">';
                    }
                    ?>

                    @if(Gate::allows('managers-only',Auth::user()))
{{--                    @if(Auth::user()->fk_role > 1)--}}
                        <a class="nav-link" href="{{url('planai/create')}}">Sukurti planą</a>
                    @endif
                    @if(Gate::allows('administrators-only',Auth::user()))
{{--                    @if(Auth::user()->fk_role > 1)--}}
                        <a class="nav-link" href="{{url('planai/create')}}">Sukurti planą</a>
                    @endif
                </ul>
            </div>
        </div>
 </nav>
