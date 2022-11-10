import { createStore } from 'vuex'

// services
import catalogSale from "./cervices/catalogSale";
import catalogSaleFilter from "./cervices/catalogSaleFilter";
import catalogRent from "./cervices/catalogRent";
import catalogRentFilter from "./cervices/catalogRentFilter";
import showApartment from "./cervices/showApartment";

import modal from "./modal";
import loader from "./loader";

const store = createStore({
    modules: {
        catalogSale,
        catalogSaleFilter,
        catalogRent,
        catalogRentFilter,
        showApartment,
        modal,
        loader
    }
})

export {store}
