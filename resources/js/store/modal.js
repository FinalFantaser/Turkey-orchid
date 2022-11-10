import {noJump} from "../assets/noJump";

export default {
    namespaced: true,
    state() {
        return {
            modalDet: false,
        }
    },
    getters: {
        stateModalDet(state) {
            return state.modalDet
        }
    },
    mutations: {
        MODAL_DET_TRUE(state) {
            state.modalDet = true
        },
        MODAL_DET_FALSE(state) {
            state.modalDet = false
        }
    },
    actions: {
        modalDetTrue({commit}) {
            commit('MODAL_DET_TRUE')
            noJump()
        },
        modalDetFalse({commit}) {
            commit('MODAL_DET_FALSE')
            document.body.style.overflow = '';
            document.body.style.marginRight = '0px';
        }
    }
}
