<template>
    <a @click="getCatalogRent">
        <slot></slot>
    </a>
</template>

<script>
export default {
    name: "ButtonLinkRent",
    methods: {
        getCatalogRent() {
            this.$parent.$refs.indexCatalog.getCatalogRent()
        }
    }
}
</script>

<style scoped>

</style>
