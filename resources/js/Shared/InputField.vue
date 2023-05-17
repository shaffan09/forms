<script setup lang="ts">

</script>

<template>
  <div class="form-control w-full">
    <label class="label">
      <span class="label-text font-semibold">
        <slot name="name"></slot>
      </span>
    </label>

    <slot name="description"></slot>

    <slot name="input"></slot>

    <label class="label">
      <span class="label-text-alt text-xs text-error">
        <slot name="error"></slot>
      </span>
    </label>
  </div>
</template>

<style scoped>

</style>
