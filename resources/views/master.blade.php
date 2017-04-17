<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <link href="{{ mix('/css/app.css') }}" rel="stylesheet">

    </head>
    <body>
        <div class="container">

            <header class="main-header ">

                <h1 class="main-header__h1">Herzlich Willcomen</h1>



                <nav class="main-header__nav ">

                    <a href="#" class="main-header__logo ">Our Brand</a>

                    <div class="main-header__touch-button">
                        <span class="main-header__icon-bar"></span>
                        <span class="main-header__icon-bar"></span>
                        <span class="main-header__icon-bar"></span>
                    </div>

                    <ul class="main-header__menu" >
                        <li class="main-header__menu-item"><a href="/">Main</a></li>
                        <li class="main-header__menu-item"><a href="/catalog">Catalog</a></li>
                        <li class="main-header__menu-item"><a href="/aboutus">About Us</a></li>
                        <li class="main-header__menu-item"><a href="/downloads">Downloads</a></li>
                        <li class="main-header__menu-item"><a href="/contacts">contacts</a></li>
                    </ul>


                    <a class="main-header__admin" href="/admin"><?php if(isset($_SESSION['login'])){echo "Admin Zone";}else {echo "Admin enter";};  ?></a>



                    <div class="main-header__search-container" >
                        <span class="main-header__search-field-label"> Search</span>
                        <input type="text" name="search" id="search" class="main-header__search-field"  maxlength="20" autofocus >
                        <aside class="main-header__search-result-box--hidden" id="search-results"></aside>
                    </div>

                </nav>

                <div class="clearfix">
                    <div class="busket__container" id="busket-container">
                        <img src="/img/busket.jpg" class="busket" alt="the busket">
                        <div class="busket__info" id="busket-info">


                            <p class="busket__info-item" >Amount :  </p>
                            <p class="busket__info-item" >Summa :  </p>
                        </div>
                    </div>
                </div><!-- clearfix -->
            </header><!--/site-header-->

            <div class="content">
                @yield('content')
            </div>



        </div>
        <script src="{{ mix('/js/app.js') }}"></script>
    </body>
</html>
