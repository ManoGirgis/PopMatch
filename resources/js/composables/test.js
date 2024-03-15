import { ref, inject } from 'vue'
import { useRouter } from 'vue-router'

export default function useMovie() {
    const movie = ref({})
   
    return {
        movie
    }
}
