export default {
    namespaced: true,
    state: () => {
        return {
            catalogSale: [],
            metaSale: null
        }
    },
    getters: {
        stateMetaSale(state) {
            return state.metaSale
        },
        stateCatalogSale(state) {
            return state.catalogSale
        }
    },
    actions: {
        async getCatalogSale({state, commit}, label) {
            commit('loader/LOADER_TRUE', null, { root: true })

            const path = 'api/v1/apartments/sale' + (label ? '?page=' + label : '')

            await axios.get(path, {
                })
                .then(function (response) {
                    state.catalogSale = response.data.data
                    state.metaSale = response.data.meta
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
