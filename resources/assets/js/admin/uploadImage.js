
// find repeated values in two arrays
Array.prototype.intersect = function(a){
    return this.filter(function(i){ return a.indexOf(i) > -1;});
};



let progress = document.getElementById('imageDownloadProgress'),
    output = document.getElementById('imageDownloadOutput'),
    submit_btn = document.getElementById('downloadImageBtn'),
    reset_btn = document.getElementById('resetImageBtn'),
    delete_img_sign = document.getElementById('deleteImagePreview'),
    imageField =  document.getElementById('file'),
    imageFormField = document.getElementById('imagesData');




// this background is for imageupload

function progressHandler(event){

    let percent=Math.round((event.loaded/event.total)*100);

    progress.value = percent;
    // progress.innerText= percent+"%";
}

function completeHandler(event){

    let response = JSON.parse(event.target.responseText);
    output.innerHTML= response.message;

    progress.value = 0;
   // output.classList.remove('hidden');

    progress.classList.add('hidden');
    reset_btn.removeAttribute('disabled');


    //further work with many images;
     populateImagesField(response.filename);




}


function errorHandler(event){

    output.innerHTML= 'Upload failed';
}


function abortHandler(event){

    output.innerHTML= 'Upload aborted';
}


function populateImagesField(filename) {


    let imagesListArray = document.getElementById('imagesData').value;

    if(!imagesListArray) {imagesListArray = []}
    else{
        imagesListArray = imagesListArray.split(',');
    }

    imagesListArray.push(filename);
    document.getElementById('imagesData').value = imagesListArray;

}





//to make previe image using file API


if(document.getElementById('file')) {
    document.getElementById('file').onchange = function () {

        if(delete_img_sign) delete_img_sign.className = 'hidden';

        let input = this;

        if (input.files && input.files[0]) {
            if (input.files[0].type.match('image.*')) {
                let reader = new FileReader();

                reader.onload = function (e) {
                    document.getElementById('downloadImagePreview').setAttribute('src', e.target.result);
                };
                reader.readAsDataURL(input.files[0]);

                document.getElementById('file').classList.add('hidden');

                //output.classList.add('hidden');

                reset_btn.classList.remove('hidden');

                submit_btn.classList.remove('hidden');

            }// else console.log('is not image mime type');
        }// else console.log('not isset files data or files API not supordet');

    };//end of function


}



if(submit_btn){
    submit_btn.onclick = function(e){

        e.preventDefault();
        progress.classList.remove('hidden');


        let file = document.getElementById("file").files[0];

        let formdata = new FormData();

        formdata.append("file", file);

        formdata.append("ajax", true);

        let uploadUrl = "/images/uploadProductImage";

        let send_image=new XMLHttpRequest();
        send_image.upload.addEventListener("progress", progressHandler, false);
        send_image.addEventListener("load", completeHandler, false);
        send_image.addEventListener("error", errorHandler, false);
        send_image.addEventListener("abort", abortHandler, false);
        send_image.open("POST", uploadUrl);
        send_image.send(formdata);

       // document.getElementById('downloadImagePreview').setAttribute('src', '/img/nophoto.jpg');
        reset_btn.setAttribute('disabled', 'disabled');
       // reset_btn.classList.add('hidden');
        submit_btn.classList.add('hidden');

        document.getElementById('file').classList.remove('hidden');
       // document.getElementById('file').value = '';
        document.getElementById('file').classList.add('hidden');



    };// end of submit button
}



if(reset_btn) {
    reset_btn.onclick = function (e) {
        e.preventDefault();


        document.getElementById('downloadImagePreview').setAttribute('src', '/img/nophoto.jpg');
        document.getElementById('file').classList.remove('hidden');
        let formData = new FormData;

        formData.append('ajax', true);


        if(document.getElementById('image')) formData.append('image', document.getElementById('image').value);



                fetch( '/images/deleteProductImage',
                    {
                        method : "POST",
                        credentials: "same-origin",
                        body:formData
                    })


            .then(responce => responce.json())
            .then(j => { output.innerHTML = j.message;
                if(output.classList.contains('hidden')) {
                    output.classList.remove('hidden')
                }
                imageField.value = '';

            });



        submit_btn.classList.add('hidden');
        reset_btn.classList.add('hidden');
        if(document.getElementById('image')) document.getElementById('image').value = '';
        imageFormField.value = '';

    };
}
//end of image reset



