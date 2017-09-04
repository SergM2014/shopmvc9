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


     static  updateSmallBusket(){
            return axios({
                url:'/updateSmallBusket',
                method: 'POST',
                withCredentials:true
            })

            .then(response => {
                if(response.status !== 200) return;
                document.getElementById('totalAmount').innerText = response.data.totalAmount;
                document.getElementById('totalSumma').innerText = response.data.totalSumma;
            })
        }
    }

//click small busket to see big is opened by bootsrap
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
        busketVue.$options.methods.makeOrder();
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

        busketVue.$options.methods.submitOrder();
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
                    .then(() =>
                              Helper.updateSmallBusket()
                             )


                .catch(errors => Errors.console(errors))

        },
        bindInputsFields(){

           this.busketContent = {};


            let inputs = document.getElementById('bigBusketContent').querySelectorAll('.busketInputs');

            for(let i=0; i< inputs.length; i++){
                this.busketContent[inputs[i].dataset.id] = inputs[i].value;

                    inputs[i].setAttribute('v-model',`busketContent[${i}]` );

                }
        },

        makeOrder(){
           this.bindInputsFields();
            axios({
                url:'/validateBusket',
                method: 'post',
                withCredentials:true,
                data:{
                    busketContent:this.busketContent
                }
            })

                .then( json => {

                    Helper.removeBusketContentErrors();

                    if(json.data.fail){
                        let errors = json.data.errors;
                        for(let i=0; i< errors.length; i++){
                            document.getElementById(`id_${errors[i]}`).closest('td').classList.add( 'has-error')
                        }
                        return;
                    }

                    if(json.data.success){

//find inputs an and add readonly attr

                        let inputFields = document.getElementById('bigBusketContent').querySelectorAll('input');
                        for (let i=0; i<inputFields.length; i++){
                            inputFields[i].setAttribute('readonly', true);
                        }

                        return axios({
                            url:'/showOrderForm',
                            method:'post',
                            withCredentials:true
                        })
                    }
                })

                .then(response => {
                        document.getElementById('bigBusketContent').insertAdjacentHTML('beforeEnd', response.data);
                        document.getElementById('bigBusketFooter').classList.add('hidden');
                    }
                )

                .catch(errors => Errors.console(errors))
        },

        submitOrder(){

            Helper.drawWaitingScreen();

            // axios.post('/busket/makeOrder',{
            //     email:document.getElementById('orderForm').querySelector('#name').value,
            //     phone:document.getElementById('orderForm').querySelector('#email').value,
            //     name:document.getElementById('orderForm').querySelector('#phone').value,
            //     withCredentials: true
            //
            // })

            axios({
                url:'/busket/makeOrder',
                method:'post',
                data:{
                    email:document.getElementById('orderForm').querySelector('#email').value,
                    phone:document.getElementById('orderForm').querySelector('#phone').value,
                    name:document.getElementById('orderForm').querySelector('#name').value,
                }
            })

                .then((response) => {

                    if (response.status === 200) {
                        document.body.classList.remove('modal-open');
                        document.getElementById('bigModal').classList.remove('in');
                        document.getElementById('bigModal').style.display = 'none';
                        document.querySelector('.modal-backdrop').remove();


                        Helper.updateSmallBusket()

                            .then(() => {
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


        }





});


