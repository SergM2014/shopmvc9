require('./bootstrap');

class PopUpMenu{
    constructor(e){
        this.x = e.pageX;
        this.y = e.pageY;

        this.screenWidth = document.body.clientWidth;
        this.screenHeight = document.body.clientHeight;
        this.target = e.target;
    }


    drawMenu(x = 100, y = 60){

        if(/*popupMenuSaved && */document.getElementById('popupMenu')){
            this.popUp = document.getElementById('popupMenu');
            this.popUp.classList.remove('hidden')
        } else {

            this.popUp = document.createElement('div');
            this.popUp.className = "popup-menu";
            this.popUp.id = "popupMenu";

            document.body.insertBefore(this.popUp, document.body.firstChild);
        }



        if(this.x+x >this.screenWidth+pageXOffset) this.x= (this.screenWidth+pageXOffset-x);
        if(this.y+y >this.screenHeight+pageYOffset) this.y= (this.screenHeight+pageYOffset-y);

        this.popUp.style.left = this.x+"px";
        this.popUp.style.top = this.y+"px";
    }

    static deleteMenu()
    {
        if(document.getElementById('popupMenu')){document.getElementById('popupMenu').remove();}
    }


    fillUpMenuContent(id, route, processContr = ''){
        this.drawMenu();

//console.log(popUpContr);
        let formData = new FormData;
        formData.append('id', id);
        formData.append('processContr', processContr);

       fetch( route,{
           method: 'post',
           credentials:'same-origin',
           body:formData
       })
            .then(response => response.text())
            .then(html =>document.getElementById('popupMenu').innerHTML= html);
    }

    static hideMenu()
    {
        if(document.getElementById('popupMenu')){
            document.getElementById('popupMenu').classList.add('hidden');


        }
    }


}

class Modal {
    static createBackground() {
        let background = document.createElement('div');
        background.className = "modal-background";
        background.id = "modalBackground";
        document.body.insertBefore(background, document.body.firstChild);
    }

    static createModalWindow(controller, formData){
        this.createBackground();
        postAjax(controller,formData)
            .then(response => response.text())
            .then(html =>document.getElementById('modalBackground').insertAdjacentHTML('afterBegin', html));
    }


}


document.getElementById('allProductsTable').addEventListener('click', function(e){

    let form = new FormData;
    let productId = e.target.closest('.parent_tr').dataset.productId;
    form.append('id', productId);

    new PopUpMenu(e).fillUpMenuContent(productId, '/productsPopUpMenu')



});

