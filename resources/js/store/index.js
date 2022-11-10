import { createStore } from 'vuex'

// services
import catalogSale from "./cervices/catalogSale";
import catalogRent from "./cervices/catalogRent";
import showApartment from "./cervices/showApartment";

import modal from "./modal";
import loader from "./loader";

const store = createStore({
    modules: {
        catalogSale,
        catalogRent,
        showApartment,
        modal,
        loader
    }
})

export {store}
