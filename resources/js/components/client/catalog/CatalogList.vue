<template>
    <section class="section directory">
        <div class="container directory__container">
            <form action="#" class="directory__filter">
                <div class="directory__filter__tabs">
                    <p
                        :class="{ 'directory__filter__tabs__item--active' : sale }"
                        class="directory__filter__tabs__item">Купить квартиру</p>
                    <p
                        :class="{ 'directory__filter__tabs__item--active' : !sale }"
                        class="directory__filter__tabs__item">Снять квартиру</p>
                </div>

                <div class="directory__filter__box">
                    <div class="directory__filter__row directory__filter__row--top">

                        <div class="directory__filter__block">
                            <div class="directory__filter__block__title">
                                <img src="img/directory/icon1.png" alt="price">
                                <span>Цена продажи, ₺</span>
                            </div>
                            <div class="directory__filter__wrap">
                                <div class="input-group directory__filter__input-group">
                                    <input placeholder="От" type="text" class="directory__filter__input directory__filter__input--left">
                                </div>
                                <div class="input-group directory__filter__input-group">
                                    <input placeholder="До" type="text" class="directory__filter__input directory__filter__input--left directory__filter__input--center">
                                </div>
                            </div>
                        </div>

                        <div class="directory__filter__block">
                            <div class="directory__filter__block__title">
                                <img src="img/directory/icon2.png" alt="price">
                                <span>Цена за м2, ₺</span>
                            </div>
                            <div class="directory__filter__wrap">
                                <div class="input-group directory__filter__input-group">
                                    <input placeholder="От" type="text" class="directory__filter__input directory__filter__input--left">
                                </div>
                                <div class="input-group directory__filter__input-group">
                                    <input placeholder="До" type="text" class="directory__filter__input">
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="directory__filter__row">
                        <div for="date" class="input-group directory__filter__input-group directory__filter__input-group--date">
                            <input type="date" id="date" class="directory__filter__input directory__filter__input--date">
                        </div>

                        <div class="directory__filter__rooms">
                            <div class="directory__filter__rooms__title">
                                <img src="img/directory/icon4.png" alt="rooms">
                                <span>Количество комнат:</span>
                            </div>
                            <div class="directory__filter__rooms__row">

                                <label class="directory__filter__rooms__radio">
                                    <input checked type="radio" name="rooms" class="directory__filter__rooms__radio__input">
                                    <div class="directory__filter__rooms__radio__ok"></div>
                                    <span class="directory__filter__rooms__radio__text">1</span>
                                </label>

                                <label class="directory__filter__rooms__radio">
                                    <input type="radio" name="rooms" class="directory__filter__rooms__radio__input">
                                    <div class="directory__filter__rooms__radio__ok"></div>
                                    <span class="directory__filter__rooms__radio__text">2</span>
                                </label>

                                <label class="directory__filter__rooms__radio">
                                    <input type="radio" name="rooms" class="directory__filter__rooms__radio__input">
                                    <div class="directory__filter__rooms__radio__ok"></div>
                                    <span class="directory__filter__rooms__radio__text">3</span>
                                </label>

                                <label class="directory__filter__rooms__radio">
                                    <input type="radio" name="rooms" class="directory__filter__rooms__radio__input">
                                    <div class="directory__filter__rooms__radio__ok"></div>
                                    <span class="directory__filter__rooms__radio__text">4+</span>
                                </label>

                            </div>
                        </div>

                        <button class="directory__filter__button">Найти</button>

                    </div>
                </div>
            </form>


            <div class="directory__row">

                <div v-for="card in stateCatalog" class="directory__card">
                    <div class="directory__card__img">
                        <img :src="card.thumb.catalog" alt="flat">
                    </div>

                    <div class="directory__card__box">
                        <div class="directory__card__wrap">
                            <p class="directory__card__title">{{ card.title }}</p>

                            <p class="directory__card__description">{{ card.description }}</p>

                            <p class="directory__card__price">{{sumMask(card.price)}} ₺</p>
                        </div>

                        <div @click="modalDetTrue(card.id)" class="directory__card__button">
                            <span>Подробнее</span>
                            <img src="img/directory/arrow.png" alt="arrow">
                        </div>
                    </div>
                </div>

            </div>

            <div class="directory__pagination">
                <img class="directory__pagination__arrow directory__pagination__arrow--prev" src="img/directory/arrowPrev.png" alt="arrow">
                <div class="directory__pagination__item directory__pagination__item--active">
                    <span>1</span>
                </div>
                <div class="directory__pagination__item">
                    <span>3</span>
                </div>
                <div class="directory__pagination__item">
                    <span>4</span>
                </div>

                <div class="directory__pagination__item directory__pagination__item--dots">
                    <span>...</span>
                </div>
                <img class="directory__pagination__arrow directory__pagination__arrow--next" src="img/directory/arrowNext.png" alt="arrow">
            </div>

        </div>
    </section>
</template>

<script>
import {slider} from "../../../assets/slider";

export default {
    name: "CatalogList",
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
        },
        async getCatalogSale() {
            await this.$store.dispatch('catalogSale/getCatalogSale')
            if (this.$store.getters['catalogSale/stateCatalogSale'].length === 0) {
                return
            }
            this.sale = true

        },
        async getCatalogRent() {
            await this.$store.dispatch('catalogRent/getCatalogRent')
            if (this.$store.getters['catalogRent/stateCatalogRent'].length === 0) {
                return
            }
            this.sale = false
        }
    },
    async mounted() {
        await this.getCatalogSale()
    }
}
</script>

<style scoped>

</style>
