document.body.addEventListener('click', function(e){

//click otside search container group
   if(!e.target.closest('#search-field__container') ){
       searchVue.removeSearchResultsBlock();
   }


});


let searchVue =  new Vue({

    el:'#search-field__container',

    data: {
        search:'',
        showBlock:false,
        hiddenOutside:true
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