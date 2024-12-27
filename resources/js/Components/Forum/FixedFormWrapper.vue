<script setup>
    import { ref, watch } from 'vue';
    import MarkdownShortcutToolbar from './MarkdownShortcutToolbar.vue';
    import Switch from '../Switch.vue';

    const props = defineProps({
        form : {
            type : Object
        }
    })

    const markdownPreviewEnabled = ref(false)
    const markdownPreviewHtml = ref('')
    const markdownPreviewLoading = ref(false)

    watch (markdownPreviewEnabled, (toggled) => {
        if (!toggled) {
            return
        }

        markdownPreviewLoading.value = true
        axios.post(route('markdown'), {
            body : props.form.body
        }).then((response) => {
            markdownPreviewHtml.value = response.data.html
            markdownPreviewLoading.value = false
        })
    })
</script>

<template>
    <form class="fixed bottom-0 w-full bg-white p-6 border-t-4 border-gray-100 space-y-3">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
           <slot name="header" />
           <div class="mt-4 space-y-3">
                <slot name="main" :markdownPreviewEnabled="markdownPreviewEnabled"/>
                <div 
                class="h-48 bg-gray-100 rounded-lg px-3 py-2 overflow-y-scroll border border-gray-300 shadow-sm"
                v-if="markdownPreviewEnabled" v-html="markdownPreviewHtml" :class="{ 'opacity-50' : markdownPreviewLoading }"></div>
                <div class="flex items-center justify-between">
                    <MarkdownShortcutToolbar for="body"/>
                    <!-- <div class="flex items-center space-x-3">
                        <Switch />
                    </div> -->
                    <button 
                    @click="markdownPreviewEnabled = !markdownPreviewEnabled"
                    type="button"
                    class="bg-gray-200 px-3 py-2 text-sm rounded-lg text-gray-600 hover:bg-rose-200 hover:text-rose-600">
                        Toggle Mardown
                    </button>
                </div>
                <div class="mt-4">
                    <slot name="button"/>
                </div>
            </div>
        </div>
    </form>
</template>