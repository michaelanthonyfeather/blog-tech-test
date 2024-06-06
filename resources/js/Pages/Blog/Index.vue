<template>
    <Head title="Welcome" />
    <div class="relative min-h-screen flex flex-col items-center selection:bg-[#FF2D20] selection:text-white pt-8">
        <div class="relative w-full max-w-2xl px-6 lg:max-w-7xl">
            <Header />
            <main class="">
                <CreatePost v-if="$page.props.auth.user"/>
                <div class="flex justify-between align-middle mb-5 mt-10">
                    <h1 id="postTitle" class="text-4xl">Posts</h1>
                    <input
                        type="text"
                        class="search-input w-full md:w-1/2 lg:w-1/3 align-self-end rounded-md px-3 py-2"
                        placeholder="Search posts..."
                        @input="searchPosts"
                        v-model="searchVal"
                    >
                </div>
                <Posts :posts="posts" />
            </main>
        </div>
    </div>
</template>

<script setup>
import { Head, Link, router } from '@inertiajs/vue3';
import { ref, onMounted } from 'vue';
import axios from 'axios';
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import Header from '@/Layouts/Header.vue';
import CreatePost from '@/Pages/Blog/Partials/CreatePost.vue';
import Posts from '@/Pages/Blog/Partials/Posts.vue';

const props = defineProps({
    posts: {
        type: Object,
        required: true
    }
});

let searchVal = ref('');
let posts = ref([]);

onMounted(() => {
    posts.value = props.posts || [];
});

const searchPosts = async () => {
    const response = await axios.get('/search', { params: { searchVal: searchVal.value } });
    posts.value = response.data;
};

</script>
