require('./bootstrap');

require('./vueComponents');

 let commentsContainer = new Vue({
    el:'#commentsContainer',
    data:{
        width:100,
        height:60,
        showPopupMenu:false,
        showModalBackground:false,
        showAlert:false,

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

            let id = e.target.closest('li').dataset.commentId;
            let formData = new FormData;
            formData.append('id', id);


            fetch( '/admin/comments/popupMenu',{
                method: 'post',
                credentials:'same-origin',
                body:formData
            })
                .then(response => response.text())
                .then(html =>document.getElementById('popupMenu').innerHTML= html);

        },

        showModalWindow(commentId)
        {
             this.showModalBackground = true;
             this.showPopupMenu = false;
            axios({
                method:'post',
                url:'/admin/comments/confirmWindow',
                withCredentials: true,
                data:{
                    id:commentId
                }
            })
                .then(function(response) {
                    document.getElementById('modalBackground').innerHTML = response.data
                })
        },

        deleteComment()
        {
            document.getElementById('commentDeleteForm').submit();
            document.getElementById('confirmDeleteCommentBtn').setAttribute('disabled', 'disabled');
        },

        publishComment(id)
        {
           let publishCluster =  new FormData(document.getElementById('commentPublishForm'));
            axios({
                method:'post',
                url:`/admin/comments/${id}/publish`,
                withCredentials:true,
                data:publishCluster
            })
                .then(response => {
                    this.showPopupMenu = false;
                    if(response.data.success) {

                        console.log(response.data);

                        let publishedMessage = document.querySelector(`[data-comment-id-published="${id}"]`);
                        publishedMessage.innerHTML = "<h4 class='text-success'>Published </h4>";
                        this.showAlert = true;
                        document.getElementById('alertText').innerText = response.data.message;
                    } else {
//prozess error
                        console.log('something went.wrong')
                    }
                })
        },

        unpublishComment()
        {
            document.getElementById('commentUnpublishForm').submit();
        }
    }
});


document.body.addEventListener('click', function(e){

//remove products poup if click outside the table
    if(!e.target.closest('#commentsContainer')) {
        commentsContainer.showPopupMenu = false;
    }
//show confirm delete product Window
    if(e.target.id ==='commentDeleteBtn'){
        let commentId = e.target.dataset.commentId;

        commentsContainer.showModalWindow(commentId)
    }
// cansel the action that demand a confirmation
    if(e.target.id === "canselBtn" || e.target.id === "modalBackground"){
        commentsContainer.showModalBackground = false;
    }
//confirm delete of the product
    if(e.target.id === "confirmDeleteButtonBtn"){
        commentsContainer.deleteComment;
    }


    if(e.target.id === "commentPublishBtn"){
        commentsContainer.publishComment(e.target.dataset.commentId);
    }

    if(e.target.id === "closeCommentAlert"){
        commentsContainer.showAlert = false;
    }

});

