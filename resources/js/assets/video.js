//video
function video(triggers, _video, _modalVideo, _modalVideoClose) {
    const play = document.querySelectorAll(triggers),
        video = document.querySelector(_video),
        modalVideo = document.querySelector(_modalVideo),
        modalVideoClose = document.querySelector(_modalVideoClose);

    if (video) {
        play.forEach(item => {
            item.addEventListener('click', (e) => {
                const path = e.currentTarget.getAttribute('data-video');
                modalVideo.classList.add('modal--active');
                document.body.style.overflow = 'hidden';
                video.setAttribute('src', path);
                video.play();
            });
        });

        modalVideo.addEventListener('click', (e) => {
            if (e.target.classList.contains('modal__container')) {
                modalVideo.classList.remove('modal--active');
                video.pause();
                document.body.style.overflow = '';
            }
        });
        modalVideoClose.addEventListener('click', () => {
            modalVideo.classList.remove('modal--active');
            video.pause();
            document.body.style.overflow = '';
        })
    }
}

export {video}
