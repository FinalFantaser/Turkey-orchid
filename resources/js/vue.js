import {createApp} from 'vue'
import {store} from "./store";

// components
    // index
import IndexCatalogApp from './components/client/index/Catalog.vue'
    // catalog
import CatalogListApp from './components/client/catalog/CatalogList.vue'
    // other
import ModalDetApp from './components/client/ModalDet.vue'
import LoaderApp from './components/client/Loader.vue'

const app = createApp({components: {
        IndexCatalogApp,
        CatalogListApp,
        ModalDetApp,
        LoaderApp
}})

app.use(store)

app.mount("#app")
