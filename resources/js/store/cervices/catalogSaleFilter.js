export default {
    namespaced: true,
    state: () => {
        return {
            catalogSaleFilter: [],
            metaSaleFilter: null
        }
    },
    getters: {
        stateMetaSaleFilter(state) {
            return state.metaSaleFilter
        },
        stateCatalogSaleFilter(state) {
            return state.catalogSaleFilter
        }
    },
    actions: {
        async getCatalogSaleFilter({state, commit}, obj) {
            commit('loader/LOADER_TRUE', null, { root: true })

            const path = 'api/v1/apartments/filtered/sale' + (obj.label ? '?page=' + obj.label : '')
            await axios.get(path, {params: obj.filter})
                .then(function (response) {
                    state.catalogSaleFilter = response.data.data
                    state.metaSaleFilter = response.data.meta
                    console.log(response)
                    commit('loader/LOADER_FALSE', null, { root: true })
                })
                .catch(function (error) {
                    console.log(error);
                    commit('loader/LOADER_FALSE', null, { root: true })
                })

        }
    }
}
