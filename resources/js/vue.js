import {createApp} from 'vue'
import {store} from "./store";

// маска для инпутов
import Maska from 'maska'

// оповещения
import Toast from "vue-toastification";
// Import the CSS or use your own!
import "vue-toastification/dist/index.css";

// components
    // index
import IndexCatalogApp from './components/client/index/Catalog.vue'
import IndexSendApp from './components/client/index/Send.vue'
    // catalog
import CatalogListApp from './components/client/catalog/CatalogList.vue'
    // other
import ModalMainApp from './components/client/ModalMain.vue'
import ModalDetApp from './components/client/ModalDet.vue'
import LoaderApp from './components/client/Loader.vue'

const app = createApp({components: {
        IndexCatalogApp,
        IndexSendApp,
        CatalogListApp,
        ModalMainApp,
        ModalDetApp,
        LoaderApp
}})

app.use(store)
app.use(Maska);

const options = {
    position: 'bottom-right'
};
app.use(Toast, options);

app.mount("#app")
