<template>
    <section id="catalog" class="section catalog">
        <div class="catalog__container container">
            <p class="section__overhead catalog__overhead">Каталог недвижимости</p>
            <h3 class="section__title catalog__title">Мы предлагаем обширный выбор квартир в аренду и на продажу</h3>
            <div class="catalog__buttons">
                <p
                    @click="getCatalogSale"
                    :class="{ 'catalog__buttons__elem--active' : sale }"
                    class="catalog__buttons__elem">Купить квартиру</p>
                <p
                    @click="getCatalogRent"
                    :class="{ 'catalog__buttons__elem--active' : !sale }"
                    class="catalog__buttons__elem">Снять квартиру</p>
            </div>

            <a href="/catalog" class="catalog__link">
                <span>Смотреть все</span>
                <img src="img/catalog/arrowAll.png" alt="all">
            </a>

            <div class="catalog__window">
                <div ref="field" class="catalog__field">

                    <div v-for="card in stateCatalog" class="catalog__card">
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

                </div>
            </div>

            <div class="catalog__wrap">
                <svg width="10" height="16" viewBox="0 0 10 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M8.5 1L1.5 8L8.5 15" stroke="white" stroke-opacity="0.5" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                <svg width="10" height="16" viewBox="0 0 10 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M1.5 1L8.5 8L1.5 15" stroke="white" stroke-opacity="0.5" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>

                <div class="catalog__wrap__arrow catalog__wrap__arrow--prev"></div>
                <div class="catalog__wrap__arrow catalog__wrap__arrow--next"></div>

            </div>
        </div>
    </section>
    <!-- /.section catalog -->
</template>

<script>
import {slider} from "../../../assets/slider";

export default {
    name: "Catalog",
    data() {
        return {
            sale: true
        }
    },
    computed: {
        stateCatalog() {
            if (this.sale) {
                return this.$store.getters['catalogSale/stateCatalogSale']
            }
            return this.$store.getters['catalogRent/stateCatalogRent']
        }
    },
    methods: {
        async getCatalogRent() {
            this.$refs.field.style = ''
            await this.$store.dispatch('catalogRent/getCatalogRent')
            if (this.$store.getters['catalogRent/stateCatalogRent'].length === 0) {
                return
            }
            this.sale = false
        },
        async getCatalogSale() {
            this.$refs.field.style = ''
            await this.$store.dispatch('catalogSale/getCatalogSale')
            if (this.$store.getters['catalogSale/stateCatalogSale'].length === 0) {
                return
            }
            this.sale = true
        },
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
        await this.getCatalogSale()
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
