export default {
    namespaced: true,
    state: () => {
        return {
            catalogSale: []
        }
    },
    getters: {
      stateCatalogSale(state) {
          return state.catalogSale
      }
    },
    actions: {
        async getCatalogSale({state, commit}) {
            commit('loader/LOADER_TRUE', null, { root: true })

            await axios.get('api/v1/apartments/sale', {
                })
                .then(function (response) {
                    state.catalogSale = response.data.data
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
