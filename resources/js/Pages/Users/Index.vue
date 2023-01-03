<template>
    <Head>
        <title>Users</title>
    </Head>

    <div class="flex">
        <h1 class="text-2xl">Users!</h1>
        <div class="flex space-x-20">
            <input v-model="search" type="text" placeholder="search..." class="border px-2 rounded-lg ml-6">
            <NavLink v-if="can.createUser" href="/users/create" :active="$page.component == 'Users'" class="rounded-lg bg-slate-200">Create</NavLink>
        </div>
    </div>

    <table class="border w-full mt-6">
        <tbody>
        <tr v-for="user in users.data" :key="user.id">
            <td>{{ user.name }}</td>
            <td style="text-align: right; padding-right: 5px;">
                <Link :href="`/users/${user.id}/edit`">Edit</Link>
            </td>
        </tr>
        </tbody>
    </table>

    <Pagination :links="users.links" class="mt-6" />

</template>

<script setup>
    import Pagination from '../../Shared/Pagination.vue';
    import { ref, watch } from "vue";
    import { Inertia } from "@inertiajs/inertia";
    import debounce from "lodash/debounce"

    let props = defineProps({
        users: Object,
        filters: Object,
        can: Object,
    });

    let search = ref(props.filters.search);

    watch(search, debounce(function (value) {
        Inertia.get('/users', { search: value }, { preverseState: true, replace: true });
    }, 300));


</script>