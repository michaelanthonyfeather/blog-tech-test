<template>
    <button v-if="$page.props.auth.user" class="h-max" @click="likePost">
        <svg :class="{ liked: isLiked }" xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-heart"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path></svg>
    </button>
</template>

<script setup>
import { ref } from 'vue';

const props = defineProps({
    postId: {
        type: Number,
        required: true
    },
    isLiked: {
        type: Boolean,
        required: true
    }
});

let isSubmitting = ref(false);
let isLiked = ref(props.isLiked);

async function likePost() {
    isSubmitting.value = true;
    try {
        const response = await axios.post('/posts/like', { post_id: props.postId });
        isLiked.value = response.data;
    } catch (error) {
        console.error(error);
    }

    isSubmitting.value = false;

}
</script>
