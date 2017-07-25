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


    if(e.target.id === "productCommentSubmit") {

        let product_id= document.getElementById('productId').value;

        let parent_id = document.getElementById('parentId').value;

        let avatar = document.getElementById('image').value;
        let email = document.getElementById('email').value;
        let name = document.getElementById('name').value;
        let comment = document.getElementById('comment').value;
        let captcha = document.getElementById('captcha').value;


        axios.post('/comment/add', {
            product_id, parent_id, avatar, email, name, comment, captcha
        })
            .then((response) => {
            console.log(response.data);
            document.getElementById('addCommentBlock').innerHTML = `<div class="alert alert-success" role="alert">${response.data.message}</div>`;
            })
            .catch((error) => {

                let errors = error.response.data;


                for(let i in errors){
                    //errors[i] returns name of the property
                    //errors[i][0] returns value of thre property

                    document.getElementById(i).closest('.form-group').classList.add('has-error');
                    document.getElementById(i+'HelpBlock').innerText = errors[i][0];
                }
            })
    }

//refresh captcha by clicking
    if(e.target.closest('#captchaImg')){
        fetch('/refreshCaptcha',{ method: 'POST' })
            .then(response => response.text())
            .then(html => document.getElementById('captchaImg').innerHTML= html )
            .catch(error => console.log(error))
    }


    if(e.target.classList.contains('give_response-btn')){
        let parentId = e.target.dataset.parentId;
        let productId = document.getElementById('productId').value;
        let commentId = e.target.dataset.commentId;
//populate hiden parentId field
       // document.getElementById('parentId').value = parentId;
        document.getElementById('parentId').value = commentId;



        let form = new FormData;
        form.append('productId', productId);
        form.append('parentId', parentId);
        form.append('commentId', commentId);
        fetch('/getCommentForResponse', {
            method: 'POST',
            body:form,
            credentials:'same-origin'
        })
            .then(response => response.text())
            .then(html => document.getElementById('parentCommentBlock').innerHTML = html)

    }

    if(e.target.id === "closeParentComment"){
        document.getElementById('parentCommentBlock').innerHTML = '';
        document.getElementById('parentId').value = 0;
    }

});//this is end of the body

require('./components/uploadImage');