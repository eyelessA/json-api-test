import * as VueRouter from "vue-router";

export default VueRouter.createRouter({

    history: VueRouter.createWebHistory('/'),
    routes: [
        {
            path: '/adverts', component: () => import('./components/Advert/IndexComponent.vue'),
            name: 'advert.index'
        },
        {
            path: '/adverts/:id', component: () => import('./components/Advert/ShowComponent.vue'),
            name: 'advert.show'
        },
        {
            path: '/adverts', component: () => import('./components/Advert/StoreComponent.vue'),
            name: 'advert.store'
        },
    ],
})


