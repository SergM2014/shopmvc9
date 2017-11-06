@extends('layouts.master')

@section('content')

    <ol class="breadcrumb">

        <li class="active">Main</li>
    </ol>

<div class="row">

    <div class="col-sm-2">
        <ul class='left-menu'>
         {!! $categoriesVertMenu !!}
        </ul>
    </div>

    <section class="content__slider col-sm-10">


        <?php $num=1; if(!empty($sliders)): ?>
        <div id="slider">
            <?php foreach($sliders as $image): ?>
            <div class="slider_image notdisplayed" style="/*display:none;*/ background-image:  url(<?='/uploads/sliders/'.$image->image; ?>) ;" id="<?= $num;?>">

                <div class="bottom bottom_title">
                    <a href="/<?php echo $image->url; ?>">
                        <?php echo $image->title; ?>
                    </a>
                </div>

            </div><!-- slider_thumb -->
            <?php $num++; endforeach; ?>
        </div>
    <?php endif; ?>
    <!-- end of realization of slider-->



    </section>
</div>




    <section class="content__carousel ">


        <div id="scroller_container" >
            <div>
                <?php
                foreach($carousels as $image) : ?>
                      <a href="<?php echo $image->url; ?>"><img src="<?= '/uploads/carousels/'.$image->image; ?>"></a>
                <?php   endforeach ?>

            </div>
        </div>


    </section>



    <script src="{{ mix('/js/index.js') }}"></script>
@endsection