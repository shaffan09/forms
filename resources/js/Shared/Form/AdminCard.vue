<script setup lang="ts">
import {Link} from "@inertiajs/vue3";
import {ref} from 'vue'
import Trash from "@/Shared/Icons/Trash.vue";
import XMark from "@/Shared/Icons/XMark.vue";
import Check from "@/Shared/Icons/Check.vue";
import ArrowTopRight from "@/Shared/Icons/ArrowTopRight.vue";
import Pen from "@/Shared/Icons/Pen.vue";

const props = defineProps({
  id: {type: String, required: true},
  expDate: {type: Date, required: false},
  isActive: {type: Boolean, required: true},
})

const isDeleting = ref<boolean>(false)

let status = ''
let style = ''

if (props.expDate) {
  // if exp passed
  const thisTime = new Date()
  // const expTime = new Date(props.expDate)

  if (thisTime.getTime() > props.expDate.getTime()) {
    // if expired
    status = 'Expired'
    style = 'badge-error'
  } else {
    // if not expired
    if (!props.isActive) {
      // if not active
      status = 'Inactive'
      style = 'badge-warning'
    } else {
      status = 'Active'
      style = 'badge-success'
    }
  }
} else {
  // if exp not passed
  if (props.isActive) {
    status = 'Active'
    style = 'badge-success'
  } else {
    status = 'Inactive'
    style = 'badge-warning'
  }
}

function toggleDelete() {
  isDeleting.value = true

  setTimeout(() => {
    isDeleting.value = false
  }, 15000)
}
</script>

<template>
  <div class="card w-auto h-60 bg-base-100 shadow-xl">
    <div class="card-body">
      <div class="flex justify-between items-center">
        <Link>
          <h2 class="card-title">
            <slot name="title"></slot>
          </h2>
        </Link>
        <div class="badge" :class="style">{{ status }}</div>
      </div>
      <p>
        <slot name="description"></slot>
      </p>
      <div class="card-actions justify-between">
        <Link :href="`/forms/${id}/edit`" class="btn btn-primary btn-sm gap-2">
          <Pen/>
          Edit
        </Link>

        <div>
          <Link class="btn btn-info btn-outline btn-sm btn-circle mr-2">
            <ArrowTopRight/>
          </Link>

          <button
            v-show="!isDeleting"
            @click="toggleDelete"
            class="btn btn-error btn-outline btn-sm btn-circle">
            <Trash/>
          </button>

          <div class="btn-group" v-show="isDeleting">
            <button
              class="btn btn-sm btn-outline btn-error">
              <Check/>
            </button>

            <button
              @click="isDeleting = !isDeleting"
              class="btn btn-sm btn-outline btn-primary">
              <XMark/>
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<style scoped></style>
