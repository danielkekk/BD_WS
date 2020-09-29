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
        <span style="font-weight: bold;">TERMEK</span><br>
        <br>

        <?php
            if(isset($errors)) {
                foreach ($errors->all() as $message) {
                    echo '<span style="color: red; font-weight: bold;">' . $message . '</span><br>';
                }
            }
            echo '<br><br>';

        if(!empty($termekek)) {
            ?>

        <form id="create-product-form" action="{{ route('createproductattributesvalue') }}" method="POST">
            @csrf

            <input type="hidden" name="productid" id="productid" value="<?php echo $productid; ?>" />
            <input type="hidden" name="catid" id="catid" value="<?php echo $catid; ?>" />

            <?php

            $currentproduct = 0;//(int)$termekek[0]->productid;
            // echo $termekek[0]->productid;; exit;
            foreach($termekek as $t) {
                $termek = (array)$t;

                if((int)$currentproduct != (int)$termek['productid']) {
                    $currentproduct = (int)$termek['productid'];

                    echo $termek['name'] . ' qty:' . $termek['qty'] . '<br><br>';

                    foreach($attributes as $a) {
                        $attr = (array)$a;
                        //echo "&nbsp;" . $attr['web_name'] . " ( " .  (isset($attr['value']) ? $attr['value'] :  $attr['min'].'-'.$attr['max']) . " )<br>";

                        echo $attr['web_name'] . '<br>';
                        if($attr['type'] == 'select') {
                            echo '<select id="'.$attr['azon'].'" name="'.$attr['azon'].'">';
                            foreach($attr['values'] as $key => $value) {
                                $selected = ((int)$attr['saved_attributes_value_id'] == (int)$key) ? 'selected' : '';
                                echo '<option value="'.$key.'" '.$selected.'>'.$value.'</option>';
                            }
                            echo '</select>';
                        } else if($attr['type'] == 'number') {
                            echo '<input type="number" step="1.0" min="1" max="100" id="'.$attr['azon'].'" name="'.$attr['azon'].'" value="'.trim($attr['saved_attributes_value']).'"/>';
                        }

                        echo "<br>";
                    }

                    echo "<br>";

                }
            }

            ?>

            <input id="submit" type="submit" name="submit" value="Hozzáadás">
        </form>
            <?php

        }

        echo '<br><br>';

        /*
         * <form id="create-product-form" action="{{ route('createcategoriesattribute') }}" method="POST">
            @csrf

            <input id="categoryid" type="hidden" name="categoryid" value="<?php echo $category_id;?>"/><br>

            <label id="name">Attribute</label>
            <select id="attributes" name="attributes">
                <?php foreach($categoriesattributes as $catattr) {
                $catattr = (array)$catattr; ?>
                <option value="<?php echo $catattr['id'];?>"><?php echo $catattr['web_name'];?></option>
                <?php } ?>
            </select>
            <br>

            <input id="submit" type="submit" name="submit" value="Hozzáadás">
        </form>
         */
        ?>


    </div>
</div>
</body>
</html>
