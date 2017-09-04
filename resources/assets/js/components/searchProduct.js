document.body.addEventListener('click', function(e){

//click otside search container group
   if(!e.target.closest('#search-field__container') ){
       searchVue.removeSearchResultsBlock();
   }




    if(e.target.closest('.search-results-item')){
        let previewProductId = e.target.closest('.search-results-item').dataset.previewproductId;

        searchVue.removeSearchResultsBlock();

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
            .then(response =>{
                document.getElementById('previewProductContainer').innerHTML = response.data;
                searchVue.previewVisible = true;
            } )
            .catch(error => console.log(error))

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



let searchVue =  new Vue({

    el:'#search-field__container',

    data: {
        search:'',
        showBlock:false,
        hiddenOutside:true,
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
                    this.hiddenOutside = false;
                    document.getElementById('searchResultsBlock').innerHTML = response.data;
                })
                .catch(response =>Errors.console(response));
        },

        removeSearchResultsBlock()
        {
            this.hiddenOutside = true;
             setTimeout(function(){this.showBlock = false }, 500);
        }

    }

});