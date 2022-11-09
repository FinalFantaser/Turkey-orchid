import {createApp} from 'vue'
import {store} from "./store";

// components
import IndexCatalogApp from './components/client/index/Catalog.vue'
import ModalDetApp from './components/client/ModalDet.vue'

const app = createApp({components: {
        IndexCatalogApp,
        ModalDetApp
}})

app.use(store)

app.mount("#app")
