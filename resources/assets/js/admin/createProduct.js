require('./bootstrap');
require('./uploadImages');


import Sortable from 'sortablejs'

let el = document.getElementById('imagesContainer');
let sortable = Sortable.create(el, {

    onUpdate:  (e)=> {
        let imagesList = document.querySelectorAll('.product-tn_image-container');
        let images = [];
        for(let i =0; i<imagesList.length; i++){
            images.push(imagesList[i].dataset.image);
        }
        document.getElementById('imagesData').value = images;
    }
});

