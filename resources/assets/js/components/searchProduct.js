


document.body.addEventListener('click', function(e){

//click otside search container group
   if(!e.target.closest('#search-field__container') ){
       searchVue.showBlock = false;
   }



//click one of founded result in rusults-block
    if(e.target.closest('.search-results-item')){

        searchVue.showProductPreview(e);
    }

    //click close btn delete product preview
    if(e.target.id === 'productPreviewResetBtn' ) {
        document.getElementById('previewProductContainer').innerHTML = '';
        searchVue.previewVisible = false;

    }
//click background delete product preview
    if(e.target.closest('.body-background')  ){
        document.getElementById('previewProductContainer').innerHTML = '';
        searchVue.previewVisible = false;

    }


});





Vue.component('product-preview', {
    template: `
        <div class="body-background" id="previewProductContainer"></div>`

});


Vue.component('search-block', {
    template: `
        <div  id="searchResultsBlock" class="search-results__block">Searching now</div>
    `

});

let searchVue =  new Vue({

    el:'#search-field__container',

    data: {
        search:'',
        showBlock:false,
        previewVisible:false
    },

    methods: {

        findResults(){

            this.showBlock = true;

            axios({
                method: 'post',
                url:'/searchResults',
                withCredentials: true,
                data:{
                    search: this.search
                }
            })
                .then(response => {
                    document.getElementById('searchResultsBlock').innerHTML = response.data;
                })
                .catch(response =>Errors.console(response));
        },


        showProductPreview(e){
            let previewProductId = e.target.closest('.search-results-item').dataset.previewproductId;

            this.showBlock = false;
            this.previewVisible = true;

            let form = new FormData;
            form.append('id',  previewProductId);

            axios({
                method: 'post',
                url: '/showProductPreview',
                withCredentials: true,
                data: {
                    id: previewProductId
                }
            })
                .then((response) =>{
                    document.getElementById('previewProductContainer').innerHTML = response.data;
                } )
            .catch(error => console.log(error))
        }



    }

});