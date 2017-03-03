import './assets/style.less'
import Vue from 'vue'
import VueValidate from 'vee-validate'
import App from './App'
import notadd from './notadd'
import router from './router'

Vue.use(VueValidate)

Vue.config.productionTip = false
Vue.http = notadd.http
Object.defineProperty(Vue.prototype, 'http', {
  get: function () {
    return notadd.http
  }
})

notadd.instance = new Vue({
  el: '#app',
  router,
  template: '<App/>',
  components: { App }
})
