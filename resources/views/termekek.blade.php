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
        <span style="font-weight: bold;">PRODUCT</span><br>
        <br>

        <?php
            if(isset($errors)) {
                foreach ($errors->all() as $message) {
                    echo '<span style="color: red; font-weight: bold;">' . $message . '</span><br>';
                }
            }
            echo '<br><br>';

            foreach($categoriesWithDepth as $cat) {
                $category = (array)$cat;
                for($i=0; $i<(int)$category['depth']; $i++) {
                    echo '&nbsp;&nbsp;';
                }
                echo '<a href="'.url('/termekek/'.$cat->id).'">'.$category['name'].'</a><br>';
            }

        echo '<br><br><br>';



            echo '<form id="filter-form" action="" method="GET">';?>
        @csrf
        <?php
        foreach($filters as $filter) {
            echo $filter['web_name'] . '<br>';
            if($filter['type'] == 'select') {
                echo '<select id="'.$filter['azon'].'" name="'.$filter['azon'].'">';
                foreach($filter['values'] as $key => $val) {
                    echo '<option value="attr_'.$key.'">'.$val.'</option>';
                }
                echo '</select>';
            } else if($filter['type'] == 'number') {
                echo '<input type="number" id="'.$filter['azon'].'" name="'.$filter['azon'].'" value="10"/>';
            }
            echo '<br>';
        }

        echo '<input type="submit" value="Szűrés"/>';
        echo '</form>';

            echo '<br><br><br>';

            if(!empty($termekek)) {

                $currentproduct = 0;//(int)$termekek[0]->productid;
               // echo $termekek[0]->productid;; exit;
                foreach($termekek as $t) {
                    $termek = (array)$t;

                    if((int)$currentproduct != (int)$termek['productid']) {
                        $currentproduct = (int)$termek['productid'];
                        echo $termek['name']." qty:" . $termek['qty'] . "<br>";

                        foreach($termekek as $a) {
                            $attr = (array)$a;
                            if($attr['productid'] == $termek['productid']) {
                                $value = (isset($attr['pavvalue'])) ? $attr['pavvalue'] : $attr['avvalue'];
                                echo "&nbsp;&nbsp;&nbsp;" . $attr['attrname'] . ": " . $value . "<br>";
                            }
                        }

                        echo "<br>";

                    }
                }

            }
        ?>

    </div>
</div>
</body>
</html>
