33<template>
    <div v-for="card in stateCatalogSale" class="catalog__card">
        <div class="catalog__card__top">
            <div class="catalog__card__img">
                <img :src="card.thumb.slider" alt="flat">
            </div>

            <p class="catalog__card__title">{{card.title}}</p>

            <p class="catalog__card__description">{{card.description}}</p>
        </div>

        <div class="catalog__card__bottom">
            <p class="catalog__card__price">{{sumMask(+card.price)}} ₺</p>
            <div @click="modalDetTrue(card.id)" data-modalDet class="catalog__card__details">
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
    methods: {
        async modalDetTrue(id) {
            await this.$store.dispatch('showApartment/showApartment', id)
            this.$store.dispatch('modal/modalDetTrue')
            slider(
                '.modal-det__slider__window',
                '.modal-det__slider__row',
                '.modal-det__slider__card',
                false,
                false,
                false,
                false,
                false,
                false,
                false,
                true
            );
        },
        sumMask(sum) {
          const n = sum.toString();
          return  n.replace(/(\d{1,3}(?=(?:\d\d\d)+(?!\d)))/g, "$1" + ' ')
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
