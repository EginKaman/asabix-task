<template>
    <v-app :theme="theme">
        <v-app-bar>
            <v-btn to="/posts"
                   variant="outlined"
                   color="primary"
            >Posts
            </v-btn>
            <v-btn to="/tags"
                   variant="outlined"
                   color="primary"
            >Tags
            </v-btn>
            <v-spacer></v-spacer>
        </v-app-bar>

        <v-main>
            <v-container>
                <router-view></router-view>
            </v-container>
        </v-main>
    </v-app>
</template>

<script setup>
import {ref} from 'vue'

const theme = ref('light')

function onClick() {
    theme.value = theme.value === 'light' ? 'dark' : 'light'
}
</script>
