<script setup lang="ts">
import {Response} from "@/types";

const {responses} = defineProps<{responses: Response[]}>()
</script>

<template>
  <div class="overflow-x-auto">
    <table class="table table-compact table-zebra w-full">
      <thead>
      <tr>
        <th>#</th>
        <th v-for="fieldValue in responses[0].field_values">
          {{fieldValue.name}}
        </th>
      </tr>
      </thead>
      <tbody>
      <tr v-for="n in responses.length">
        <th>{{ n }}</th>
        <td v-for="fieldValue in responses[n-1].field_values" :key="fieldValue.id">
          {{ fieldValue.value}}
        </td>
      </tr>
      </tbody>
    </table>
  </div>
</template>

<style scoped>

</style>
