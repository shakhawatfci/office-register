require('./vue-asset');
Vue.component('create-file', require('./components/file/CreateFile.vue'));
Vue.component('view-file', require('./components/file/ViewFile.vue'));

const app = new Vue({
    el: '#app'
});
