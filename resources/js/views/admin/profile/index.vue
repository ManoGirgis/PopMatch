<template>
    <div class="card border-0">
        <div class="card-header bg-transparent">
            <h5 class="float-start">Profile</h5>
        </div>
        <div class="card-body">
            <form @submit.prevent="submitForm">
                <div class="mb-3">
                    <label for="name" class="form-label">Firstname</label>
                    <input type="text" v-model="profile.firstname" class="form-control" id="name">
                    <div class="text-danger mt-1">
                        {{ errors.firstname }}
                    </div>
                    <div class="text-danger mt-1">
                        <div v-for="message in validationErrors?.firstname">
                            {{ message }}
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="name" class="form-label">Lastname</label>
                    <input type="text" v-model="profile.lastname" class="form-control" id="name">
                    <div class="text-danger mt-1">
                        {{ errors.lastname }}
                    </div>
                    <div class="text-danger mt-1">
                        <div v-for="message in validationErrors?.lastname">
                            {{ message }}
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="name" class="form-label">Username</label>
                    <input type="text" v-model="profile.username" class="form-control" id="name">
                    <div class="text-danger mt-1">
                        {{ errors.username }}
                    </div>
                    <div class="text-danger mt-1">
                        <div v-for="message in validationErrors?.username">
                            {{ message }}
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="name" class="form-label">address</label>
                    <input type="text" v-model="profile.address" class="form-control" id="name">
                    <div class="text-danger mt-1">
                        {{ errors.address }}
                    </div>
                    <div class="text-danger mt-1">
                        <div v-for="message in validationErrors?.address">
                            {{ message }}
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" v-model="profile.email" class="form-control" id="email">
                    <div class="text-danger mt-1">
                        {{ errors.email }}
                    </div>
                    <div class="text-danger mt-1">
                        <div v-for="message in validationErrors?.email">
                            {{ message }}
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <button :disabled="isLoading" class="btn btn-primary">
                        <div v-show="isLoading" class=""></div>
                        <span v-if="isLoading">Processing...</span>
                        <span v-else>Update</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</template>

<script setup>
import { onMounted, reactive, watchEffect } from "vue";
import { useForm, useField, defineRule } from "vee-validate";
import { required, min } from "@/validation/rules"
import useProfile from "@/composables/profile";
defineRule('required', required)
// defineRule('email', email)
defineRule('min', min);

    const schema = {
        email: 'required',
    }
    // Create a form context with the validation schema
    const { validate, errors } = useForm({ validationSchema: schema })
    // Define actual fields for validation
    const { value: firstname } = useField('firstname', null, { initialValue: '' });
    const { value: lastname } = useField('lastname', null, { initialValue: '' });
    const { value: username } = useField('username', null, { initialValue: '' });
    const { value: address } = useField('address', null, { initialValue: '' });
    const { value: email } = useField('email', null, { initialValue: '' });
    const { profile: profileData, getProfile, updateProfile, validationErrors, isLoading } = useProfile()
    const profile = reactive({
       firstname,
       lastname,
       username,
       address,
        email
    })
    function submitForm() {
        validate().then(form => { if (form.valid) updateProfile(profile) })
    }
    onMounted(() => {
        getProfile()
    })

    watchEffect(() => {
        profile.firstname = profileData.value.firstname
        profile.lastname = profileData.value.lastname
        profile.username = profileData.value.username
        profile.address = profileData.value.address
        profile.email = profileData.value.email
    })
</script>
