class Slider {

    constructor()
    {
//get amount of slider

        this.slider_number = document.getElementById('slider').querySelectorAll('.slider_image').length;

    }


    static toggleImage(id)//спочатку получаемо цифру 1
    {
        let currentElem = document.getElementById(id);
        let currentElemHeight = Slider.getElemHeight(currentElem);//получаем высоту элемента
        let titleElems = currentElem.getElementsByTagName('*');//елкмкнты що маються в теге содержащиго картинку


        if (currentElem.classList.contains('notdisplayed')) {
//hide bottom title
            for (let i = 0; i < titleElems.length; i++) {
                titleElems[i].classList.add('unvisible');
            }
            //для visibility
            currentElem.style.height = "1px";
            currentElem.classList.remove('notdisplayed');

            //image will be larging(sliding down)
            for (let i = 0; i <= 100; i += 5) {
                (function () {
                    let pos = i;
                    setTimeout(function () {
                        currentElem.style.height = (pos / 100) * currentElemHeight + 1 + "px";
                    }, pos * 5);
                })();
            }

//botom titel elems are shown

            setTimeout(function () {
                for (let i = 0; i < titleElems.length; i++) {
                    titleElems[i].classList.remove('unvisible');
                }
            }, 500);

        }
        else { //reduce slider image(sliding up)

            let theHeight = currentElemHeight - 1 + "px";


            for (let i = 0; i < titleElems.length; i++) {
                titleElems[i].classList.add('unvisible');
            }

            for (let i = 100; i >= 0; i -= 5) {
                (function () {
                    let pos = i;
                    setTimeout(function () {
                        currentElem.style.height = (pos / 100) * currentElemHeight + "px";
                        if (pos <= 0) {
                            currentElem.classList.add('notdisplayed');
                            currentElem.style.height = theHeight;

                        }
                    }, 1000 - (pos * 5));
                })();
            }

            // currentElem.classList.add('notdisplayed');

        }

    }


    static getElemHeight(slider)
    {

        let elemHeight;

        //let currentElem = document.getElementById(id);

        if (slider.classList.contains('notdisplayed')) {

            slider.classList.add('unvisible');

            slider.classList.remove('notdisplayed');

            elemHeight = slider.clientHeight || slider.offsetHeight + 5; // Высота

            slider.classList.add('notdisplayed');

            slider.classList.remove('unvisible');
        }
        else {

            elemHeight = slider.clientHeight || slider.offsetHeight + 5; // Высота

        }

        return elemHeight;
    }



    startSliding(now, last)
    {
        let newnow;
//if thelast slider than reset nex slider to number 1
        if (now === this.slider_number) {
            newnow = 1;
        } else {
            newnow = (Number(now) + 1);
        }

//if the only one slider exists than always 1
        if (this.slider_number === 1) newnow = 1;

//hidr(slideup) the last active slider
        if (last !== 0) {
            Slider.toggleImage(last);
        }

        setTimeout(function () {
            Slider.toggleImage(now);
        }, 1000);//запустыть функцию через промежуток

        setTimeout(function () {
            new Slider().startSliding(newnow, now);
        }, 6000);
    }

}



window.onload = new Slider().startSliding('1', '0');
