import { createStore } from 'vuex'

// services
import catalogSale from "./cervices/catalogSale";
import showApartment from "./cervices/showApartment";

import modal from "./modal";

const store = createStore({
    modules: {
        catalogSale,
        showApartment,
        modal
    }
})

export {store}
