<template>
    <div class="button-container">
        <button type="button" class="button-input "
                :class="{
                        'button-input_loading': button_loading,
                        'button-active': isActive
                        }"
                @click="create">
            <span class="button-input-inner " v-if="!button_loading">
                <span class="button-input-inner__text">Создать</span>
            </span>
            <div class="button-input__spinner" v-if="button_loading">
                <span class="button-input__spinner__icon spinner-icon"></span>
            </div>
        </button>
    </div>

</template>

<script>
import axios from 'axios'
export default {
    name: "ButtonContainer",

    data() {
        return {
            button_loading: !1,
            load_start: 'load:start',
            load_stop: 'load:stop'

        }
    },

    computed: {
        isActive() {
            const selected = this.$store.getters['GET_SELECTED_ENTITY']
            return selected > 0
        }
    },


    methods: {
        create() {
            const vueThis = this
            const selected_ent = this.$store.getters['GET_SELECTED_ENTITY']
            if(selected_ent === 0) {
                return
            }
            this.trigger_button(this.load_start)
            this.backendRequest('/api/create', {selected_ent}).then(res=>{
                vueThis.$store.dispatch('ADD_RESULT_MESSAGE', res.data.payload)
            }).catch(err=>{
                console.log(err)
            }).finally(()=>{
                vueThis.trigger_button(vueThis.load_stop)
            })

        },
        backendRequest(url, data) {
            return axios.post(url, data, {
                headers: {
                    'Content-type': 'application/json'
                }
            })
        },
        trigger_button(state) {
            if(state === this.load_start) {
                this.button_loading = 1
            }
            if(state === this.load_stop) {
                this.button_loading = !1
            }
        }
    }
}
</script>

<style scoped>

.button-container
{
    display: flex;
    align-content: center;
    justify-content: center;
}
.button-input {
    cursor: pointer;
    min-height: 36px;
    padding: 10px;
    border: 1px solid #e6e6e6;
    background: #f8f8f8;
    color: #1b1b1b;
    font-weight: 600;
    border-radius: 3px;
    vertical-align: middle;
}

.button-input.button-active,
.button-input_loading
{
    cursor: pointer;
    border: 1px solid #4077d6;
    background: #4c8bf7;
    color: #fff;
}
.button-input-inner {
    display: inline-flex;
    align-items: center;
    position: relative;
}
.button-input__spinner__icon {
    position: absolute;
    top: -1px;
    left: -2px;
}
.spinner-icon {
    display: block;
    width: 16px;
    height: 16px;
    border: solid 2px transparent;
    border-top-color: #d5e3ea;
    border-left-color: #d5e3ea;
    border-radius: 100%;
    -webkit-animation: nprogress-spinner 900ms linear infinite;
    animation: nprogress-spinner 900ms linear infinite;
}
.button-input__spinner {
    position: relative;
    height: 16px;
    width: 14px;
}

@keyframes nprogress-spinner {
    0% {
        transform: rotate(
            0deg);
    }
    100% {
        transform: rotate(
            360deg);
    }
}
</style>
