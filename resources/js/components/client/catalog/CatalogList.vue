<template>
    <section class="section directory">
        <div class="container directory__container">
            <form action="#" class="directory__filter">
                <div class="directory__filter__tabs">
                    <p
                        @click="getCatalogSale"
                        :class="{ 'directory__filter__tabs__item--active' : sale }"
                        class="directory__filter__tabs__item">Купить квартиру</p>
                    <p
                        @click="getCatalogRent"
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
                                    <input
                                        v-model="priceFrom"
                                        :class="{ 'input--invalid' : v$.$dirty && v$.priceFrom.$invalid }"
                                        placeholder="От"
                                        type="text"
                                        class="directory__filter__input directory__filter__input--left">

                                    <p v-if="v$.$dirty && v$.priceFrom.$invalid" class="invalid">Введите число</p>
                                </div>
                                <div class="input-group directory__filter__input-group">
                                    <input
                                        v-model="priceTo"
                                        :class="{ 'input--invalid' : v$.$dirty && v$.priceTo.$invalid }"
                                        placeholder="До"
                                        type="text"
                                        class="directory__filter__input directory__filter__input--left directory__filter__input--center">
                                    <p v-if="v$.$dirty && v$.priceTo.$invalid" class="invalid">Введите число</p>
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
                                    <input
                                        v-model="m2From"
                                        :class="{ 'input--invalid' : v$.$dirty && v$.m2From.$invalid }"
                                        placeholder="От"
                                        type="text"
                                        class="directory__filter__input directory__filter__input--left">
                                    <p v-if="v$.$dirty && v$.m2From.$invalid" class="invalid">Введите число</p>
                                </div>
                                <div class="input-group directory__filter__input-group">
                                    <input
                                        v-model="m2To"
                                        :class="{ 'input--invalid' : v$.$dirty && v$.m2To.$invalid }"
                                        placeholder="До"
                                        type="text"
                                        class="directory__filter__input">
                                    <p v-if="v$.$dirty && v$.m2To.$invalid" class="invalid">Введите число</p>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="directory__filter__row">
                        <div for="date" class="input-group directory__filter__input-group directory__filter__input-group--date">
                            <input
                                v-model="date"
                                type="date"
                                id="date"
                                class="directory__filter__input directory__filter__input--date">
                        </div>

                        <div class="directory__filter__rooms">
                            <div class="directory__filter__rooms__title">
                                <img src="img/directory/icon4.png" alt="rooms">
                                <span>Количество комнат:</span>
                            </div>
                            <div class="directory__filter__rooms__row">

                                <label class="directory__filter__rooms__radio">
                                    <input
                                        v-model="rooms"
                                        value="1"
                                        type="radio" name="rooms" class="directory__filter__rooms__radio__input">
                                    <div class="directory__filter__rooms__radio__ok"></div>
                                    <span class="directory__filter__rooms__radio__text">1</span>
                                </label>

                                <label class="directory__filter__rooms__radio">
                                    <input
                                        v-model="rooms"
                                        value="2"
                                        type="radio" name="rooms" class="directory__filter__rooms__radio__input">
                                    <div class="directory__filter__rooms__radio__ok"></div>
                                    <span class="directory__filter__rooms__radio__text">2</span>
                                </label>

                                <label class="directory__filter__rooms__radio">
                                    <input
                                        v-model="rooms"
                                        value="3"
                                        type="radio" name="rooms" class="directory__filter__rooms__radio__input">
                                    <div class="directory__filter__rooms__radio__ok"></div>
                                    <span class="directory__filter__rooms__radio__text">3</span>
                                </label>

                                <label class="directory__filter__rooms__radio">
                                    <input
                                        v-model="rooms"
                                        value="4+"
                                        type="radio" name="rooms" class="directory__filter__rooms__radio__input">
                                    <div class="directory__filter__rooms__radio__ok"></div>
                                    <span class="directory__filter__rooms__radio__text">4+</span>
                                </label>

                            </div>
                        </div>

                        <button @click.prevent="getCatalogFilter" class="directory__filter__button">Найти</button>

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

            <div v-if="stateMeta" class="directory__pagination">
                <div v-for="(link, index) in stateMeta.links"
                     @click="sale ? getCatalogSale(link.label, link.url, index) : getCatalogRent(link.label, link.url, index)"
                     :class="{ 'directory__pagination__item--active' : link.active, 'directory__pagination__item--arrow' : index === 0 || index === stateMeta.links.length - 1 }"
                     class="directory__pagination__item"
                >
                    <img v-if="index === 0" class="directory__pagination__arrow directory__pagination__arrow--prev" src="img/directory/arrowPrev.png" alt="arrow">
                    <span v-if="index !== 0 && index !== stateMeta.links.length - 1">{{ link.label }}</span>
                    <img v-if="index === stateMeta.links.length - 1" class="directory__pagination__arrow directory__pagination__arrow--next" src="img/directory/arrowNext.png" alt="arrow">
                </div>
            </div>

        </div>
    </section>
