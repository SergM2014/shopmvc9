require('./bootstrap');
require('./components/ekko-lightbox');

$(document).on('click', '[data-toggle="lightbox"]', function(event) {
    event.preventDefault();
    $(this).ekkoLightbox();
});


document.body.addEventListener('click', function(e){

    if(e.target.id === "purchase"){

        e.preventDefault();

        let form = new FormData(document.getElementById('purchaseForm'));



        fetch('/busket/add', {
            method: 'POST',
            credentials: 'same-origin',
            body: form
        })
            .then( response => response.json())
            .then(json => {
                if(!json.success) return;
                document.getElementById('totalAmount').innerText = json.totalAmount;
                document.getElementById('totalSumma').innerText = json.totalSumma
            })
    }


});//this is end of the body