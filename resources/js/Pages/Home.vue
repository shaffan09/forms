<script setup lang="ts">

import {Head} from "@inertiajs/vue3";

const {user} = defineProps<{
  user: {name: string}
}>()
</script>

<template>
  <Head>
    <title>Home</title>
  </Head>

  <section class="mb-4">
    <span class="text-3xl text-primary font-bold">Welcome Back {{user.name}}</span>
  </section>

  <h1 class="">Home</h1>
</template>

<style scoped>

</style>
