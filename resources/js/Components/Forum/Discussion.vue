<script setup>
    defineProps({
        discussion : {
            type : Object
        }
    })
</script>

<template>
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900 flex items-center space-x-6">
            <div class="flex-grow">
                <div class="flex items-center space-x-3">
                    <span class="inline-flex rounded-lg bg-indigo-100 px-2 py-0.5 text-xs text-indigo-600">
                        {{ discussion.topic.name }}
                    </span>
                    <h1 class="text-lg font-medium">
                        <template v-if="discussion.is_pinned">
                            [Pinned]
                        </template>
                        {{ discussion.title }}
                    </h1>
                </div>
            </div>
            <div>
                avatars
            </div>
        </div>
    </div>
</template>