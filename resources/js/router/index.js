import { createWebHistory, createRouter } from 'vue-router'
import TagCreate from "../screens/TagCreate.vue";
// import store from '@/store'
const Tags = () => import('@/screens/Tags.vue')

const TagsCreate = () => import('@/screens/TagCreate.vue')
/* Guest Component */

/* Layouts */
const AppLayout = () => import('@/layouts/App.vue')
/* Layouts */

/* Authenticated Component */
const Posts = () => import('@/screens/Posts.vue')
const PostCreate = () => import('@/screens/PostCreate.vue')
/* Authenticated Component */


const routes = [
    {
        path: "/",
        component: AppLayout,
        children: [
            {
                name: "posts",
                path: '/posts',
                component: Posts,
            },
            {
                name: "posts-create",
                path: '/posts/create',
                component: PostCreate,
            },
            {
                name: "posts-view",
                path: '/posts/:post',
                component: PostCreate,
            },
            {
                name: "tags",
                path: '/tags',
                component: Tags,
            },
            {
                name: "tags-create",
                path: '/tags/create',
                component: TagsCreate,
            },
            {
                name: "tags-view",
                path: '/tags/:tag',
                component: TagsCreate,
            },
        ]
    }
]

const router = createRouter({
    history: createWebHistory(),
    routes, // short for `routes: routes`
})
export default router
