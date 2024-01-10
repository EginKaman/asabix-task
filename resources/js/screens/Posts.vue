<template>
    <v-btn to="posts/create">Create post</v-btn>
    <v-btn v-for="l in langs" @click="changeLang(l)">{{ l }}</v-btn>
    <v-table density="compact">
        <thead>
        <tr>
            <th class="text-left">
                Title
            </th>
            <th class="text-left">
                Created at
            </th>
            <th class="text-left">
                Updated at
            </th>
            <th class="text-left">

            </th>
        </tr>
        </thead>
        <tbody>
        <tr
            v-for="post in posts"
            :key="post.id"
        >
            <td>{{ post.title }}</td>
            <td>{{ post.created_at }}</td>
            <td>{{ post.updated_at }}</td>
            <td>
                <v-btn :to="`/posts/${post.id}`">Edit</v-btn>
                <v-btn @click="deletePost(post.id)">Delete</v-btn>
            </td>
        </tr>
        </tbody>
    </v-table>
    <v-btn @click="showMore" v-if="links.next">Show more</v-btn>
</template>

<script>

export default {
    name: "Posts",
    data() {
        return {
            posts: {},
            links: {},
            lang: 'en',
            langs: [
                'en',
                'uk',
                'ru'
            ]
        }
    },
    beforeMount() {
        this.getPosts();
    },
    methods: {
        getPosts() {
            axios.get('/api/posts', {
                headers: {
                    'Accept-Language': this.lang
                }
            }).then(res => {
                this.posts = res.data.data;
                this.links = res.data.links;
            });
        },
        showMore() {
            axios.get(this.links.next, {
                headers: {
                    'Accept-Language': this.lang
                }
            }).then(res => {
                this.posts = [...this.posts, ...res.data.data];
                this.links = res.data.links
            });
        },
        deletePost(postId) {
            axios.delete(`/api/posts/${postId}`).then(res => {
                this.getPosts();
            }).catch(error => {
                this.errors = error.response.data;
            });
        },
        changeLang(lang) {
           this.lang = lang;
           this.getPosts();
        },
    }
}
</script>

<style scoped>

</style>
