<script setup>
import { ref } from 'vue'

const isChecked = ref(false)

const handleCheckboxChange = () => {
  isChecked.value = !isChecked.value
}
</script>

<template>
  <label class="flex cursor-pointer select-none items-center space-x-3">
    <span>Preview Markdown</span>
    <div class="relative">
      <input type="checkbox" class="sr-only" @change="handleCheckboxChange" />
      <div
      class="block h-6 w-10 rounded-full bg-[#E5E7EB]"
      :class="{'bg-rose-300': isChecked }"></div>
      <div
        :class="{ 'translate-x-full bg-rose-500': isChecked }"
        class="dot absolute left-1 top-1 h-4 w-4 rounded-full bg-white transition"
      ></div>
    </div>
  </label>
</template>
