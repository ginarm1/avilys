@include('inc.head')
<body>

    <div id="app">
        @include('inc.navbar')
        <style>
            body{
                background: linear-gradient(
                    rgba(255,255,255,0.6),
                    rgba(249,235,210,30) ) ,
                url('images/img-bee-bg.jpg');
            }
        </style>

        <main class="py-4">
            @include('inc.messages')
            @yield('content')
        </main>
        @include('inc.footer')
    </div>
</body>
</html>
