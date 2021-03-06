require('./bootstrap');

require('./vueComponents');

let usersContainer = new Vue({
    el:'#usersContainer',
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

            let id = e.target.closest('li').dataset.userId;
            let formData = new FormData;
            formData.append('id', id);


            fetch( '/admin/users/popupMenu',{
                method: 'post',
                credentials:'same-origin',
                body:formData
            })
                .then(response => response.text())
                .then(html =>document.getElementById('popupMenu').innerHTML= html);

        },

        showModalWindow(userId)
        {
            this.showModalBackground = true;
            this.showPopupMenu = false;
            axios({
                method:'post',
                url:'/admin/users/confirmWindow',
                withCredentials: true,
                data:{
                    id:userId
                }
            })
                .then(function(response) {
                    document.getElementById('modalBackground').innerHTML = response.data
                })
        },

        deleteUser()
        {
            document.getElementById('userDeleteForm').submit();
            document.getElementById('confirmDeleteUserBtn').setAttribute('disabled', 'disabled');
        }
    }
});



document.body.addEventListener('click', function(e){

//remove users poup if click outside the table
    if(!e.target.closest('#usersContainer')) {
        usersContainer.showPopupMenu = false;
    }
//show confirm delete user Window
    if(e.target.id ==='userDeleteBtn'){
        let userId = e.target.dataset.userId;

        usersContainer.showModalWindow(userId)
    }
// cansel the action that demand a confirmation
    if(e.target.id === "canselBtn" || e.target.id === "modalBackground"){
        usersContainer.showModalBackground = false;
    }
//confirm delete of the user
    if(e.target.id === "confirmDeleteUserBtn"){
        usersContainer.deleteUser();
    }

});