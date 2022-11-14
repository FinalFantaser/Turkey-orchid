<template>
    <section id="send" class="section send">

        <form @submit.prevent="postData" action="#" class="container send__container">
            <p class="section__overhead send__overhead">Обратиться к нам</p>
            <h3 class="section__title send__title">У вас остались вопросы?</h3>

            <div class="send__box">
                <div class="input-group send__input-group">
                    <label class="send__label label" for="sendName">Ваше имя*</label>
                    <div class="send__input-wrap input-wrap">
                        <input
                            v-model="name"
                            placeholder="Имя"
                            id="sendName"
                            type="text"
                            class="input-r send__input"
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

                <div class="input-group send__input-group">
                    <label class="send__label label" for="sendTel">Ваш телефон*</label>
                    <div class="send__input-wrap input-wrap">
                        <input
                            v-model="phone"
                            v-maska="'+# (###) ###-##-##'"
                            placeholder="+_ (___) ___ - __-__"
                            id="sendTel" type="text"
                            class="input-r send__input">
                        <svg class="input-wrap__svg" fill="none"
                        >
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

            <button class="button-r send__button">
                <span>Позвонить мне</span>
                <div class="button-r__wrap">
                    <svg>
                        <clipPath id="svgPathSend">
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
                        <clipPath id="svgPathSendM">
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

        </form>

    </section>
    <!-- /.section send -->
</template>

<script>
import { useVuelidate } from '@vuelidate/core'
import { required, minLength } from '@vuelidate/validators'
import post from "../../../store/cervices/postData";
import { useToast } from "vue-toastification";

export default {
    setup () {
        return {
            v$: useVuelidate(),
            toast: useToast()
        }
    },
    name: "Send",
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
