window.axios = require('axios');


function removeBusketContentErrors(){
    let formerErrors = document.getElementById('bigBusketContent').querySelectorAll('td.has-error');
    for (let i=0; i<formerErrors.length; i++){
        formerErrors[i].classList.remove('has-error');
    }
}


document.getElementById('busket-container').addEventListener('click', function(e){

    fetch('/busket/show', {
        method: 'POST',
        credentials: 'same-origin',

    })
        .then( response => response.text())
        .then(text => document.getElementById('bigBusketContent').innerHTML = text )

});

document.body.addEventListener('click', function(e){

    if(e.target.id==="updateBusketBtn"){

        let form = new FormData(document.getElementById('bigBusketContent'));

        fetch('/busket/update', {
            method: 'POST',
            credentials: 'same-origin',
            body: form

        })
            .then( response => response.text())
            .then(text => document.getElementById('bigBusketContent').innerHTML = text )
            .then(() =>{ return fetch('/updateSmallBusket', {
                method: 'POST',
                credentials: 'same-origin'
                                            })
                     })
            .then( response => response.json())
            .then(json => {
               if(!json.success) return;
                document.getElementById('totalAmount').innerText = json.totalAmount;
                document.getElementById('totalSumma').innerText = json.totalSumma;
            })
    }


    if(e.target.id === "makeOrder"){

        let form = new FormData(document.getElementById('bigBusketContent'));

        fetch('/validateBusket', {
            method: 'POST',
            credentials: 'same-origin',
            body: form
        })
            .then( response => response.json())
            .then( json => {

                let formerErrors = document.getElementById('bigBusketContent').querySelectorAll('td.has-error');
                for (let i=0; i<formerErrors.length; i++){
                    formerErrors[i].classList.remove('has-error');
                }

                if(json.fail){
                    let errors = json.errors;
                   for(let i=0; i< errors.length; i++){
                       document.getElementById(`id_${errors[i]}`).closest('td').classList.add( 'has-error')
                   }
                   return;
                }

                if(json.success){

//find inputs an and add readonly attr

                    let inputFields = document.getElementById('bigBusketContent').querySelectorAll('input');
                    for (let i=0; i<inputFields.length; i++){
                        inputFields[i].setAttribute('readonly', true);
                    }

                    return  fetch('/showOrderForm', {
                        method: 'POST',
                        credentials: 'same-origin',
                        body: form
                    })
                }
            })

//output json form
            .then( response => response.text() )
            .then(html => {
                document.getElementById('bigBusketContent').insertAdjacentHTML('beforeEnd', html);
                document.getElementById('bigBusketFooter').classList.add('hidden');
              }
            )

            .catch(error => console.log('busket content errors'))
    }


    if(e.target.id === "canselOrder") {
        document.getElementById('orderForm').remove();
        document.getElementById('bigBusketFooter').classList.remove('hidden');
        let inputFields = document.getElementById('bigBusketContent').querySelectorAll('input');
        for (let i=0; i<inputFields.length; i++){
            inputFields[i].removeAttribute('readonly');
        }
    }


    if(e.target.id === "submitOrder") {

        let form = new FormData(document.getElementById('orderForm'))

        axios.post('/busket/makeOrder',  {
            credentials: 'same-origin',
            body: form
            })
            .then(function(response) {
                console.log(response.data);

            })
            .catch((error) => {
                let errors = error.response.data;

                for(let i in errors){
//errors[i] returns name of the property
//errors[i][0] returns value of thre property
                    document.getElementById(i).closest('.form-group').classList.add('has-error');
                    document.getElementById(i+'HelpBlock').innerText = errors[i][0];
                }
            })

    }



})


//remove errors from inputs form
document.body.addEventListener('keyup', function(e){

    if(e.target.classList.contains('form-control')){

       let parentForm = e.target.closest('.form-group');
       parentForm.classList.remove('has-error');
      if( parentForm.querySelector('.help-block')) parentForm.innerText ='';

    }

})