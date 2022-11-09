<template>
    <div v-for="card in stateCatalogSale" class="catalog__card">
        <div class="catalog__card__top">
            <div class="catalog__card__img">
                <img :src="card.thumb" alt="flat">
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
import {slider} from "../../../assets/slider";

export default {
    name: "Catalog",
    data() {
        return {
        }
    },
    computed: {
        stateCatalogSale() {
            return this.$store.getters['catalogSale/stateCatalogSale']
        }
    },
    async mounted() {
        await this.$store.dispatch('catalogSale/getCatalogSale')
        slider(
            '.catalog__window',
            '.catalog__field',
            '.catalog__card',
            false,
            false,
            false,
            '.catalog__wrap__arrow--prev',
            '.catalog__wrap__arrow--next',
            false,
            false
        );
    }
}
</script>

<style scoped>

</style>
