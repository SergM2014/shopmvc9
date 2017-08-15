class Helper {

    static removeBusketContentErrors() {
        let formerErrors = document.getElementById('bigBusketContent').querySelectorAll('td.has-error');
        for (let i = 0; i < formerErrors.length; i++) {
            formerErrors[i].classList.remove('has-error');
        }
    }

    static drawWaitingScreen()
        {
            let waitingBlock = `
                    <div class="waiting-block" id="waitingBlock">
                        <img class="waiting-img" src="/img/loading.gif" alt="">
                    </div>
                `;
            document.body.insertAdjacentHTML('afterBegin', waitingBlock)
        }

    static removeWaitingscreen() {
            if (document.getElementById('waitingBlock')) document.getElementById('waitingBlock').remove();
        }
    }

//click small busket to see big
document.getElementById('busket-container').addEventListener('click', function(e){

    axios({
        method:'post',
        url: '/busket/show',
        withCredentials: true,
    })
        .then(response => document.getElementById('bigBusketContent').innerHTML = response.data )

});

document.body.addEventListener('click', function(e){

    if(e.target.id === "updateBusketBtn") {
        busketVue.$options.methods.update();
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

                Helper.removeBusketContentErrors();

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


        Helper.drawWaitingScreen();

        let name= document.getElementById('name').value;
        let email = document.getElementById('email').value;
        let phone = document.getElementById('phone').value;


        axios.post('/busket/makeOrder',{
           email,
           phone,
           name,
           withCredentials: true

    })
        .then(function(response) {



        let response1 = response.data;

        if (response1.success) {
            document.body.classList.remove('modal-open');
            document.getElementById('bigModal').classList.remove('in');
            document.getElementById('bigModal').style.display = 'none';
            document.querySelector('.modal-backdrop').remove();


            fetch('/updateSmallBusket', {
                method: 'POST',
                credentials: 'same-origin'
            })

                .then(response => response.json())
                .then(json => {
                    if (!json.success) return;
                    document.getElementById('totalAmount').innerText = json.totalAmount;
                    document.getElementById('totalSumma').innerText = json.totalSumma;

// output success message

                    return  fetch('/succeededOrder', {
                        method: 'POST',
                        credentials: 'same-origin'
                    })
                        .then(response => response.text())
                        .then(html => {
//remove waiting screen
                            Helper.removeWaitingscreen();
                            document.querySelector('.content').insertAdjacentHTML('afterBegin', html);
                        })
                })
// here sending email


            }
        })
        .catch((error) => {
            Helper.removeWaitingscreen();
         let errors = error.response.data;


        for(let i in errors){
        //errors[i] returns name of the property
        //errors[i][0] returns value of thre property
        document.getElementById(i).closest('.form-group').classList.add('has-error');
        document.getElementById(i+'HelpBlock').innerText = errors[i][0];
        }
        })

    }



});




//remove errors from inputs form
document.body.addEventListener('keyup', function(e){

    if(e.target.classList.contains('form-control')){

       let parentForm = e.target.closest('.form-group');
       parentForm.classList.remove('has-error');
      if( parentForm.querySelector('.help-block')) parentForm.querySelector('.help-block').innerText ='';

    }

});





 let busketVue = new Vue({

    el:'#bigBusketContent',
    data:{
       // busketContent:{}

    },
    methods:{
        update(){

           this.bindInputsFields();

            axios({
                url: '/busket/update',
                method: 'post',
                withCredentials:true,
                data:{
                    busketContent:this.busketContent
                }
            })

                    .then(response => document.getElementById('bigBusketContent').innerHTML = response.data )
                    .then(() =>{ return axios({
                                url:'/updateSmallBusket',
                                method: 'POST',
                                withCredentials:true
                                })
                             })

                    .then(response => {
                       if(response.status !== 200) return;
                        document.getElementById('totalAmount').innerText = response.data.totalAmount;
                        document.getElementById('totalSumma').innerText = response.data.totalSumma;
                    })
                .catch(errors => Errors.console(errors))

        },
        bindInputsFields(){

           this.busketContent = {};


            let inputs = document.getElementById('bigBusketContent').querySelectorAll('.busketInputs');

            for(let i=0; i< inputs.length; i++){
                this.busketContent[inputs[i].dataset.id] = inputs[i].value;

                    inputs[i].setAttribute('v-model',`busketContent[${i}]` );

                }
        }
    }




});


