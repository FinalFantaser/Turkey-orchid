import { createStore } from 'vuex'

import catalogSale from "./cervices/catalogSale";

const store = createStore({
    modules: {
        catalogSale
    }
})

export {store}
