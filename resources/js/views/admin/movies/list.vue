<template>
    <div class="grid">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between pb-2 mb-2">
                        <h5 class="card-title">all movies</h5>
                        <div>
                            <router-link :to= "{name: 'movie.create'}" class="btn btn-success">Nueva Peli</router-link>
                        </div>
                    </div>
 
 
                    <table class="table table-hover table-sm">
                        <thead class="bg-dark text-light">
                            <tr>
                                <th width="50" class="text-center">#</th>
                                <th>Name</th>
                                <th>description</th>
                                <th>release_date</th>
                                <th>genre</th>
                                <th class="text-center" width="200">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for ="movie in movies">
                                <td class="text-center">{{movie.id}}</td>
                                <td>{{movie.title}}</td>
                                <td>{{movie.description}}</td>
                                <td>{{movie.release_date}}</td>
                                <th>{{movie.genre}}</th>
                                <td class="text-center">
                                    <router-link :to= "{name: 'movie.edit', params:{id: movie.id}}" class="btn btn-warning mr-1">Edit</router-link>
                                    <button class="btn btn-danger">Delete</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
 </template>
 
 
 <script setup>
import axios from 'axios';
import { ref,onMounted } from 'vue';

 const movies = ref()
 

 onMounted(()=>(

    axios.get("/api/movies")
         .then(response =>(
            movies.value=response.data
            ))
 ))
 
 </script>
 
 
 <style>
 
 
 </style>
 