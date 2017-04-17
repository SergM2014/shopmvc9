let intervalFlow ;
let scrollingSpeed = 200;/*10,*. скорость, чем больше значние, тем медленнее движение*/
let scrollingDirect = -1;
let scrollPosition =0;
let container = document.getElementById('scroller_container');



class Scroller {

    static  wheel(e) {
        e.stopPropagation();
        e.preventDefault();
        Scroller.stop();

        let wheelData = e.detail ? e.detail * -1 : e.wheelDelta / 40;

        // В движке WebKit возвращается значение в 100 раз больше
        if (Math.abs(wheelData) > 100) {
            wheelData = Math.round(wheelData / 100);
        }

        scrollingDirect=wheelData>0?1:-1;
        Scroller.scroll(scrollingDirect);

    }

    // движение карусели вправо влево
    static scroll(wheel) {

        let div = container.firstElementChild;
        let the_first, the_last, width;
        scrollPosition += wheel;//add1 point causes gradual moovement to the right or to the left

        scrollPosition += wheel;

        if (wheel>0) {
            if (scrollPosition >= 0) { // берем последнюю картинку и вставляем ёё в начало

                // В этот момент можно подгружать более левую картинку и удалить последнюю
                the_first=div;//.firstElementChild; // контейнер с картинками
                the_last=the_first.lastElementChild; // последняя картинка вместе с анкором
                width= the_last.firstElementChild.clientWidth; // размер картинки
                the_first.insertBefore(the_last,the_first.firstElementChild);
                scrollPosition-=width;
            }
        }
        else {
//console.log('wheel is < 0');
            the_first = div;//.firstElementChild; // контейнер с картинками

            the_last = the_first.firstElementChild; // первая картинка вместе с анкором
            width = the_last.firstElementChild.clientWidth; // размер картинки
            if(scrollPosition < -width){ // если картинка ушла влево из зоны видимости переношу её в конец списка

                // В этот момент можно подгружать следующую картинку и удалить первую
                the_first.appendChild(the_last);

                scrollPosition+=width;//пысля того як первый рисунок переставленный назад обнуяеться

                //тобто зменшуеться до  -1
            }
        }
        div.style.left = scrollPosition + 'px';
    }

    // Остановка скроллера
    static  stop () {

        if (intervalFlow != null) {
            clearInterval(intervalFlow);
            intervalFlow = null;
        }
    }


    static init(){

        intervalFlow = setInterval(Scroller.scroll.bind(Scroller, scrollingDirect), scrollingSpeed);
    }


}//end of the lass


//setTimeout(scroller.init(), 100);
container.addEventListener('mousewheel', Scroller.wheel);
Scroller.stop();

Scroller.init();

container.addEventListener('mousemove', Scroller.stop.bind(Scroller));

container.addEventListener('mouseout', Scroller.init.bind(Scroller) );