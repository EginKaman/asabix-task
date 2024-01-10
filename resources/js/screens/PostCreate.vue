<template>
    <v-alert
        v-show="errors"
        icon="mdi-cloud-alert"
        prominent
        title=""
        type="error"
        variant="text"
    >
        <ul>
            <li v-for="error in errors.errors">{{ error[0] }}</li>
        </ul>
    </v-alert>
    <v-alert
        v-show="success"
        color="yellow-darken-4"
        icon="mdi-flash"
        title="Flat (Default)"
        variant="flat"
    >
        Post successfully created.
    </v-alert>
    <v-form
        ref="form"
        @submit.prevent="submit"
    >


        <v-select
            v-model="postTags"
            :items="tags"
            item-title="name"
            item-value="id"
            label="Tags"
            multiple
        ></v-select>

        <v-card v-for="translation in post.translations"
                :title="translation.language.locale">

            <v-text-field
                v-model="translation.title"
                label="Name"
                required
            ></v-text-field>

            <v-text-field
                v-model="translation.description"
                label="E-mail"
                required
            ></v-text-field>

            <v-textarea
                v-model="translation.content"
                label="Content"
                required
            ></v-textarea>
        </v-card>

        <v-btn
            color="success"
            class="mr-4"
            type="submit"
        >
            Submit
        </v-btn>
    </v-form>
</template>

<script>
export default {
    name: "PostCreate",
    data: () => ({
        post: {},
        tags: [],
        postTags: [],
        token: '',
        errors: [],
        success: false
    }),
    beforeMount() {
        if (this.$route.params.post) {
            this.getPost(this.$route.params.post)
        }
        this.getTags();
    },
    methods: {
        getTags() {
            axios.get(`/api/tags`).then(res => {
                this.tags = res.data.data;
            });
        },
        getPost(postId) {
            axios.get(`/api/posts/${postId}`).then(res => {
                this.post = res.data.data;
                this.postTags = res.data.data.tags.map(tag => tag.id);
            });
        },
        submit() {
            if (this.$route.params.post) {
                this.update(this.$route.params.post);
            } else {
                this.create();
            }
        },
        update(postId) {
            axios.post(`/api/posts/${postId}`, {
                _method: 'PUT',
                translations: this.post.translations,
                tags: this.postTags
            }).then(res => {
                this.post = res.data.data
            }).catch(error => {
                this.errors = error.response.data;
            });
        },
        create() {
            axios.post('/api/posts', {
                translations: this.post.translations,
                tags: this.postTags
            }).then(res => {
                this.post = res.data.data
            }).catch(error => {
                this.errors = error.response.data;
            });
        }
    }
}
</script>
