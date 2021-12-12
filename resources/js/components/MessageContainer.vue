<template>
    <div class="message-container">
        <div class="message-item" v-for="(item, index) in messages" :key="index">
            <div class="messag-item_title">
                {{ getEntityTitle(item.selected_id) }}
            </div>
            <div class="message-item_body">
                <div class="message-item_id">
                    id: {{ item.id }}
                </div>
                <div class="message-item_name">
                    name: {{ item.name }}
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "MessageContainer",

    computed: {
        messages() {
            return this.$store.getters['GET_RESULTS']
        },
        amo_entities() {
            return this.$store.getters['GET_AMO_ENTITIES']
        }
    },

    methods: {
        getEntityTitle(id) {
            const ent = window._.find(this.amo_entities, enti => {
                return enti.id === id
            })

            return ent.name
        }
    }
}
</script>

<style scoped>
.message-item {
    display: flex;
    flex-wrap: nowrap;
    align-content: center;
    justify-content: flex-start;
    align-items: stretch;
    width: 100%;
    border: 1px solid #cecece;
    margin-top: -1px;
}

.messag-item_title {
    width: 25%;
    box-sizing: border-box;
    border-right: 1px solid #cecece;
    display: flex;
    align-content: center;
    justify-content: center;
    align-items: center;
}

.message-item_id {
    border-bottom: 1px solid #cecece;
}

.message-item_body {
    flex: 1 1 auto;
}

.message-item_body div {
    padding: 5px;
}
</style>
