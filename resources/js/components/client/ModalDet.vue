<template>
    <transition>
        <div v-show="stateModalDet" class="modal modal--active modal-det">
            <div class="modal__container">

                <div class="modal-det__dialog">
                    <picture @click="modalDetFalse" class="modal-det__close">
                        <source media="(max-width: 991px)" srcset="img/close.png">
                        <img src="img/closeBlack.png" alt="close">
                    </picture>
                    <h3 class="modal-det__title">{{ stateData ? stateData.title : '' }}</h3>

                    <div class="modal-det__row">
                        <div class="modal-det__slider">
                            <div class="modal-det__slider__main">
                                <img src="img/modal/modal-det/img1.jpg" alt="flat">
                            </div>

                            <div v-if="stateData" class="modal-det__slider__wrap">

                                <svg class="modal-det__slider__arrow modal-det__slider__arrow--prev" width="11" height="21" viewBox="0 0 11 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M10 1.15417L1 10.1542L10 19.1542" stroke="black" stroke-opacity="0.5" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>

                                <svg class="modal-det__slider__arrow modal-det__slider__arrow--next" width="11" height="21" viewBox="0 0 11 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M1 1.15417L10 10.1542L1 19.1542" stroke="black" stroke-opacity="0.5" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>

                                <div class="modal-det__slider__window">

                                    <div class="modal-det__slider__row">

                                        <div
                                            v-for="(img, index) in stateData.images"
                                            :class="{ 'modal-det__slider__card--active' : index === 0 }"
                                            class="modal-det__slider__card">
                                            <div class="modal-det__slider__card__content">
                                                <img :src="img" alt="flat">
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>

                            <div class="modal-det__slider__progress">
                                <div class="modal-det__slider__progress__inner"></div>
                            </div>
                        </div>

                        <div class="modal-det__charact">
                            <p class="modal-det__charact__title">Характеристики</p>

                            <div class="modal-det__charact__box">

                                <div class="modal-det__charact__item">
                                    <div class="modal-det__charact__item__header">
                                        <img src="img/modal/modal-det/icons/icon1.png" alt="address">
                                        <span>Адрес</span>
                                    </div>

                                    <a href="#" class="modal-det__charact__item__text">{{ stateData ? stateData.address : '' }}</a>
                                </div>

                                <div class="modal-det__charact__item">
                                    <div class="modal-det__charact__item__header">
                                        <img src="img/modal/modal-det/icons/icon2.png" alt="address">
                                        <span>Расположение</span>
                                    </div>

                                    <p class="modal-det__charact__item__text">{{ stateData ? stateData.located_at : '' }}</p>
                                </div>

                                <div class="modal-det__charact__item">
                                    <div class="modal-det__charact__item__header">
                                        <img src="img/modal/modal-det/icons/icon3.png" alt="address">
                                        <span>Цена {{ stateData && stateData.category.id === 1 ? 'продажи' : 'аренды' }}</span>
                                    </div>

                                    <p class="modal-det__charact__item__text">{{ stateData ? sumMask(stateData.price) : '' }} ₺</p>
                                </div>

                                <div class="modal-det__charact__item">
                                    <div class="modal-det__charact__item__header">
                                        <img src="img/modal/modal-det/icons/icon4.png" alt="address">
                                        <span>Цена за м2</span>
                                    </div>

                                    <p class="modal-det__charact__item__text">{{ stateData ? sumMask(stateData.price_m2) : '' }} ₺</p>
                                </div>

                                <div class="modal-det__charact__item">
                                    <div class="modal-det__charact__item__header">
                                        <img src="img/modal/modal-det/icons/icon5.png" alt="address">
                                        <span>Площадь</span>
                                    </div>

                                    <p class="modal-det__charact__item__text">{{ stateData ? stateData.area : '' }} м²</p>
                                </div>

                                <div class="modal-det__charact__item">
                                    <div class="modal-det__charact__item__header">
                                        <img src="img/modal/modal-det/icons/icon6.png" alt="address">
                                        <span>Всего комнат</span>
                                    </div>

                                    <p class="modal-det__charact__item__text">{{ stateData ? stateData.rooms : '' }}</p>
                                </div>

                                <div class="modal-det__charact__item">
                                    <div class="modal-det__charact__item__header">
                                        <img src="img/modal/modal-det/icons/icon7.png" alt="address">
                                        <span>Кол-во спален</span>
                                    </div>

                                    <p class="modal-det__charact__item__text">{{ stateData ? stateData.bedrooms : '' }}</p>
                                </div>

                                <div class="modal-det__charact__item">
                                    <div class="modal-det__charact__item__header">
                                        <img src="img/modal/modal-det/icons/icon8.png" alt="address">
                                        <span>{{ stateData ? stateData.bathrooms : '' }}</span>
                                    </div>

                                    <p class="modal-det__charact__item__text">1</p>
                                </div>

                                <div class="modal-det__charact__item">
                                    <div class="modal-det__charact__item__header">
                                        <img src="img/modal/modal-det/icons/icon9.png" alt="address">
                                        <span>Этаж</span>
                                    </div>

                                    <p class="modal-det__charact__item__text">{{ stateData ? stateData.floor : '' }}</p>
                                </div>

                                <div class="modal-det__charact__item">
                                    <div class="modal-det__charact__item__header">
                                        <img src="img/modal/modal-det/icons/icon10.png" alt="address">
                                        <span>Этажность</span>
                                    </div>

                                    <p class="modal-det__charact__item__text">{{ stateData ? stateData.total_floors : '' }}</p>
                                </div>

                            </div>
                        </div>

                    </div>

                    <div class="modal-det__description">
                        <div class="modal-det__description__box">
                            <p class="modal-det__description__title">Особенности:</p>
                            <ul v-if="stateData" class="modal-det__ul">
                                <li v-for="detail in stateData.details" class="modal-det__li">{{ detail.text }}</li>
                            </ul>
                        </div>

                        <div class="modal-det__description__box">
                            <p class="modal-det__description__title">Местоположение</p>
                            <ul v-if="stateData" class="modal-det__ul">
                                <li v-for="location in stateData.location" class="modal-det__li">{{ location.text }}</li>
                            </ul>
                        </div>
                    </div>

                    <button class="button-r modal-det__button">
                        <span>Подробнее</span>
                        <div class="button-r__wrap">
                            <svg>
                                <clipPath id="svgPathModalDet">
                                    <path d="M 15,0
                                    Q 5,0 5,10
                                    Q 0,38 5,66
                                    Q 5,76 15,76"
                                    />
                                    <path class="path" d="M 15,0
                                    Q 5,0 5,10
                                    Q 0,38 5,66
                                    Q 5,76 15,76"
                                    />
                                    <rect x="15" width="calc(100% - 30px)" height="100%" />
                                </clipPath>
                            </svg>

                            <svg>
                                <clipPath id="svgPathModalDetM">
                                    <path d="M 15,0
                                    Q 5,0 5,10
                                    Q 0,33 5,56
                                    Q 5,66 15,66"
                                    />
                                    <path class="path" d="M 15,0
                                    Q 5,0 5,10
                                    Q 0,33 5,56
                                    Q 5,66 15,66"
                                    />
                                    <rect x="15" width="calc(100% - 30px)" height="100%"/>
                                </clipPath>
                            </svg>
                        </div>
                    </button>

                </div>

            </div>
        </div>
        <!-- /.modal modal--active modal-det -->
    </transition>
</template>

<script>
export default {
    name: "ModalDet",
    computed: {
        stateModalDet() {
            return this.$store.getters['modal/stateModalDet']
        },
        stateData() {
            return this.$store.getters['showApartment/stateData']
        }
    },
    methods: {
        modalDetFalse() {
            this.$store.dispatch('modal/modalDetFalse')
            this.$store.commit('showApartment/CLEAR_DATA')
        },
        sumMask(sum) {
            const n = sum.toString();
            return  n.replace(/(\d{1,3}(?=(?:\d\d\d)+(?!\d)))/g, "$1" + ' ')
        }
    }
}
</script>

<style scoped>
/* we will explain what these classes do next! */
.v-enter-active,
.v-leave-active {
    transition: opacity 0.5s ease;
}

.v-enter-from,
.v-leave-to {
    opacity: 0;
}
</style>
