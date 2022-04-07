require('./bootstrap');

require('./vueComponents');

 let productsTable = new Vue({
    el:'#productsTableContainer',
    data:{
        width:100,
        height:60,
        showPopupMenu:false,
        showModalBackground:false,

        screenWidth : document.body.clientWidth,
        screenHeight : document.body.clientHeight,

    },
    methods:{
        drawMenu(e){

            this.x = e.pageX;
            this.y = e.pageY;

            if(this.x+this.width >this.screenWidth+pageXOffset) this.x= (this.screenWidth+pageXOffset-this.width);
            if(this.y+this.height >this.screenHeight+pageYOffset) this.y= (this.screenHeight+pageYOffset-this.height);



            document.getElementById('popupMenu').style.left = this.x+"px";
            document.getElementById('popupMenu').style.top = this.y+"px";

            this.fillUpMenu(e);
            this.showPopupMenu = true;

        },

        fillUpMenu(e)
        {

            let id = e.target.closest('.parent_tr').dataset.productId;
            let formData = new FormData;
            formData.append('id', id);


            fetch( '/admin/products/popupMenu',{
                method: 'post',
                credentials:'same-origin',
                body:formData
            })
                .then(response => response.text())
                .then(html =>document.getElementById('popupMenu').innerHTML= html);

        },

        showModalWindow()
        {
             this.showModalBackground = true;
             this.showPopupMenu = false;
            axios({
                method:'post',
                url:'/admin/products/confirmWindow',
                withCredentials: true,
            })
                .then(function(response) {
                    document.getElementById('modalBackground').innerHTML = response.data
                })
        },

        deleteProduct()
        {
            document.getElementById('productDeleteForm').submit();
            document.getElementById('confirmDeleteProductBtn').setAttribute('disabled', 'disabled');
        }
    }
});


document.body.addEventListener('click', function(e){

//remove products poup if click outside the table
    if(!e.target.closest('#productsTableContainer')) {
        productsTable.showPopupMenu = false;
    }
//show confirm delete product Window
    if(e.target.id ==='productDeleteBtn'){
        productsTable.showModalWindow()
    }
// cansel the action that demand a confirmation
    if(e.target.id === "canselBtn" || e.target.id === "modalBackground"){
        productsTable.showModalBackground = false;
    }
//confirm delete of the product
    if(e.target.id === "confirmDeleteProductBtn"){
        productsTable.deleteProduct();
    }

});

