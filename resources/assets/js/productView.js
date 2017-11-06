require('./bootstrap');
require('./components/ekko-lightbox');
require('./components/uploadImage');

$(document).on('click', '[data-toggle="lightbox"]', function(event) {
    event.preventDefault();
    $(this).ekkoLightbox();
});


document.body.addEventListener('click', function(e){


//refresh captcha by clicking
    if(e.target.closest('#captchaImg')){
        axios({
            url:'/refreshCaptcha',
            method: 'post',
            withCredentials:true,
        })
            .then(response => document.getElementById('captchaImg').innerHTML= response.data )
            .catch(error => console.log(error))
    }


    if(e.target.classList.contains('give_response-btn')){

        let commentId = e.target.dataset.commentId;
//populate hiden parentId field
        document.getElementById('parentId').value = commentId;

        axios({
            url:'/getCommentForResponse',
            method: 'post',
            withCredentials:true,
            data:{
                parentId:e.target.dataset.parentId,
                productId:document.getElementById('productId').value,
                commentId:commentId
            }
        })
        .then(response => document.getElementById('parentCommentBlock').innerHTML = response.data)

    }

    if(e.target.id === "closeParentComment"){
        document.getElementById('parentCommentBlock').innerHTML = '';
        document.getElementById('parentId').value = 0;
    }

});//this is end of the body

new Vue({
    el:'#purchaseForm',
    methods:{
        addToBusket(){

            axios({
                url:'/busket/add',
                method: 'post',
                withCredentials:true,
                data:{
                    _token:document.getElementsByName('_token')[0].value,
                    id:document.getElementsByName('id')[0].value,
                    price:document.getElementsByName('price')[0].value
                }
            })
                .then(response => {

                    if(response.status !== 200) return;

                    document.getElementById('totalAmount').innerText = response.data.totalAmount;
                    document.getElementById('totalSumma').innerText = response.data.totalSumma
                })


        }
    }


});

new Vue({
    el:'#productCommentForm',

    data:{
        name:'',
        email:'',
        comment:'',
        captcha:''
    },

    methods:{
        makeComment(){
            axios.post('/comment/add', {
                _token:document.getElementsByName('_token')[0].value,
                ajax:true,
                product_id:document.getElementById('productId').value,
                parent_id:document.getElementById('parentId').value,
                avatar:document.getElementById('image').value,
                email:this.email,
                name:this.name,
                comment:this.comment,
                captcha:this.captcha,
            })
                .then((response) => {

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

    }
})