export default {
    namespaced: true,
    state: () => {
        return {
            catalogRent: [],
            metaRent: null
        }
    },
    getters: {
        stateMetaRent(state) {
            return state.metaRent
        },
        stateCatalogRent(state) {
            return state.catalogRent
        }
    },
    actions: {
        async getCatalogRent({state, commit}, label) {
            commit('loader/LOADER_TRUE', null, { root: true })

            const path = 'api/v1/apartments/rent' + (label ? '?page=' + label : '')

            await axios.get(path, {
            })
                .then(function (response) {
                    state.catalogRent = response.data.data
                    state.metaRent = response.data.meta
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
