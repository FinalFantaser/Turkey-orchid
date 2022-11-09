<template>
    <div class="catalog__card">
        <div class="catalog__card__top">
            <div class="catalog__card__img">
                <img src="img/catalog/img.png" alt="flat">
            </div>

            <p class="catalog__card__title">Квартира 145 м2</p>

            <p class="catalog__card__description">Полностью мебелированная квартира планировки 3+1, 145 м2. 5 кондиционеров, 2 застекленных балкона и утроенная кухня.</p>
        </div>

        <div class="catalog__card__bottom">
            <p class="catalog__card__price">2 000 000 ₺</p>
            <div data-modalDet class="catalog__card__details">
                <span>Подробнее</span>&nbsp;
                <img src="img/catalog/arrowDetail.png" alt="details">
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "Catalog",
    data() {
        return {
        }
    },
    computed: {

    },
    async mounted() {
        await this.$store.dispatch('catalogSale/getCatalogSale')
    }
}
</script>

<style scoped>

</style>
