import {createRouter, createWebHistory} from 'vue-router';

import AuthenticatedLayout from '@/Layouts/Authenticated.vue';
import GuestLayout from '@/Layouts/Guest.vue';

import PostsIndex from '@/Components/Posts/Index.vue'
import PostsCreate from '@/Components/Posts/Create.vue'
import PostsEdit from '@/Components/Posts/Edit.vue'
import Login from '@/Components/Auth/Login.vue'

function auth(to, from, next) {
    if (JSON.parse(localStorage.getItem('loggedIn'))) {
        next()
    }

    next('/login')
}

const routes = [
    {
        path: '/',
        redirect: { name: 'login' },
        component: GuestLayout,
        children: [
            {
                path: '/login',
                name: 'login',
                component: Login
            },
        ]
    },
    {
        component: AuthenticatedLayout,
        beforeEnter: auth,
        children: [
            {
                path: '/posts',
                name: 'posts.index',
                component: PostsIndex,
                meta: {
                    title: 'List of posts'
                }
            },
            {
                path: '/posts/create',
                name: 'posts.create',
                component: PostsCreate,
                meta: {
                    title: 'Add new post'
                }
            },
            {
                path: '/posts/edit/:id',
                name: 'posts.edit',
                component: PostsEdit,
                meta: {
                    title: 'Edit post'
                }
            }
        ]
    }
]

export default createRouter({
    history: createWebHistory(),
    routes
})
