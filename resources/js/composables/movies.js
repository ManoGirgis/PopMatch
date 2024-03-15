import { ref, inject } from 'vue'
import { useRouter } from 'vue-router'

export default function useMovies() {
    const movies = ref([])
    const movie = ref({
        title: ''
    })

    const router = useRouter()
    const validationErrors = ref({})
    const isLoading = ref(false)
    const swal = inject('$swal')

    const getMovies = async (
        page = 1,
        search_id = '',
        search_title = '',
        search_global = '',
        order_column = 'id',
        order_direction = 'desc'
    ) => {
        axios.get('/api/movies?page=' + page +
            '&search_id=' + search_id +
            '&search_title=' + search_title +
            '&search_global=' + search_global +
            '&order_column=' + order_column +
            '&order_direction=' + order_direction)
            .then(response => {
                movies.value = response.data;
            })
    }

    const getMovie = async (id) => {
        axios.get('/api/movies/' + id)
            .then(response => {
                movie.value = response.data;
            })
    }

    const storeMovie = async (movie) => {
        if (isLoading.value) return;

        isLoading.value = true
        validationErrors.value = {}

        let serializedPost = new FormData()
        for (let item in movie) {
            if (movie.hasOwnProperty(item)) {
                serializedPost.append(item, movie[item])
            }
        }

        axios.post('/api/movies', serializedPost)
            .then(response => {
                router.push({ name: 'movies.index' })
                swal({
                    icon: 'success',
                    title: 'Movie saved successfully'
                })
            })
            .catch(error => {
                if (error.response?.data) {
                    validationErrors.value = error.response.data.errors
                }
            })
            .finally(() => isLoading.value = false)
    }

    const updateMovie = async (movie) => {
        if (isLoading.value) return;

        isLoading.value = true
        validationErrors.value = {}

        axios.put('/api/movies/' + movie.id, movie)
            .then(response => {
                router.push({ name: 'movies.list' })
                swal({
                    icon: 'success',
                    title: 'Movie updated successfully'
                })
            })
            .catch(error => {
                if (error.response?.data) {
                    validationErrors.value = error.response.data.errors
                }
            })
            .finally(() => isLoading.value = false)
    }

    const deleteMovie = async (id, index) => {

console.log("delete"+ id)

        swal({
            title: 'Are you sure?',
            text: 'You won\'t be able to revert this action!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, delete it!',
            confirmButtonColor: '#ef4444',
            timer: 20000,
            timerProgressBar: true,
            reverseButtons: true
        })
            .then(result => {
                if (result.isConfirmed) {
                    axios.delete('/api/movies/' + id)
                        .then(response => {
                            //getMovie()
                            //router.push({ name: 'movies.index' })
                            movies.value.splice(index, 1)
                            swal({
                                icon: 'success',
                                title: 'Movie deleted successfully'
                            })
                        })
                        .catch(error => {
                            swal({
                                icon: 'error',
                                title: 'Something went wrong'
                            })
                        })
                }
            })
    }
      

    return {
        movies,
        movie,
        getMovies,
        getMovie,
        storeMovie,
        updateMovie,
        deleteMovie,
        validationErrors,
        isLoading
    }
}
