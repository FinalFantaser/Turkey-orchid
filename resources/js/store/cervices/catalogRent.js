export default {
    namespaced: true,
    state: () => {
        return {
            catalogRent: []
        }
    },
    getters: {
        stateCatalogRent(state) {
            return state.catalogRent
        }
    },
    actions: {
        async getCatalogRent({state, commit}) {
            commit('loader/LOADER_TRUE', null, { root: true })

            await axios.get('api/v1/apartments/rent', {
            })
                .then(function (response) {
                    state.catalogRent = response.data.data
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
