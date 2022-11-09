import {createApp} from 'vue'
import TestApp from './components/Test.vue'

const app = createApp({components: {
    TestApp
}})

app.mount("#app")
