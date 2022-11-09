import {noJump} from "./noJump";

function modal(modal, modalActiveClass, triggers, modalClose) {
    const triggers_ = document.querySelectorAll(triggers),
        modal_ = document.querySelector(modal),
        modalClose_ = document.querySelector(modalClose);

    if (triggers_.length > 0) {
        triggers_.forEach(item => {
            item.addEventListener('click', () => {
                modal_.classList.add(modalActiveClass);
                document.body.style.overflow = 'hidden';
                noJump()
            });
        });

        modalClose_.addEventListener('click', () => {
            modal_.classList.remove(modalActiveClass);
            document.body.style.overflow = '';
            document.body.style.marginRight = '0px';
        });

        modal_.addEventListener('click', (e) => {
            if (e.target.classList.contains('modal__container')) {
                modal_.classList.remove(modalActiveClass);
                document.body.style.overflow = '';
                document.body.style.marginRight = '0px';
            }
        });
    }
    console.log(triggers_)
}

export {modal}
