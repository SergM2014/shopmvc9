Vue.component('modal-background',{
    template:`
     <div id="modalBackground" class="modal-background" ></div>
   `
});

Vue.component('popup-menu', {
    template:`
        <div id="popupMenu" class="popup-menu"></div>
    `
});

Vue.component('alert', {
   template: `
   <div id="alert" class="alert alert-success" role="alert">
        <button class="close" id="closeCommentAlert">&times;</button>
     <strong id="alertText" >Warning!</strong>
</div>
   `
});