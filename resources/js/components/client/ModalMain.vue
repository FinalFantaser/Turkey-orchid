<template>
    <div class="modal modal-main">
        <div class="modal__container">
            <form action="#" class="modal-main__dialog">

                <picture class="modal-main__close">
                    <source media="(max-width: 991px)" srcset="img/close.png">
                    <img src="img/modal/closeWhite.png" alt="close">
                </picture>

                <div class="modal-main__wrap">
                    <h3 class="modal-main__title">Обратный звонок</h3>
                    <p class="modal-main__text">Дополнительные скидки на аренду квартиры до 30% + бесплатный трансфер до дома. Получите горячие предложения прямо сейчас!</p>
                    <div class="modal-main__box">
                        <div class="input-group modal-main__input-group">
                            <label class="modal-main__label label" for="modalName">Ваше имя*</label>
                            <div class="modal-main__input-wrap input-wrap">
                                <input placeholder="Имя" id="modalName" type="text" class="input-r moda-main__input">
                                <svg class="input-wrap__svg" fill="none">
                                    <path d="M 15,0
                                            Q 5,0 5,10
                                            Q 0,38 5,66
                                            Q 5,76 15,76"
                                    />
                                    <rect x="15" y="0" width="calc(100% - 30px)" height="0.5" />
                                    <rect x="15" y="76" width="calc(100% - 30px)" height="0.5" />
                                    <path class="path" d="M 15,0
                                                            Q 5,0 5,10
                                                            Q 0,38 5,66
                                                            Q 5,76 15,76"
                                    />
                                    <line x1="15" y1="0" x2="calc(100% - 15px)" y2="0" />
                                </svg>

                            </div>
                        </div>

                        <div class="input-group modal-main__input-group">
                            <label class="modal-main__label label" for="modalTel">Ваше телефон*</label>
                            <div class="modal-main__input-wrap input-wrap">
                                <input placeholder="+_ (___) ___ - __-__" id="modalTel" type="tel" class="input-r moda-main__input">
                                <svg class="input-wrap__svg" fill="none">
                                    <path d="M 15,0
                                            Q 5,0 5,10
                                            Q 0,38 5,66
                                            Q 5,76 15,76"
                                    />
                                    <rect x="15" y="0" width="calc(100% - 30px)" height="0.5" />
                                    <rect x="15" y="76" width="calc(100% - 30px)" height="0.5" />
                                    <path class="path" d="M 15,0
                                                            Q 5,0 5,10
                                                            Q 0,38 5,66
                                                            Q 5,76 15,76"
                                    />
                                    <line x1="15" y1="0" x2="calc(100% - 15px)" y2="0" />
                                </svg>

                            </div>
                        </div>
                    </div>

                    <button class="button-r modal-main__button">
                        <span>Подробнее</span>
                        <div class="button-r__wrap">
                            <svg>
                                <clipPath id="svgPathModal">
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
                                <clipPath id="svgPathModalM">
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

            </form>
        </div>
    </div>
</template>

<script>
export default {
    name: "ModalMain"
}
</script>

<style scoped>

</style>
