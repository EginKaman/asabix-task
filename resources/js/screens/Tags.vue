<template>

    <v-btn to="/tags/create">Create tag</v-btn>
    <v-table density="compact">
        <thead>
        <tr>
            <th class="text-left">
                Name
            </th>
            <th class="text-left">
                Created at
            </th>
            <th class="text-left">
                Updated at
            </th>
            <th class="text-left">
                Position
            </th>
        </tr>
        </thead>
        <tbody>
        <tr
            v-for="tag in tags"
            :key="tag.id"
        >
            <td>{{ tag.name }}</td>
            <td>{{ tag.created_at }}</td>
            <td>{{ tag.updated_at }}</td>
            <td>
                <v-btn :to="`/tags/${tag.id}`">Edit</v-btn>
                <v-btn @click="deleteTag(tag.id)">Delete</v-btn>
            </td>
        </tr>
        </tbody>
    </v-table>
    <v-btn @click="showMore" v-if="links.next">Show more</v-btn>
</template>

<script>
import {ref} from 'vue';
export default {

    name: "Tags",
    data() {
        return {
            tags: {},
            links: {}
        }
    },
    beforeMount() {
        this.getTags();
    },
    methods: {
        getTags() {
            axios.get('/api/tags').then(res => {
                this.tags = res.data.data;
                this.links = res.data.links;
            });
        },
        showMore() {
            axios.get(this.links.next).then(res => {
                this.tags = [...this.tags, ...res.data.data];
                this.links = res.data.links
            });
        },
        deleteTag(tagId) {
            axios.delete(`/api/tags/${tagId}`).then(res => {
                this.getTags();
            }).catch(error => {
                this.errors = error.response.data;
            });
        }
    }
}
</script>

<style scoped>

</style>
