import Vue from 'vue';
import VueRouter from 'vue-router';

import Home from './pages/Home.vue';
import View from './pages/View.vue';
import Alerts from './pages/Alerts.vue';

Vue.use(VueRouter);

const router = new VueRouter({
    mode: 'hash',
    linkExactActiveClass: 'active',
    routes: [
        {
            path: '/',
            name: 'home',
            component: Home
        },
        {
            path: '/view/:currencyId',
            name: 'view',
            component: View
        },
        {
            path: '/alerts',
            name: 'alerts',
            component: Alerts
        },
    ]
});

export default router;
