<template>
    <div class="modal modal-main">
        <div class="modal__container">
            <form @submit.prevent="postData" action="#" class="modal-main__dialog">

                <picture ref="modalClose" class="modal-main__close">
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
                                <input
                                    v-model="name"
                                    placeholder="Имя"
                                    id="modalName"
                                    type="text"
                                    class="input-r moda-main__input"
                                >
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
                                <p v-if="v$.$dirty && v$.name.required.$invalid" class="invalid">Обязательное поле</p>
                            </div>
                        </div>

                        <div class="input-group modal-main__input-group">
                            <label class="modal-main__label label" for="modalTel">Ваше телефон*</label>
                            <div class="modal-main__input-wrap input-wrap">
                                <input
                                    v-model="phone"
                                    v-maska="'+# (###) ###-##-##'"
                                    placeholder="+_ (___) ___ - __-__"
                                    id="modalTel"
                                    type="tel"
                                    class="input-r modal-main__input"
                                >
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
                                <p v-if="v$.$dirty && v$.phone.required.$invalid" class="invalid">Обязательное поле</p>
                                <p v-else-if="v$.$dirty && v$.phone.minLength.$invalid" class="invalid">Не верный формат</p>
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="button-r modal-main__button">
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
import { useVuelidate } from '@vuelidate/core'
import { required, minLength } from '@vuelidate/validators'
import post from "../../store/cervices/postData";
import { useToast } from "vue-toastification";

export default {
    name: "ModalMain",
    setup () {
        return {
            v$: useVuelidate(),
            toast: useToast()
        }
    },
    data() {
        return {
            name: '',
            phone: ''
        }
    },
    methods: {
        clearData() {
            this.name = ''
            this.phone = ''
        },
        async postData() {

            const result = await this.v$.$validate()
            if (!result) {
                this.v$.$touch()
                return
            }

            this.$store.commit('loader/LOADER_TRUE')

            const obj = {
                name: this.name,
                phone: this.phone.replace(/\D/g, '')
            }
            await post.postData(obj)
                .then(response => {
                    console.log(response)
                    this.clearData()
                    this.v$.$reset()
                    this.$refs.modalClose.click()
                    this.$store.commit('loader/LOADER_FALSE')
                    this.toast.success("Заявка отправлена", {
                        timeout: 3000
                    });
                })
                .catch(error => {
                    console.log(error)
                    this.$store.commit('loader/LOADER_FALSE')
                    this.toast.error("Ошибка. Попробуйте ещё раз.", {
                        timeout: 3000
                    });
                })

        }
    },
    validations () {
        return {
            name: { required },
            phone: { required, minLength: minLength(18) }
        }
    }
}
</script>

<style scoped>

</style>
