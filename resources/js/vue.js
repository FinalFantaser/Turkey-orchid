import {createApp} from 'vue'
import {store} from "./store";

// components
import IndexCatalogApp from './components/client/index/Catalog.vue'

const app = createApp({components: {
    IndexCatalogApp
}})

app.use(store)

app.mount("#app")
