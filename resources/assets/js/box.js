require('./vue-asset');
Vue.component('create-box', require('./components/box/CreateBox.vue'));
Vue.component('view-box', require('./components/box/ViewBox.vue'));

const app = new Vue({
    el: '#app'
});
