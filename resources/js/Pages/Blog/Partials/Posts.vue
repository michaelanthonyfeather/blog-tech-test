<template>
    <div v-if="posts && posts.length > 0" class="posts grid gap-6 md:grid-cols-2 lg:grid-cols-3 mb-10">
        <div v-for="post in posts" :key="post.id" class="post border border-gray-200 rounded-lg p-6 flex flex-col">
            <h2 class="text-2xl mb-4">{{ post.title }}</h2>
            <p class="mb-5">{{ post.summary }}</p>
            <div class="bottom mt-auto flex justify-between content-center flex-wrap">
                <Link :href="`/posts/${post.slug}`" class="button">Read More</Link>
                <LikeButton :postId="post.id" :isLiked="post.user_liked" />
            </div>
        </div>
    </div>
    <div v-else class="text-center text-2xl">No posts found</div>
</template>

<script setup>
import { Head, Link } from '@inertiajs/vue3';
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import LikeButton from '@/Pages/Blog/Partials/LikeButton.vue';

defineProps({
    posts: {
        type: Object,
        required: true
    }
});


</script>