</template>

<script>
import {slider} from "../../../assets/slider";
import { useVuelidate } from '@vuelidate/core'
import { required, numeric } from '@vuelidate/validators'

export default {
    setup () {
        return { v$: useVuelidate() }
    },
    name: "CatalogList",
    data() {
        return {
            sale: true,
            priceFrom: '',
            priceTo: '',
            m2From: '',
            m2To: '',
            date: '',
            rooms: '1'
        }
    },
    computed: {
        stateMeta() {
            if (this.sale) {
                return this.$store.getters['catalogSale/stateMetaSale']
            }
            return this.$store.getters['catalogRent/stateMetaRent']
        },
        stateCatalog() {
            if (this.sale) {
                return this.$store.getters['catalogSale/stateCatalogSale']
            }
            return this.$store.getters['catalogRent/stateCatalogRent']
        }
    },
    methods: {
        clearData() {
            this.priceFrom = ''
            this.priceTo = ''
            this.m2From = ''
            this.m2To = ''
            this.date = ''
            this.rooms = '1'
        },
        async getCatalogFilter() {
            const result = await this.v$.$validate()
            if (!result) {
                this.v$.$touch()
                return
            }
            const obj = {
                price_from: this.priceFrom ? this.priceFrom : 0,
                price_to: this.priceTo ? this.priceTo : 0,
                m2_from: this.m2From ? this.m2From : 0,
                m2_to: this.m2To ? this.m2To : 0,
                date: this.date ? this.date : null,
                rooms: this.rooms
            }
            if(this.sale) {
                await this.$store.dispatch('catalogSaleFilter/getCatalogSaleFilter', {
                    label: false,
                    filter: obj
                })
            } else {
                await this.$store.dispatch('catalogRentFilter/getCatalogRentFilter', obj)
            }
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
        },
        async getCatalogSale(label, url = true, index) {
            if (!url) {
                return
            }
            if (this.stateMeta && (index === 0 || index === this.stateMeta.links.length - 1)) {
                label = url.slice(-1)
            }
            await this.$store.dispatch('catalogSale/getCatalogSale', label)
            if (this.$store.getters['catalogSale/stateCatalogSale'].length === 0) {
                return
            }
            this.sale = true

        },
        async getCatalogRent(label, url = true, index) {
            if (!url) {
                return
            }
            if (this.stateMeta && (index === 0 || index === this.stateMeta.links.length - 1)) {
                label = url.slice(-1)
            }
            await this.$store.dispatch('catalogRent/getCatalogRent', label)
            if (this.$store.getters['catalogRent/stateCatalogRent'].length === 0) {
                return
            }
            this.sale = false
        }
    },
    validations () {
        return {
            priceFrom: { numeric },
            priceTo: { numeric },
            m2From: { numeric },
            m2To: { numeric }
        }
    },
    async mounted() {
        await this.getCatalogSale()
    }
}
</script>

<style scoped>
.invalid {
    position: absolute;
    color: tomato;
    left: 2px;
    top: 0;
    font-size: 14px;
}
.input--invalid {
    border-color: tomato;
}
</style>
