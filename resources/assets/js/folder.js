require('./vue-asset');
Vue.component('create-folder', require('./components/folder/CreateFolder.vue'));
Vue.component('view-folder', require('./components/folder/ViewFolder.vue'));

const app = new Vue({
    el: '#app'
});
