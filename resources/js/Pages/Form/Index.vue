<script setup lang="ts">
import {Head} from "@inertiajs/vue3";
import {Form} from "@/types";
import AdminCard from "@/Shared/Form/AdminCard.vue";
import Pagination from "@/Shared/Pagination.vue";

const {user, forms} = defineProps<{
  user: { name: string }
  forms: {
    data: Array<Form>,
    links: Array<{
      active: boolean,
      label: string,
      url: string | null
    }>
  }
}>()
</script>

<template>
  <Head>
    <title>Forms</title>
  </Head>

  <!-- Welcome Message -->
  <section class="mb-4">
    <span class="text-3xl text-primary font-bold">Welcome Back {{ user.name }}</span>
  </section>
  <!-- Welcome Message -->

  <!-- Form Cards -->
  <div v-if="forms.data.length" class="grid md:grid-cols-2 lg:grid-cols-3 gap-3">
    <AdminCard
      v-for="form in forms.data"
      :key="form.id"
      :id="form.id?.toString()"
      :is-active="form.is_active"
      :exp-date="form.exp_date ? new Date(form.exp_date) : null"
    >
      <template #title>
        {{ form.title.length > 30 ? `${form.title.substring(0, 30)}...` : form.title }}
      </template>
      <template #description>
        {{ form.description.length > 60 ? `${form.description.substring(0, 60)}...` : form.description }}
      </template>
    </AdminCard>
  </div>

  <div v-else class="text-center">
    <span>You don't have any forms yet.</span>
  </div>
  <!-- Form Cards -->

  <!-- Pagination -->
  <div class="text-center mt-7">
    <Pagination :links="forms.links"/>
  </div>
  <!-- Pagination -->
</template>

<style scoped>

</style>
