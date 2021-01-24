import Vue from 'vue';
import 'vue-snotify/styles/dark.css';
import Snotify, { SnotifyPosition } from 'vue-snotify';

Vue.use(Snotify, {
    toast: {
        position: SnotifyPosition.rightTop,
        titleMaxLength: 60,
        bodyMaxLength: 150,
    },
});
