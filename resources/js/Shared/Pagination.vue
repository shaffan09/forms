<script setup lang="ts">
import { Link } from "@inertiajs/vue3";

const { links } = defineProps<{
  links: Array<{
    active: boolean;
    label: string;
    url: string | null;
  }>;
}>();
</script>

<template>
  <!-- paginator -->
  <div class="mt-6 btn-group">
    <Component
      v-for="link in links"
      :is="link.url ? Link : 'span'"
      :href="link.url"
      class="btn btn-sm"
      :class="{ 'btn-disabled': !link.url, 'btn-primary': link.active }"
      v-html="link.label"
    />
  </div>
  <!-- paginator -->
</template>
