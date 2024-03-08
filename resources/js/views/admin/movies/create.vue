
<template>
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between pb-2 mb-2">
                <h5 class="card-title">Añade una tarea nueva</h5>
            </div>
 
 
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                <strong></strong>
            </div>
 
 
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                <strong></strong>
            </div>
                   {{ movie }}
            <form @submit.prevent="addmovie" >
                <div class="form-group mb-2">
                    <label>Title</label><span class="text-danger"> *</span>
                    <input type="text" class="form-control" placeholder="Movie Title"  v-model="movie.title">
                </div>
 
 
                <div class="form-group mb-2">
                    <label>Descripción</label><span class="text-danger"> *</span>
                    <textarea class="form-control" rows="3" placeholder="Descripción"  v-model="movie.description"></textarea>
                </div>

                <div class="form-group mb-2">
                    <label>Image</label><span class="text-danger"> *</span>
                    <input type="text" class="form-control" placeholder="Image" v-model="movie.image">
                </div>

                <div class="form-group mb-2">
                    <label>Rating</label><span class="text-danger"> *</span>
                    <input type="number" class="form-control" placeholder="rate" v-model="movie.rating" min="0.0" max ="5.0" step="0.1">
                </div>

                <div class="form-group mb-2">
                    <label>Genre</label><span class="text-danger"> *</span>
                    <input type="text" class="form-control" placeholder="genre" v-model="movie.genre">
                </div>

                <div class="form-gorup mb-2">
                    <label>duration</label><span class="text-danger">*</span>
                    <input class="form-control" type="text" name="duration" pattern="([01]?[0-9]|2[0-3]):([0-5][0-9]):([0-5][0-9])" v-model="movie.duration"/>
                </div>

                <div class="form-gorup mb-2">
                    <label>Release date</label><span class="text-danger">*</span>
                    <input class="form-control" type="datetime-local" name="date_open" v-model="movie.release_date"/>
                </div>
 
                <button type="submit" class="btn btn-primary mt-4 mb-4">Añadir Tarea</button>
 
 
            </form>
 
 
        </div>
    </div>
 </template>
 
 
 <script setup>
 import axios from "axios";
    import { ref, onMounted } from "vue";

    const movie = ref({})

  function addmovie(){
//console.log("send");
axios.post('/api/movies',movie.value)
.then(response =>(
    console.log(response)
))
.catch( error =>(
    console.log(error)
))
  }
    
 </script>
 
 
 <style>
 </style>
 