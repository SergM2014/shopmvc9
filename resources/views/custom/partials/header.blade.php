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
                    <p class="busket__info-item text-danger" >Amount : <?= session('totalAmount')?? 0 ?> psc  </p>
                    <p class="busket__info-item text-danger" >Summa :  <?= session('totalItem')?? 0 ?> hrn </p>
                </div>
            </div>
        </div>



    </div><!-- conteiner -->
</nav>