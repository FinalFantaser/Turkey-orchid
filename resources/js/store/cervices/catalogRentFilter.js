export default {
    namespaced: true,
    state: () => {
        return {
            catalogRentFilter: [],
            metaRentFilter: null
        }
    },
    getters: {
        stateMetaRentFilter(state) {
            return state.metaRentFilter
        },
        stateCatalogRentFilter(state) {
            return state.catalogRentFilter
        }
    },
    actions: {
        async getCatalogRentFilter({state, commit}, label) {
            commit('loader/LOADER_TRUE', null, { root: true })

            const path = 'api/v1/apartments/filtered/rent' + (label ? '?page=' + label : '')

            await axios.get(path, {
            })
                .then(function (response) {
                    state.catalogRentFilter = response.data.data
                    state.metaRentFilter = response.data.meta
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
