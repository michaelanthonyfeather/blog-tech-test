<template>
    <Head :title="post.title" />
    <div class="relative min-h-screen flex flex-col items-center selection:bg-[#FF2D20] selection:text-white pt-8">
        <div class="relative w-full max-w-2xl px-6 lg:max-w-7xl">
            <Header :canLogin="canLogin" :canRegister="canRegister" />

            <main class="">
                <div class="post">
                    <div class="top-title flex justify-between">
                        <div class="left">
                            <h1 class="text-4xl font-bold">{{ post.title }}</h1>
                            <div class="text-gray text-2xl mb-4">{{ post.author }}</div>
                            <div class="flex items-center gap-2 mb-10">
                                <span>{{ post.published_at }}</span>
                                <span>•</span>
                                <span>{{ post.read_time }} min read</span>
                            </div>
                        </div>
                        <div class="right flex justify-end">
                            <LikeButton ></LikeButton>
                            <div v-if="post.likes.length > 1" class="h-max mt-1 ml-3">{{ post.likes }} likes</div>
                        </div>
                    </div>
                    <p class="text-lg" v-html="post.content"></p>

                    <div class="more mt-24">
                        <h2 class="text-2xl font-medium mb-5">More Posts</h2>
                        <Posts :posts="morePosts"></Posts>
                    </div>

                </div>
            </main>
        </div>
    </div>
</template>

<script setup>
import { defineProps } from 'vue';
import { Head, Link } from '@inertiajs/vue3';

import LikeButton from '@/Pages/Blog/Partials/LikeButton.vue';
import Posts from '@/Pages/Blog/Partials/Posts.vue';
import Header from '@/Layouts/Header.vue';

defineProps({
    post: {
        type: Object,
        required: true
    },
    morePosts: {
        type: Object,
        required: true
    },
    canLogin: {
        type: Boolean,
        required: true
    },
    canRegister: {
        type: Boolean,
        required: true
    }
});

</script>

