<template>
    <a @click="getCatalogSale">
        <slot></slot>
    </a>
</template>

<script>
export default {
    name: "ButtonLinkSale",
    methods: {
        getCatalogSale() {
            this.$parent.$refs.indexCatalog.getCatalogSale()
        }
    }
}
</script>

<style scoped>

</style>
