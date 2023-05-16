<script lang="ts">
import AuthLayout from "@/Shared/AuthLayout.vue";

export default {
  layout: AuthLayout,
}
</script>

<script setup lang="ts">
import InputField from "@/Shared/InputField.vue";
import {Head, useForm} from "@inertiajs/vue3";

const {errors} = defineProps<{
  errors: {
    name: string,
    email: string,
    password: string,
  }
}>()

let form = useForm({
  name: '',
  email: '',
  password: '',
  password_confirmation: ''
})

function submit() {
  form.post('/signup');
}
</script>

<template>
  <Head>
    <title>Sign in</title>
  </Head>

  <div class="sm:w-1/2 lg:w-1/3 mx-auto">
    <div class="p-4 shadow-lg rounded-lg">
      <form @submit.prevent="submit" action="/" method="POST">
        <InputField>
          <template #name>Name</template>
          <template #input>
            <input v-model="form.name" name="name" type="text" class="input input-bordered w-full" required/>
          </template>
          <template #error>{{ errors.name }}</template>
        </InputField>

        <InputField>
          <template #name>Email</template>
          <template #input>
            <input v-model="form.email" name="email" type="email" class="input input-bordered w-full" required/>
          </template>
          <template #error>{{ errors.email }}</template>
        </InputField>

        <InputField>
          <template #name>Password</template>
          <template #input>
            <input v-model="form.password" name="password" type="password" class="input input-bordered w-full"
                   required/>
          </template>
          <template #error>{{ errors.password }}</template>
        </InputField>

        <InputField>
          <template #name>Confirm Password</template>
          <template #input>
            <input v-model="form.password_confirmation" name="password_confirmation" type="password"
                   class="input input-bordered w-full" required/>
          </template>
          <!--          <template #error>error</template>-->
        </InputField>

        <div class="w-full text-right">
          <button type="submit" class="btn btn-accent" :disabled="form.processing">
            Sign up
          </button>
        </div>
      </form>
    </div>
  </div>
</template>

<style scoped>

</style>
