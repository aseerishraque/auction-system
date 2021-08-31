<template>
    <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200"> Add Category </h2>
    <div class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
        <form @submit.prevent="storeCategory()" class="mt-4">
            <label class="block text-sm">
                <span class="text-gray-700 dark:text-gray-400"> Name </span>
                <input v-model="form_data.name" required class="block w-full mt-1 text-sm dark:text-gray-300 dark:bg-gray-700 form-input rounded border border-gray-700 focus:border-transparent focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-100 focus:ring-black focus:outline-none transition-colors duration-300" placeholder="category name"/>
            </label>

            <label class="block text-sm mt-4">
                <span class="text-gray-700 dark:text-gray-400"> Description </span>
                <textarea v-model="form_data.description" required class="block w-full mt-1 h-28 text-sm dark:text-gray-300 dark:bg-gray-700 form-input rounded border border-gray-700 focus:border-transparent focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-100 focus:ring-black focus:outline-none transition-colors duration-300" placeholder="category description"/>
            </label>
            
            <div class="mt-4 mb-2 flex flex-col md:flex-row-reverse items-center justify-between">
                <div class="flex items-center gap-4">
                    <LinkButton to="admin.category.index" name="index" utilitiClass="w-full py-2 px-4 inline-flex items-center justify-center gap-2 flex-none text-sm font-medium leading-6 text-gray-700 transition-colors duration-150 border border-gray-300 rounded-lg dark:text-gray-400 sm:px-4 sm:py-2 sm:w-auto active:bg-transparent hover:border-gray-500 focus:border-gray-500 active:text-gray-500 focus:outline-none focus:shadow-outline-gray">
                        <span>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                            </svg>
                        </span> 
                        <span>Back to category</span>
                    </LinkButton>
                    <button type="submit" :disabled="is_loading" class="w-full py-2 px-4 sm:w-auto inline-flex items-center justify-center gap-2 flex-none bg-gray-900 hover:bg-gray-700 text-gray-100 text-sm leading-6 font-semibold border border-transparent rounded-lg focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-100 focus:ring-black focus:outline-none transition-colors duration-300">
                        <span>Add Category</span> 
                        <span v-if="is_loading">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 animate-spin" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M4 2a1 1 0 011 1v2.101a7.002 7.002 0 0111.601 2.566 1 1 0 11-1.885.666A5.002 5.002 0 005.999 7H9a1 1 0 010 2H4a1 1 0 01-1-1V3a1 1 0 011-1zm.008 9.057a1 1 0 011.276.61A5.002 5.002 0 0014.001 13H11a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0v-2.101a7.002 7.002 0 01-11.601-2.566 1 1 0 01.61-1.276z" clip-rule="evenodd"/>
                            </svg>
                        </span> 
                    </button>
                </div>
                <span v-if="is_saved" class="mt-2 px-2 py-1 text-sm font-semibold leading-tight text-green-700 bg-green-100 rounded-full dark:bg-green-700 dark:text-green-100">
                    Category has been added
                </span>
            </div>
        </form>
        <div v-if="errors" class="mt-4 px-3 py-2 w-full rounded text-sm text-red-500 bg-red-100 animate-pulse">
            <p class="font-semibold tracking-wide">
                <strong>Error:</strong> {{ errors.message }}
            </p>
            <ul class="mt-1 ml-2 list-disc list-inside">
                <li v-for="allErrors in errors.errors" :key="allErrors">
                    <span v-for="errorKeys in allErrors" :key="errorKeys">
                        <span v-for="errorMessage in errorKeys" :key="errorMessage">
                            {{ errorMessage }}
                        </span> 
                    </span>
                </li>
            </ul>
        </div>
    </div>
</template>
<script setup>
import {ref} from "vue";
import LinkButton from '../../../components/LinkButton.vue';
import CategoryService from "../../../services/CategoryService";

const form_data = ref({name: "", description: ""});
const is_loading = ref(false);
const is_saved = ref(false);
const errors = ref(null);

function storeCategory() {
    is_loading.value = true;

    CategoryService.store(form_data.value)
    .then((storeCategoryResponse) => {
        is_saved.value = storeCategoryResponse.data.status;
        is_loading.value = false;
        form_data.value.name = "";
        form_data.value.description = "";
        errors.value = null;
        
    })
    .catch((storeCategoryError) => {
        errors.value = storeCategoryError.response.data;
        is_saved.value = false;
        is_loading.value = false;
    });
}
</script>