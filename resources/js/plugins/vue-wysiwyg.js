import Vue from 'vue';
import wysiwyg from 'vue-wysiwyg';
Vue.use(wysiwyg, {
    hideModules: {'image': true, 'table': true, 'code': true},
});
