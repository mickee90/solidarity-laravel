<template>
  <div class="lg:max-w-v-1/2 max-w-v-9/10 mx-auto">
    <div class="content">
      <div class="bg-white m-auto max-w-lg p-16 rounded-md w-full">
        <div class="flex flex-wrap -mx-3 mb-6">
          <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
            <label
              for="grid-first-name"
              class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
            >
              Förnamn
              <span class="required">*</span>
            </label>
            <input
              id="grid-first-name"
              type="text"
              placeholder="Förnamn"
              v-model="first_name"
              :class="{ 'border-red-500': $v.first_name.$error }"
              @blur="$v.first_name.$touch()"
              class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
            />
            <!-- class="appearance-none block w-full bg-gray-200 text-gray-700 border border-red-500 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" -->
            <p v-if="$v.first_name.$error" class="text-red-500 text-xs italic">
              Fältet är obligatoriskt
            </p>
          </div>
          <div class="w-full md:w-1/2 px-3">
            <label
              for="grid-last-name"
              class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
            >
              Efternamn
              <span class="required">*</span>
            </label>
            <input
              id="grid-last-name"
              type="text"
              placeholder="Efternamn"
              v-model="last_name"
              :class="{ 'border-red-500': $v.last_name.$error }"
              @blur="$v.last_name.$touch()"
              class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
            />
            <p v-if="$v.last_name.$error" class="text-red-500 text-xs italic">
              Fältet är obligatoriskt
            </p>
          </div>
        </div>
        <div class="flex flex-wrap -mx-3 mb-6">
          <div class="w-full px-3">
            <label
              for="grid-username"
              class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
            >
              E-post
              <span class="required">*</span>
            </label>
            <input
              id="grid-username"
              type="email"
              placeholder="E-post"
              v-model="username"
              :class="{ 'border-red-500': $v.username.$error }"
              @blur="$v.username.$touch()"
              class="appearance-none block w-full bg-gray-200 text-gray-700 mb-3 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
            />
            <p v-if="$v.username.$error" class="text-red-500 text-xs italic">
              Fältet är obligatoriskt
            </p>
            <p class="text-gray-600 text-xs italic">
              E-posten kommer användas som ditt användarnamn och kontaktuppgift
            </p>
          </div>
        </div>
        <div class="flex flex-wrap -mx-3 mb-6">
          <div class="w-full px-3">
            <label
              for="grid-password"
              class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
            >
              Lösenord
              <span class="required">*</span>
            </label>
            <input
              id="grid-password"
              type="password"
              placeholder="******************"
              v-model="password"
              :class="{ 'border-red-500': $v.password.$error }"
              @blur="$v.password.$touch()"
              class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
            />
            <p v-if="$v.password.$error" class="text-red-500 text-xs italic">
              Lösenordet matchar inte med kraven
            </p>
            <p class="text-gray-600 text-xs italic">
              Kräver minst {{ $v.password.$params.minVal }} tecken
            </p>
          </div>
        </div>
        <div class="flex flex-wrap -mx-3 mb-6">
          <div class="w-full px-3">
            <label
              for="grid-confirm-password"
              class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
            >
              Bekräfta lösenord
              <span class="required">*</span>
            </label>
            <input
              id="grid-confirm-password"
              type="password"
              placeholder="******************"
              v-model="password_confirmation"
              :class="{ 'border-red-500': $v.password_confirmation.$error }"
              @blur="$v.password_confirmation.$touch()"
              class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
            />
            <p
              v-if="$v.password_confirmation.$error"
              class="text-red-500 text-xs italic"
            >
              Lösenordet matchar inte med kraven
            </p>
          </div>
        </div>
        <div class="flex justify-between items-center mb-6">
          <div class="relative">
            <select
              v-model="account_type_id"
              class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
              id="grid-state"
              :class="{ 'border-red-500': $v.account_type_id.$error }"
              @change="$v.account_type_id.$touch()"
            >
              <option value="1">Företag</option>
              <option value="2">Förening</option>
              <option value="3">Privatperson</option>
            </select>
            <p
              v-if="$v.account_type_id.$error"
              class="text-red-500 text-xs italic"
            ></p>
            <div
              class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700"
            >
              <svg
                class="fill-current h-4 w-4"
                xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 20 20"
              >
                <path
                  d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"
                />
              </svg>
            </div>
          </div>
          <div class="relative">
            <select
              v-model="city_id"
              class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
              id="grid-state"
              :class="{ 'border-red-500': $v.city_id.$error }"
              @change="$v.city_id.$touch()"
            >
              <option value>Välj ort</option>
              <option value="3">Falkenberg</option>
              <option value="2">Halmstad</option>
              <option value="1">Varberg</option>
            </select>
            <p v-if="$v.city_id.$error" class="text-red-500 text-xs italic"></p>
            <div
              class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700"
            >
              <svg
                class="fill-current h-4 w-4"
                xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 20 20"
              >
                <path
                  d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"
                />
              </svg>
            </div>
          </div>
        </div>
        <div class="flex justify-end items-center">
          <div class>
            <div class="relative">
              <button class="btn btn-blue" @click="onRegister">
                Registrera
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { required, email, minLength, sameAs } from "vuelidate/lib/validators";

export default {
  data() {
    return {
      first_name: "",
      last_name: "",
      username: "",
      city_id: "",
      account_type_id: 1,
      password: "",
      password_confirmation: "",
    };
  },
  methods: {
    onRegister() {
      this.$v.$touch();

      if (this.$v.$error) return;

      this.$store.dispatch("auth/register", {
        username: this.username,
        email: this.username,
        first_name: this.first_name,
        last_name: this.last_name,
        city_id: this.city_id,
        account_type_id: this.account_type_id,
        password: this.password,
        password_confirmation: this.password_confirmation,
      });
    },
  },
  validations: {
    first_name: {
      required,
    },
    last_name: {
      required,
    },
    city_id: {
      required,
    },
    account_type_id: {
      required,
    },
    username: {
      required,
      email,
    },
    password: {
      required,
      minLen: minLength(6),
    },
    password_confirmation: {
      sameAs: sameAs("password"),
    },
  },
};
</script>

<style scoped>
.form-check {
  position: relative;
  display: block;
  padding-left: 1.25rem;
}

input.invalid {
  border: 1px solid red;
  background-color: #ffc9aa;
}

span.required {
  color: red;
}
</style>
