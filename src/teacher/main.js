import Vue from 'vue'
import '../plugins/vuetify.js'
import App from '../components/teacher'


Vue.config.productionTip = false;

// Initialize Firebase

new Vue({
    render: h => h(App),
}).$mount('#teacher');
