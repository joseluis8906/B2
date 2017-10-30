import Vue from 'vue'
import VueMqtt from 'vue-mqtt'

//mqtt users
/*
android 12345678
desktop 87654321
web 56784321
*/

//vps de prueba
//Vue.use(VueMqtt, "http://test1.unixjs.com/ws/mqtt", {username: 'web', password: '56784321', clientId: 'chaletApp_' + Math.random().toString(16).substr(2, 8)})
//local host
Vue.use(VueMqtt, "http://site.com/ws/mqtt", {username: 'web', password: '56784321', clientId: 'chaletApp_' + Math.random().toString(16).substr(2, 8)})
// vps chalet
//Vue.use(VueMqtt, "wss://reservaselgranchalet.com:443/ws/mqtt", {username: 'web', password: '56784321', clientId: 'chaletApp_' + Math.random().toString(16).substr(2, 8)})
