document.body.addEventListener('click', function(e){
   if(!e.target.closest('#search-field__container') ){
       searchVue.removeSearchResultsBlock();
   }


});



let searchVue =  new Vue({

    el:'#search-field__container',

    data: {
        search:''
    },

    methods: {

        drawResultsBlock(){
            axios({
                method:'post',
                url:'/createSearchResultBlock',
                withCredentials: true,
            })
                .then(html => {
                    if (document.getElementById('searchResultsBlock')) {
                        document.getElementById('searchResultsBlock').innerHTML = 'Searching now...';
                    }
                    else {
                        document.getElementById('search-field__container').insertAdjacentHTML('afterBegin', html.data)
                    }

                })
                .catch(response => Errors.console(response));
        },


        findResults(){

            this.drawResultsBlock();
            axios({
                method: 'post',
                url:'/searchResults',
                withCredentials: true,
                data:{
                    search: this.search
                }
            })
                .then(response => {
                    if (document.getElementById('searchResultsBlock').classList.contains('hidden-outside')) {
                        document.getElementById('searchResultsBlock').classList.remove('hidden-outside')
                    }
                    document.getElementById('searchResultsBlock').innerHTML = response.data;
                })
                .catch(response =>Errors.console(response));
        },

        removeSearchResultsBlock()
        {
            if(document.getElementById('searchResultsBlock')){
                document.getElementById('searchResultsBlock').classList.add('hidden-outside');
                setTimeout(function(){document.getElementById('searchResultsBlock').remove()}, 500);
            }
        }

    }

});