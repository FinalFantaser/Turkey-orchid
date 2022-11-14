import './bootstrap';
import './vue';

import burger from "./assets/burger";
import {video} from "./assets/video";
import {modal} from "./assets/modal";
import tabs from "./assets/tabs";

burger();
modal('.modal-main', 'modal--active', '[data-modal]', '.modal-main__close');
video('.main__play', '#video', '.modal-video', '.modal-video__close');
tabs()
