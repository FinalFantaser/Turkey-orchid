function noJump () {
    let div = document.createElement('div');

    div.style.width = '50px';
    div.style.height = '50px';
    div.style.overflowY = 'scroll';
    div.style.visibility = 'hidden';

    document.body.appendChild(div);
    let scrollWidth = div.offsetWidth - div.clientWidth;
    div.remove();

    document.body.style.marginRight = `${scrollWidth}px`;
    document.body.style.overflow = 'hidden';
}

export {noJump}
