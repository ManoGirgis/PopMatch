<template>
    <div class="container">
        <div class="row justify-content-center my-5">
            <div class="col-md-6">
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-transparent">{{ $t('register') }}</div>
                    <div class="card-body">
                        <form @submit.prevent="submitRegister">
                            <div class="">
                                <!-- Email -->
                                <div class="mb-3">
                                    <label for="firstname" class="form-label">{{ $t('Firstname') }}</label>
                                    <input v-model="registerForm.firstname" id="firstname" type="text"
                                        class="form-control" autofocus>
                                    <!-- Validation Errors -->
                                    <div class="text-danger mt-1">
                                        <div v-for="message in validationErrors?.firstname">
                                            {{ message }}
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="lastname" class="form-label">{{ $t('Lastname') }}</label>
                                    <input v-model="registerForm.lastname" id="lastname" type="text"
                                        class="form-control" autofocus>
                                    <!-- Validation Errors -->
                                    <div class="text-danger mt-1">
                                        <div v-for="message in validationErrors?.lastname">
                                            {{ message }}
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="username" class="form-label">{{ $t('Username') }}</label>
                                    <input v-model="registerForm.username" id="username" type="text"
                                        class="form-control" autofocus>
                                    <!-- Validation Errors -->
                                    <div class="text-danger mt-1">
                                        <div v-for="message in validationErrors?.username">
                                            {{ message }}
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="address" class="form-label">{{ $t('address') }}</label>
                                    <input v-model="registerForm.address" id="address" type="text" class="form-control"
                                        autofocus>
                                    <!-- Validation Errors -->
                                    <div class="text-danger mt-1">
                                        <div v-for="message in validationErrors?.address">
                                            {{ message }}
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="sex" class="form-label">{{ $t('sex') }}</label>
                                    <input v-model="registerForm.sex" id="sex" type="text" class="form-control"
                                        autofocus>
                                    <!-- Validation Errors -->
                                    <div class="text-danger mt-1">
                                        <div v-for="message in validationErrors?.sex">
                                            {{ message }}
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="email" class="form-label">{{ $t('Email') }}</label>
                                    <input v-model="registerForm.email" id="email" type="email" class="form-control"
                                        autocomplete="username">
                                    <!-- Validation Errors -->
                                    <div class="text-danger mt-1">
                                        <div v-for="message in validationErrors?.email">
                                            {{ message }}
                                        </div>
                                    </div>
                                </div>
                                <!-- Password -->
                                <div class="mb-4">
                                    <label for="password" class="form-label">
                                        {{ $t('Password') }}
                                    </label>
                                    <input v-model="registerForm.password" id="password" type="password"
                                        class="form-control" autocomplete="current-password">
                                    <!-- Validation Errors -->
                                    <div class="text-danger-600 mt-1">
                                        <div v-for="message in validationErrors?.password">
                                            {{ message }}
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-4">
                                    <label for="password_confirmation" class="form-label">
                                        {{ $t('confirm_password') }}
                                    </label>
                                    <input v-model="registerForm.password_confirmation" id="password_confirmation"
                                        type="password" class="form-control" autocomplete="current-password">
                                    <!-- Validation Errors -->
                                    <div class="text-danger-600 mt-1">
                                        <div v-for="message in validationErrors?.password_confirmation">
                                            {{ message }}
                                        </div>
                                    </div>
                                </div>

                                <!-- Buttons -->
                                <div class="flex items-center justify-end mt-4">
                                    <button class="btn btn-primary" :class="{ 'opacity-25': processing }"
                                        :disabled="processing">
                                        {{ $t('register') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>

import useAuth from '@/composables/auth'

const { registerForm, validationErrors, processing, submitRegister } = useAuth();

</script>
