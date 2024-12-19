<script setup>
    import { Link } from '@inertiajs/vue3'
    defineProps({
        pagination : Object
    })
</script>

<template>
    <nav class="relative flex justify-center">
        <Link
        v-for="link in pagination.links"
        :key="link.label"
        :href="link.url || '#'"
        v-html="link.label"
        class="flex items-center justify-center mx-1 px-3 py-2 text-sm rounded-lg text-gray-600 hover:bg-gray-200 hover:text-gray-600"
        :class="{ 'bg-indigo-200 text-indigo-600': link.active, 'opacity-50 cursor-default': !link.url }"/>
    </nav>
    
</template>