<template>
    <div class="row justify-content-center my-5">
        <div class="col-md-10">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <form @submit.prevent="submitForm">
                        
                        <div class="mb-3">
                            <label for="user-title" class="form-label">Title</label>
                            <input v-model="movies.title" id="user-title" type="text" class="form-control">
                            <div class="text-danger mt-1">
                                {{ errors.title }}
                            </div>
                            <div class="text-danger mt-1">
                                <div v-for="message in validationErrors?.title">
                                    {{ message }}
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="user-title" class="form-label">description</label>
                            <textarea v-model="movies.description" id="user-title" type="text" class="form-control"></textarea>
                            <div class="text-danger mt-1">
                                {{ errors.description }}
                            </div>
                            <div class="text-danger mt-1">
                                <div v-for="message in validationErrors?.description">
                                    {{ message }}
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="user-title" class="form-label">genre</label>
                            <input v-model="movies.genre" id="user-title" type="text" class="form-control">
                            <div class="text-danger mt-1">
                                {{ errors.genre }}
                            </div>
                            <div class="text-danger mt-1">
                                <div v-for="message in validationErrors?.genre">
                                    {{ message }}
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="duration" class="form-label">duration</label>
                            <input v-model="movies.duration" id="duration" type="text" class="form-control" pattern="([01]?[0-9]|2[0-3]):([0-5][0-9]):([0-5][0-9])">
                            <div class="text-danger mt-1">
                                {{ errors.duration }}
                            </div>
                            <div class="text-danger mt-1">
                                <div v-for="message in validationErrors?.duration">
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
    import { onMounted, reactive, watchEffect } from "vue";
    import { useRoute } from "vue-router";
    import useMovies from "@/composables/movies";

    const { updateMovie, getMovie, movie: postData, validationErrors, isLoading } = useMovies();

    import { useForm, useField, defineRule } from "vee-validate";
    import { required, min } from "@/validation/rules"
    defineRule('required', required)
    defineRule('min', min);

    // Define a validation schema
    const schema = {
        id: 'required',
        title: 'required',
        description: 'required',
        genre: 'required',
        duration: 'required',
    }

    // Create a form context with the validation schema
    const { validate, errors, resetForm } = useForm({ validationSchema: schema })
    // Define actual fields for validation
    const { value: id } = useField('id', null, { initialValue: '' });
    const { value: title } = useField('title', null, { initialValue: '' });
    const { value: description } = useField('description', null, { initialValue: '' });
    const { value: genre } = useField('genre', null, { initialValue: '' });
    const { value: duration } = useField('duration', null, { initialValue: '', label: 'role' });

    const movies = reactive({
        id,
        title,
        description,
        genre,
        duration,
    })

    const route = useRoute()
    function submitForm() {
        validate().then(form => { if (form.valid) updateMovie(movies) })
    }
    onMounted(() => {
        getMovie(route.params.id)
      // console.log(route.params.id)
    })
    // https://vuejs.org/api/reactivity-core.html#watcheffect
    watchEffect(() => {
        movies.id = postData.value.id 
        movies.title = postData.value.title
        movies.description = postData.value.description
        movies.genre = postData.value.genre
        movies.duration=postData.value.duration
    })
</script>
