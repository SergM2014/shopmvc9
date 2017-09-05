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
        <div id="navbar" class="collapse navbar-collapse" id="navbar">
            <ul class="nav navbar-nav">
                <li class="{{ $currentRoute == 'index'? 'active':'' }}"><a href="/">Main</a></li>
                <li class="{{ preg_match('/^catalog/', $currentRoute )? 'active':'' }}"><a href="{{ route('catalog') }}">Catalog</a></li>
                <li class="{{ $currentRoute == 'aboutus'? 'active':'' }}"><a href="{{ route('aboutus') }}">About Us</a></li>
                <li class="{{ $currentRoute == 'downloads'? 'active':'' }}"><a href="/downloads">Downloads</a></li>
                <li class="{{ $currentRoute == 'contacts'? 'active':'' }}"><a href="/contacts">Contacts</a></li>
            </ul>


            <div class="navbar-form navbar-right">
                <div class="form-group search-field__container" id="search-field__container">

                    <results-block v-show="showBlock" id="searchResultsBlock" class="search-results__block"
                          :class="{'hidden-outside':hiddenOutside}">Searching now</results-block>



                    <product-preview v-show = "previewVisible"></product-preview>


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