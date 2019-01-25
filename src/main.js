import Vue from 'vue'
import './plugins/vuetify'
import App from './App.vue'
import firebase from 'firebase'

Vue.config.productionTip = false;

// Initialize Firebase
var config = {
  apiKey: "AIzaSyD8twKowSi1OFExb8i3oiwItWrXD3zZKKY",
  authDomain: "colsamapp.firebaseapp.com",
  databaseURL: "https://colsamapp.firebaseio.com",
  projectId: "colsamapp",
  storageBucket: "colsamapp.appspot.com",
  messagingSenderId: "374315306977"
};
firebase.initializeApp(config);

new Vue({
  render: h => h(App),
}).$mount('#app');
