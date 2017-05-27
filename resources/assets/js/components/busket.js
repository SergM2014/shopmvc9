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

});