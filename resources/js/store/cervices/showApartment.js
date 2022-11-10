export default {
    namespaced: true,
    state() {
        return {
            data: null
        }
    },
    getters: {
        stateData(state) {
            return state.data
        }
    },
    mutations: {
        SET_DATA(state, data) {
            state.data = data
        },
        CLEAR_DATA(state) {
            state.data = null
        }
    },
    actions: {
        async showApartment({commit}, id) {

            await axios.get(`api/v1/apartments/show/${id}`, {
            })
                .then(function (response) {
                    commit('SET_DATA', response.data.data)
                    console.log(response)
                })
                .catch(function (error) {
                    console.log(error);
                })

        }
    }
}
