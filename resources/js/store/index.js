import Vue from "vue";
import Vuex from "vuex";
Vue.use(Vuex);


export default new Vuex.Store({
    state: {
        amo_entities: [
            {
                id: 10,
                name: 'Сделка'
            },
            {
                id: 20,
                name: 'Контакт'
            },
            {
                id: 30,
                name: 'Компания'
            },
        ],
        results: [],
        selected_entity: 0
    },
    mutations: {
        ADD_RESULTS(state, data) {
            state.results.push(data)
        },
        MUTATE_SELECTED_ENTITY(state, data) {
            state.selected_entity = data
        }
    },
    getters: {
        GET_AMO_ENTITIES(state) {
            return state.amo_entities
        },
        GET_RESULTS(state){
            return state.results
        },
        GET_SELECTED_ENTITY(state) {
            return state.selected_entity
        }
    },
    actions: {
        SET_SELECTED_ENTITY({commit}, data) {
            commit('MUTATE_SELECTED_ENTITY', data)
        },
        ADD_RESULT_MESSAGE({commit}, data) {
            commit('ADD_RESULTS', data)
        }
    }
});
