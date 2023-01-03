<template>
    <Head>
        <title>My app - Generic</title>
    </Head>
    <section class=" p-6 bg-gray-200">
        <header class="flex justify-between">
            <div class="flex item-center">
                <h1 class="font-bold text-lg">
                    My App
                </h1>
                <p class="text-sm ml-4 mt-1">
                    Welcome Back, {{ username }}
                </p>
            </div>
            <Nav />
        </header>
    </section>
    <section class="px-6">
        <div class="max-w-3xl mx-auto mt-3">
            <slot />
        </div>
    </section>
</template>

<script>
    import Nav from "./Nav.vue"
    import { Head } from "@inertiajs/inertia-vue3";
    export default {
        components: { Nav, Head },

        computed: {
            username() {
                return this.$page.props.auth.user.username;
            }
        }
    }

    
</script>
