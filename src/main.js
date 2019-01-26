import Vue from 'vue'
import './plugins/vuetify'
import App from './App.vue'


Vue.config.productionTip = false;

// Initialize Firebase

new Vue({
  render: h => h(App),
}).$mount('#app');
