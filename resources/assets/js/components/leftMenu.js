document.body.addEventListener('click', function(e){

    //vertical menu slideUp/Down
    if(e.target.closest('.left-menu')){
        {
            if (!e.target.classList.contains('left-menu__contains-subcatetegories-sign')) return;

            let currentMenuItemId = e.target.closest('li').dataset.categoryId;
            let currentMenuItemParentId = e.target.closest('li').dataset.parentId;
            let parentUl = e.target.closest('ul');
            let childrenLi = parentUl.querySelectorAll('[data-parent-id="'+currentMenuItemParentId+'"]');

            if(! childrenLi) return;
            for (let i=0; i<childrenLi.length; i++){
                let ul = childrenLi[i].querySelector('ul');
                if(childrenLi[i].dataset.categoryId != currentMenuItemId){
                    if (ul){
                        ul.classList.add('hidden');
                        let sign = ul.closest('li').querySelector('.left-menu__contains-subcatetegories-sign');
                        sign.classList.remove('hidden');
                    }
                } else {
                    if(ul) {
                        ul.classList.remove('hidden');
                        let sign = ul.closest('li').querySelector('.left-menu__contains-subcatetegories-sign');
                        sign.classList.add('hidden');
                    }
                }
            }

        }
    }

});