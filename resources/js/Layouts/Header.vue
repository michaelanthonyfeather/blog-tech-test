<template>
    <header class="flex justify-content-around gap-2 pb-10 lg:grid-cols-3">
        <div class="flex">
            <Link :href="route('blog.index')">
                <ApplicationLogo/>
            </Link>
        </div>
        <nav  class="-mx-3 flex flex-1 justify-end items-center">
            <Link
                :href="route('blog.index')"
                class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
            >
                Blog
            </Link>
            <template v-if="$page.props.auth.user">
                <LogoutButton/>
            </template>

            <template v-else>
                <Link
                    :href="route('login')"
                    class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
                >
                    Log in
                </Link>

                <Link
                    :href="route('register')"
                    class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
                >
                    Register
                </Link>
            </template>
        </nav>
    </header>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';
import { defineProps } from 'vue';

import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import LogoutButton from '@/Components/LogoutButton.vue';

</script>
