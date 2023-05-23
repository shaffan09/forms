<script setup lang="ts">
import {Response} from "@/types";
import {ref} from "vue";
import Table from "@/Shared/Response/Table.vue";

defineProps<{
  responses: Response[]
  form_title: string
}>()

let tab = ref<string>('summary')
</script>

<template>
  <section class="p-7 shadow-md rounded-b-box">
    <div class="flex justify-between">
      <h1 class="text-2xl font-semibold">{{ form_title }}</h1>
      <span class="text-2xl">
        {{ responses.length }} {{ responses.length > 1 ? 'Responses' : 'Response' }}
      </span>
    </div>

    <!--Navigation Tabs-->
    <div class="tabs tabs-boxed mt-7">
      <button
        class="tab"
        :class="{'tab-active' : tab === 'summary'}"
        @click="tab='summary'"
      >
        Summary
      </button>
      <button
        class="tab"
        :class="{'tab-active' : tab === 'table'}"
        @click="tab='table'"
      >
        Table
      </button>
      <button
        class="tab"
        :class="{'tab-active' : tab === 'individual'}"
        @click="tab='individual'"
      >
        Individual
      </button>
    </div>
    <!--Navigation Tabs-->
  </section>

  <section v-if="responses.length" class="p-4 shadow-md rounded-b-box mt-7">
    <Table v-if="tab === 'table'" :responses="responses"/>
  </section>

  <section v-else class="p-4 shadow-md rounded-b-box mt-7 text-center">
    <span>No Response Yet.</span>
  </section>
</template>

<style scoped>

</style>
