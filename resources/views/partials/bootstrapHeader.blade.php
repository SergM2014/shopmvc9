<!-- Fixed navbar -->
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
        <div id="navbar" class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li class="active"><a href="#">Main</a></li>
                <li><a href="/catalog">Catalog</a></li>
                <li><a href="/aboutus">About Us</a></li>
                <li><a href="/downloads">Downloads</a></li>
                <li><a href="/contacts">Contacts</a></li>

                {{--<li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dropdown <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="#">Action</a></li>
                        <li><a href="#">Another action</a></li>
                        <li><a href="#">Something else here</a></li>
                        <li role="separator" class="divider"></li>
                        <li class="dropdown-header">Nav header</li>
                        <li><a href="#">Separated link</a></li>
                        <li><a href="#">One more separated link</a></li>
                    </ul>
                </li>--}}

            </ul>


            <div class="navbar-form navbar-right">
                <div class="form-group">
                    <input type="text" placeholder="Search" class="form-control">
                </div>

                <a class="main-header__admin" href="/admin"><?php if(isset($_SESSION['login'])){echo "Admin Zone";}else {echo "Admin enter";};  ?></a>


            </div>



        </div><!--/.nav-collapse -->


        <div class="row">
            <div class="small-busket__container" id="busket-container">
                <img src="/img/busket.jpg" class="small-busket__img" alt="the busket">
                <div class="small-busket__info" id="smallBusketInfo">
                    <p class="busket__info-item" >Amount :  </p>
                    <p class="busket__info-item" >Summa :  </p>
                </div>
            </div>
        </div>



    </div><!-- conteiner -->
</nav>