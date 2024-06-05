<template>
    <form method="POST" :action="route('logout')" @submit.prevent="logout" class="inline">
        <button type="submit" class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white">
            Logout
        </button>
    </form>
</template>

<script setup>
import { router, usePage } from '@inertiajs/vue3'

function logout(event) {
    event.preventDefault();
    router.post('/logout', {
        preserveScroll: true,
        onSuccess: () => {
            usePage().props.auth.user = null
        }
    });
}
</script>
