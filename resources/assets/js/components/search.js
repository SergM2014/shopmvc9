document.getElementById('search-field').addEventListener('keydown', function(){


    let form = new FormData;

    let search = document.getElementById('search-field').value;
    form.append('search', search);

    fetch('/createSearchResultBlock',{
        method: 'POST',
        credentials:'same-origin'

    })
        .then(response => response.text())
        .then(html =>{
           if(document.getElementById('searchResultsBlock')){ document.getElementById('searchResultsBlock').innerHTML = '';

           }
           else {
               document.getElementById('search-field__container').insertAdjacentHTML('afterBegin', html)
           }
           return fetch('/searchResults',{
              method:'POST',
              credentials:'same-origin',
               body:form
           })
        })
        .then(response =>response.text())
        .then(html => {
            if(document.getElementById('searchResultsBlock').classList.contains('hidden-outside')) {
                document.getElementById('searchResultsBlock').classList.remove('hidden-outside')
            }
            document.getElementById('searchResultsBlock').innerHTML = html;
        })






});


document.body.addEventListener('click', function(e){
   if(!e.target.closest('#search-field__container') ){
       if(document.getElementById('searchResultsBlock')){
           document.getElementById('searchResultsBlock').classList.add('hidden-outside');
           setTimeout(function(){document.getElementById('searchResultsBlock').remove()}, 500);
       }
   }
});