import './assets/style.less'
import Vue from 'vue'
import App from './App'
import notadd from './notadd'
import router from './router'

Vue.debug = true
Vue.config.productionTip = false
Vue.http = notadd.http
Object.defineProperty(Vue.prototype, '$http', () => {
  return notadd.http
})

notadd.instance = new Vue({
  el: '#app',
  router,
  template: '<App/>',
  components: { App }
})
