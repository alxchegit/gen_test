<template>
    <div class="select-container">
        <div class="select-holder">
            <div class="select-input">
                <input type="text" readonly v-model="selected_entity_name" @click="openEntityList">
                <input type="hidden" v-model="selected_entity">
            </div>
            <div class="select-list" v-if="listState">
                <ul>
                    <li v-for="(item, index) in amo_entities" :key="index"
                        class="select-input__list-item"
                        :class="{'active-item': item.id === selected_entity}"
                        @click="selectAmoEntity(item)"
                    >
                        <span class="item-check" v-if="item.id === selected_entity"></span>
                        <span class="list-item_text">{{ item.name }}</span></li>
                </ul>
            </div>
        </div>
    </div>
</template>

<script>
export default {
name: "SelectContainer",
    data() {
        return {
            ext_option: {
                id: 0,
                name: 'Не выбрано'
            },
            selected_entity: 0,
            listState: !1
        }
    },

    methods: {
        selectAmoEntity(item) {
            this.selected_entity = item.id
            this.closeEntityList()
        },
        openEntityList() {
                this.listState = 1

        },
        closeEntityList() {
                this.listState = !1
        },

    },

    computed: {
        amo_entities() {
            const ent = this.$store.getters['GET_AMO_ENTITIES']
            ent.unshift(this.ext_option)
            return ent
        },
        selected_entity_name() {
            const ent = window._.find(this.amo_entities, enty=>{
                return enty.id === this.selected_entity
            })
            if(ent) {
                return ent.name
            }
            return 'Ошибка'
        }
    },

    watch: {
        selected_entity(val) {
            this.$store.dispatch('SET_SELECTED_ENTITY', val)
        }
    },

}
</script>

<style scoped>
.select-container {
    display: flex;
    align-content: center;
    justify-content: center;
    align-items: center;
    min-height: 100px;
}

.select-holder {
    z-index: 10;
    position: relative;
}
.select-list {
    position: absolute;
    z-index: 20;
    top: 0;
    background: white;
    width: 100%;
    box-sizing: border-box;
    border: 1px solid #d4d5d8;
}

.select-list ul {
    list-style: none;
    margin: 0;
    padding: 0;
}

.select-input__list-item {
    position: relative;
    padding: 5px 0 5px 30px;
}
.select-input__list-item:hover,
.select-input__list-item.active-item
{
    background-color: #dedede;
}

.select-input {
    width: 200px;
}
.select-input input {
    border: 1px solid #d4d5d8;
    border-bottom-width: 2px;
    border-radius: 3px;
    height: 36px;
    width: 100%;
    padding-left: 10px;
    outline: 0;
    background: -webkit-gradient(linear,left top,left bottom,from(#fcfcfc),to(#f8f8f9));
    background: linear-gradient(to bottom,#fcfcfc 0%,#f8f8f9 100%);
}

.select-input:after
{
    content: "";
    position: absolute;
    top: calc(50% - 5px);
    width: 6px;
    height: 6px;
    border-bottom: 1px solid #454545;
    border-right: 1px solid #454545;
    -webkit-transform: rotate(
        45deg);
    transform: rotate(
        45deg);
    margin-left: 7px;
    right: 12px;
    z-index: 10;
}

span.item-check {
    position: absolute;
    top: 12px;
    left: 12px;
    width: 7px;
    height: 7px;
    border-bottom: 1px solid #454545;
    border-right: 1px solid #454545;
    -webkit-transform: rotate(
        45deg);
    transform: rotate(
        45deg);
}
</style>
