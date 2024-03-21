<template>
    <div class="row justify-content-center my-5">
        <div class="col-md-10">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <form @submit.prevent="submitForm">
                        <div class="mb-3">
                            <label for="user-firstname" class="form-label">Firstname</label>
                            <input v-model="post.firstname" id="user-firstname" type="text" class="form-control">
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
                            <label for="user-lastname" class="form-label">Lastname</label>
                            <input v-model="post.lastname" id="user-lastname" type="text" class="form-control">
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
                            <label for="user-username" class="form-label">username</label>
                            <input v-model="post.username" id="user-username" type="text" class="form-control">
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
                            <label for="user-address" class="form-label">address</label>
                            <input v-model="post.address" id="user-address" type="text" class="form-control">
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
                            <label for="user-sex" class="form-label">sex</label>
                            <input v-model="post.sex" id="user-sex" type="text" class="form-control">
                            <div class="text-danger mt-1">
                                {{ errors.sex }}
                            </div>
                            <div class="text-danger mt-1">
                                <div v-for="message in validationErrors?.sex">
                                    {{ message }}
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input v-model="post.email" id="email" type="email" class="form-control">
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
                            <label for="password" class="form-label">Password</label>
                            <input v-model="post.password" id="password" type="password" class="form-control">
                            <div class="text-danger mt-1">
                                {{ errors.password }}
                            </div>
                            <div class="text-danger mt-1">
                                <div v-for="message in validationErrors?.password">
                                    {{ message }}
                                </div>
                            </div>
                        </div>
                        <!-- Role -->
                        <div class="mb-3">
                            <label for="post-category" class="form-label">
                                Role
                            </label>
                            <v-select multiple v-model="post.role_id" :options="roleList" :reduce="role => role.id" label="name" class="form-control" />
                            <div class="text-danger mt-1">
                                {{ errors.role_id }}
                            </div>
                            <div class="text-danger mt-1">
                                <div v-for="message in validationErrors?.role_id">
                                    {{ message }}
                                </div>
                            </div>
                        </div>
                        <!-- Buttons -->
                        <div class="mt-4">
                            <button :disabled="isLoading" class="btn btn-primary">
                                <div v-show="isLoading" class=""></div>
                                <span v-if="isLoading">Processing...</span>
                                <span v-else>Save</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>
<script setup>
    import { onMounted, reactive } from "vue";
    import useRoles from "@/composables/roles";
    import useUsers from "@/composables/users";

    const { roleList, getRoleList } = useRoles();
    const { storeUser, validationErrors, isLoading } = useUsers();

    import { useForm, useField, defineRule } from "vee-validate";
    import { required, min } from "@/validation/rules";
    defineRule('required', required);
    defineRule('min', min);

    // Define a validation schema
    const schema = {
        firstname: 'required',
        email: 'required',
        password: 'required|min:8',
    }
    // Create a form context with the validation schema
    const { validate, errors } = useForm({ validationSchema: schema })
    // Define actual fields for validation
    const { value: firstname } = useField('firstname', null, { initialValue: '' });
    const { value: username } = useField('username', null, { initialValue: '' });
    const { value: lastname } = useField('lastname', null, { initialValue: '' });
    const { value: address } = useField('address', null, { initialValue: '' });
    const { value: sex } = useField('sex', null, { initialValue: '' });
    const { value: email } = useField('email', null, { initialValue: '' });
    const { value: password } = useField('password', null, { initialValue: '' });
    const { value: role_id } = useField('role_id', null, { initialValue: '', label: 'role' });

    const post = reactive({
        firstname,
        lastname,
        username,
        address,
        sex,
        email,
        password,
        role_id,
    })
    function submitForm() {
        validate().then(form => { if (form.valid) storeUser(post) })
    }
    onMounted(() => {
        getRoleList()
    })
</script>
