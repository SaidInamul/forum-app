<script setup>
    import AuthenticatedLayout from './AuthenticatedLayout.vue';
</script>

<template>
    <AuthenticatedLayout>
        <div class="py-12 max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6 md:space-y-0 md:grid grid-cols-7 gap-6">
            <div class="col-span-2">
                <slot name="left" />
            </div>
            <div class="col-span-5">
                <slot />
            </div>
        </div>

    </AuthenticatedLayout>
</template>