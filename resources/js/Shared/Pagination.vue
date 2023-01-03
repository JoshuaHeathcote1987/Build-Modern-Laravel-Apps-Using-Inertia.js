<template>
    <component 
        class="px-1"
        :class="{ 'text-gray-500': ! link.url, 'font-bold' : link.active }"
        :is="link.url ? 'Link' : 'span'"
        :key="link"
        v-for="link in links"
        :href="link.url"
        v-html="link.label"
    />
</template>

<script>
    export default {
        props: {
            links:  Array
        }
    }
</script>