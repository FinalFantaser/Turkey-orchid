<template>
    <div v-if="stateLoader" class="loader-wrap">
        <div class="loader"></div>
    </div>
</template>

<script>
export default {
    name: "Loader",
    computed: {
        stateLoader() {
            return this.$store.getters['loader/stateLoader']
        }
    }
}
</script>

<style scoped>

</style>
