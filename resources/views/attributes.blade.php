<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

    <!-- Styles -->
    <style>
        html, body {
            background-color: #fff;
            color: #636b6f;
            font-family: 'Nunito', sans-serif;
            font-weight: 200;
            height: 100vh;
            margin: 0;
        }

        .full-height {
            height: 100vh;
        }

        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }

        .position-ref {
            position: relative;
        }

        .top-right {
            position: absolute;
            right: 10px;
            top: 18px;
        }

        .content {
            text-align: center;
        }

        .title {
            font-size: 84px;
        }

        .links > a {
            color: #636b6f;
            padding: 0 25px;
            font-size: 13px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }

        .m-b-md {
            margin-bottom: 30px;
        }
    </style>
</head>
<body>
<div class="flex-center position-ref full-height">
    @if (Route::has('login'))
        <div class="top-right links">
            @auth
                <a href="{{ url('/termekek') }}">Termékek</a>
                <a href="{{ url('/products') }}">Product</a>
                <a href="{{ url('/categories') }}">Categories</a>
                <a href="{{ url('/attributumok') }}">Attributes</a>

                <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">Logout</a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            @else
                <a href="{{ route('login') }}">Login</a>

                @if (Route::has('register'))
                    <a href="{{ route('register') }}">Register</a>
                @endif
            @endauth
        </div>
    @endif

    <div class="content" style="text-align: left;">
        <span style="font-weight: bold;">ATTRIBUTES</span><br>
        <br>

        <?php
            if(isset($errors)) {
                foreach ($errors->all() as $message) {
                    echo '<span style="color: red; font-weight: bold;">' . $message . '</span><br>';
                }
            }
            echo '<br><br>';

            foreach($attributes as $attr) {
                $attr = (array)$attr;
                echo '<a href="'.url('/addattributesvalues/'.$attr['id']).'">'.$attr['web_name'].'</a>' . '('.$attr['type_id'].'),  &nbsp;&nbsp;<a href="'.url('/removeattr/'.$attr['id']).'">X</a><br>';
            }
        ?>

        <br><br><br>

        <form id="create-product-form" action="{{ route('createattr') }}" method="POST">
            @csrf

            <label id="name">Web name</label>
            <input for="name" id="name" type="text" name="name" value="" placeholder="name" required><br>

            <label id="name">Azon</label>
            <input for="azon" id="azon" type="text" name="azon" value="" placeholder="azon" required><br>

            <input id="submit" type="submit" name="submit" value="Hozzáadás">
        </form>
    </div>
</div>
</body>
</html>
