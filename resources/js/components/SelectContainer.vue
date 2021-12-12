<template>
    <div class="select-container">
        <select name="entity" v-model="selected_entity">
            <option v-for="item in amo_entities"
                     :key="item.id"
                     :value="item.id">
                <div class="selected-entity" v-if="selected_entity === item.id">v</div>
                <div class="entity_inner">{{ item.name }}</div>

            </option>
        </select>
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
            selected_entity: 0
        }
    },

    computed: {
        amo_entities() {
            const ent = this.$store.getters['GET_AMO_ENTITIES']
            ent.unshift(this.ext_option)
            return ent
        }
    },

    watch: {
        selected_entity(val) {
            console.log('selected', val)
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

select {
    border: 1px solid #d4d5d8;
    border-bottom-width: 2px;
    border-radius: 3px;
    height: 36px;
    width: 190px;
    padding-left: 10px;
    outline: 0;
    background: -webkit-gradient(linear,left top,left bottom,from(#fcfcfc),to(#f8f8f9));
    background: linear-gradient(to bottom,#fcfcfc 0%,#f8f8f9 100%);
}
</style>
