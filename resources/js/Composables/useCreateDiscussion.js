import { ref } from "vue";
import { useForm } from "@inertiajs/vue3";

const visible = ref(false)

const form = useForm({
    topic : '',
    title : '',
    body : ''
})

export default () => {
    const showCreateDiscussionForm = () => {
        visible.value = true
    }

    const hideCreateDiscussionForm = () => {
        visible.value = false
    }
    return {
        visible,
        form,
        showCreateDiscussionForm,
        hideCreateDiscussionForm
    }
}