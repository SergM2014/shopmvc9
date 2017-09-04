// document.getElementById('search-field__container').addEventListener('click', function(e){
//
//     if(e.target.closest('.search-results-item')){
//         let previewProductId = e.target.closest('.search-results-item').dataset.previewproductId;
//
//
// //hide search result block
//         if(document.getElementById('searchResultsBlock')){
//             document.getElementById('searchResultsBlock').classList.add('hidden-outside');
//             setTimeout(function(){document.getElementById('searchResultsBlock').remove()}, 500);
//         }
//
//
//         let previewProductContainer = document.createElement('section');
//         previewProductContainer.id = "previewProductContainer";
//         previewProductContainer.className = 'preview-product__container';
//         document.body.prepend(previewProductContainer);
//
//         let background = document.createElement('div');
//         background.className = "body-background";
//         //document.body.prepend(background);
//         document.getElementById('search-field__container').prepend(background);
//
//
//     let form = new FormData;
//     form.append('id',  previewProductId);
//
//     fetch('/showProductPreview', {
//         method:'POST',
//         credentials:'same-origin',
//         body:form
//     })
//         .then(response => response.text())
//         .then(html => previewProductContainer.innerHTML = html)
//         .catch(error => console.log(error))
//
//     }
//
//
//
//
//
// });
//
// document.body.addEventListener('click', function(e){
//
// //click close btn delete product preview
//     if(e.target.id === 'productPreviewResetBtn' ) {
//         document.querySelector('.body-background').remove();
//         document.getElementById('previewProductContainer').remove();
//     }
// //click background delete product preview
//     if(e.target.closest('.body-background')  ){
//         document.querySelector('.body-background').remove();
//         document.getElementById('previewProductContainer').remove();
//     }
//
//
// });