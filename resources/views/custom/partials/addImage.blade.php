<div class="image-download__block">

    <img src="/img/nophoto.jpg" alt="" id="downloadImagePreview" class="image-download__preview">

    <div id="imageDownloadOutput" class="image-download__output"></div>


    <form enctype="multipart/form-data">

        <div class="form-group">
            {{--<label for="exampleInputFile">File input</label>--}}

            <input type="file" name="file" id="file" class="<?= @$givenImage? "hidden": "" ?>">
            {{--<p class="help-block">Example block-level help text here.</p>--}}
        </div>



        <button type="button" id="downloadImageBtn" class="image-download__btn hidden">@lang('messages.load')</button>
        <button type="button" id="resetImageBtn" class="image-download__btn <?= !@$givenImage? "hidden":'' ?>">@lang('messages.delete')</button>
    </form>

    <progress max="100" value="0" id="imageDownloadProgress"  class="image-download__progress hidden" >

    </progress>





</div>