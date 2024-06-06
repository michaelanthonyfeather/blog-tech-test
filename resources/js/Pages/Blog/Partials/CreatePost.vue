<template>
    <h2 class="text-3xl mb-5">Create Post</h2>
    <form @submit.prevent="submit" class="space-y-4">
        <div class="md:flex md:space-x-4">
            <div class="md:w-1/2 w-full space-y-2">
                <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
                <input v-model="form.title" type="text" id="title" @blur="makeSlug" name="title" class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
            </div>
            <div class="md:w-1/2 w-full space-y-2">
                <label for="slug" class="block text-sm font-medium text-gray-700">Slug</label>
                <input v-model="form.slug" type="text" id="slug" name="slug" class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
            </div>
        </div>
        <div class="space-y-2">
            <label for="content" class="block text-sm font-medium text-gray-700">Content</label>
            <Editor v-if="apiKey"
                :modelValue="form.content" @update:modelValue="val => form.content = val" id="content" name="content"
                :api-key="apiKey"
                :init="{
                    plugins: '',
                    branding: false,
                    menubar: false,
                    toolbar: 'undo redo | formatselect | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat',
                }"
            />
            <textarea
                v-else name="content" id="content" rows="10"
                class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
            ></textarea>
        </div>
        <input type="hidden" name="user_id" v-model="form.user_id"/>
        <div class="flex justify-center flex-wrap">
            <div v-if="$page.props.errors" class="w-full text-center mb-4">
                <ul>
                    <li class="text-red-700" v-for="(error, index) in $page.props.errors" :key="index">{{ error }}</li>
                </ul>
            </div>
            <button type="submit" class="button primary">
                Submit
            </button>
        </div>
    </form>
</template>

<script setup>
import { computed, reactive } from 'vue';
import { router } from '@inertiajs/vue3';
import Editor from '@tinymce/tinymce-vue';

const form = reactive({
    title: null,
    slug: null,
    content: null,
})

const apiKey = computed(() => import.meta.env.VITE_TINY_MCE_API_KEY);

function makeSlug() {
    if (!form.title) {
        return;
    }
    form.slug = form.title.toLowerCase().replace(/ /g, '-').replace(/[^a-z0-9-]/g, '');
}

function submit() {
    router.post('/posts', form, {
        preserveScroll: true,
        onSuccess: () => {
            router.visit('/',  {
                only: ['posts'],
                preserveScroll: true,
            });

            var section = document.getElementById('postTitle');
            if (section) {
                section.scrollIntoView({ behavior: 'smooth' });
            }
        }
    });
}
</script>
