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

        @include('custom.modalWindow.bigBusketDecorator')
        <div class="container" id="app">


            <nav class="navbar navbar-default">
                <div class="container">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a class="navbar-brand" href="#">Project name</a>
                    </div>
                    <div id="navbar" class="collapse navbar-collapse" id="navbar">
                        <ul class="nav navbar-nav">
                            <li><a href="/">Main</a></li>
                            <li><a href="{{ route('catalog') }}">Catalog</a></li>
                            <li><a href="{{ route('aboutus') }}">About Us</a></li>
                            <li><a href="/downloads">Downloads</a></li>
                            <li><a href="/contacts">Contacts</a></li>
                        </ul>


                        <div class="navbar-form navbar-right">
                            <div class="form-group search-field__container" id="search-field__container">

                                <transition name="searchBlock">
                                    <search-block v-if="showBlock"></search-block>
                                </transition>

                                <transition name="productPreview">
                                    <product-preview v-if = "previewVisible"></product-preview>
                                </transition>

                                <input type="text" placeholder="Search" class="form-control" id="search-field" v-model="search" @keyup="findResults">
                            </div>

                            <a class="main-header__admin" href="/login"><?php if(isset($_SESSION['login'])){echo "Admin Zone";}else {echo "Admin enter";};  ?></a>

                        </div>


                    </div><!--/.nav-collapse -->


                    <div class="row">
                        <div class="small-busket__container" id="busket-container" data-toggle="modal" data-target=".bs-example-modal-lg">
                            <img src="/img/busket.jpg" class="small-busket__img" alt="the busket">
                            <div class="small-busket__info" id="smallBusketInfo">
                                <p class="busket__info-item text-danger" >Amount : <span id="totalAmount"><?= session('totalAmount')?? 0 ?></span> psc  </p>
                                <p class="busket__info-item text-danger" >Summa :  <span id="totalSumma"><?= session('totalSumma')?? 0 ?> </span> hrn </p>
                            </div>
                        </div>
                    </div>



                </div><!-- conteiner -->
            </nav>

            <div class="content">
                @yield('content')
            </div>



        </div>

        @include('custom.partials.footer')

        <script src="{{ mix('/js/bootstrap-sass.js')}}"></script>

    </body>
</html>
