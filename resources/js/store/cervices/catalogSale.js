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
        async getCatalogSale({state}) {

            await axios.get('api/v1/apartments/sale', {
                })
                .then(function (response) {
                    state.catalogSale = response.data.data
                    console.log(response)
                })
                .catch(function (error) {
                    console.log(error);
                })

        }
    }
}
