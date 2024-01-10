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
        Tag successfully created.
    </v-alert>
    <v-form
        ref="form"
        @submit.prevent="submit"
    >
        <v-text-field
            v-model="name"
            label="Name"
            required
        ></v-text-field>

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
    name: "TagCreate",
    data: () => ({
        tag: {},
        name: '',
        errors: [],
        success: false
    }),
    beforeMount() {
        if (this.$route.params.tag) {
            this.getTag(this.$route.params.tag)
        }
    },
    methods: {
        getTag(tagId) {
            axios.get(`/api/tags/${tagId}`).then(res => {
                this.tag = res.data.data;
                this.name = this.tag.name;
            });
        },
        update(tagId, formData) {
            formData.append('_method','PUT')
            axios.post(`/api/tags/${tagId}`, formData).then(res => {
                this.errors = [];
                this.success = true;
            }).catch(error => {
                this.errors = error.response.data;
            });
        },
        create(formData) {
            axios.post('/api/tags', formData).then(res => {
                this.errors = [];
                this.success = true;
            }).catch(error => {
                this.errors = error.response.data;
            });
        },
        submit() {
            let formData = new FormData();
            formData.append('name', this.name);
            if (this.$route.params.tag) {
                this.update(this.$route.params.tag, formData);
            } else {
                this.create(formData);
            }
        }
    }
}
</script>
