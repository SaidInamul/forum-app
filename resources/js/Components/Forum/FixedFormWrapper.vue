<script setup>

</script>

<template>
    <div class="fixed bottom-0 w-full bg-white p-6 border-t-4 border-gray-100 space-y-3">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
           <slot name="header" />
           <div class="mt-4 space-y-3">
                <slot name="main" />
                <div class="mt-4">
                    <slot name="button"/>
                </div>
            </div>
        </div>
        
    </div>
</template>