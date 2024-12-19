<script setup>
import ForumLayout from '@/Layouts/ForumLayout.vue'
import Select from '@/Components/Select.vue'
import InputLabel from '@/Components/InputLabel.vue'
import Pagination from '@/Components/Pagination.vue'
import Discussion from '@/Components/Forum/Discussion.vue'
import { Head } from '@inertiajs/vue3'

defineProps({
    discussions : {
        type : Object
    }
})
</script>

<template>
    <Head title="Forum" />
    <ForumLayout>
        <!-- <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Dashboard</h2>
        </template> -->
        <template #left>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">Left</div>
            </div>
        </template>
        <div class="space-y-6">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div>
                        <InputLabel for="topic" value="Topic" class="sr-only"/>
                        <Select id="topic">
                            <option 
                            value="">
                                All topics
                            </option>
                            <option 
                            value="topic.slug"
                            v-for="topic in $page.props.topics"
                            :key="topic.id">
                                {{ topic.name }}
                            </option>
                        </Select>
                    </div>
                </div>
            </div>
            <div class="space-y-3" v-if="discussions.data.length">
                <Discussion
                v-for="discussion in discussions.data"
                :key="discussion.id"
                :discussion="discussion"/>
                <Pagination
                :pagination="discussions.meta"/>
            </div>
        </div>
    </ForumLayout>
</template>
