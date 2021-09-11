<template>
    <div>
        <div v-if="isUpdated" class="-mt-12 mb-6 flex justify-end">
            <span class="text-sm px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-full dark:bg-green-700 dark:text-green-100">
                Update Successfull
            </span>
        </div>
        <div class="w-full mb-4 overflow-hidden rounded-lg shadow-sm border">
            <div class="w-full overflow-x-auto">
                <table class="w-full whitespace-no-wrap" v-if="renderComponent">
                    <thead>
                        <tr class=" text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                            <th class="px-4 py-3">#</th>
                            <th class="px-4 py-3">Name</th>
                            <th class="px-4 py-3">Description</th>
                            <th class="px-4 py-3">Created at</th>
                            <th class="px-4 py-3">Action</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                        <tr v-for="(category, index) in categories" :key="category.id" class="text-gray-700 dark:text-gray-400">
                            <td class="px-4 py-3 text-sm">
                                {{ index + 1 }}
                            </td>
                            <td class="px-4 py-3">
                                <div class="flex items-center text-sm">
                                    <div>
                                        <p class="font-semibold">
                                            {{ category.name ? category.name : "N/A" }}
                                        </p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-4 py-3 text-xs">
                                <div class="w-48">
                                    <p class="truncate">{{ category.description ? category.description : "N/A" }}</p>
                                </div>
                            </td>
                            <td class="px-4 py-3 text-xs">
                                {{ moment(category.created_at).fromNow() }}
                            </td>
                            <td class="px-4 py-3 text-xs">
                                <div class="flex items-center space-x-4 text-sm">
                                    <button @click="openModel(index)" class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-black rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray" aria-label="Edit">
                                        <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"></path>
                                        </svg>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <Pagination
                v-if="renderComponent"
                @set-active-page="setActivePage"
                :total="pagination.total"
                :pageCount="pagination.dataCount"
                :activePage="pagination.activePage"
            />
            <div v-if="is_modal_open" class="fixed inset-0 z-30 flex items-end bg-black bg-opacity-50 sm:items-center sm:justify-center">
                <div v-if="is_modal_open" class="w-full px-6 py-4 overflow-hidden bg-white rounded-t-lg dark:bg-gray-800 sm:rounded-lg sm:m-4 sm:max-w-xl" role="dialog" id="modal">
                    <header class="flex justify-end">
                        <button @click="closeModal" class="inline-flex items-center justify-center w-6 h-6 text-gray-400 transition-colors duration-150 rounded dark:hover:text-gray-200 hover: hover:text-gray-700" aria-label="close">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20" role="img" aria-hidden="true">
                                <path d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" fill-rule="evenodd"></path>
                            </svg>
                        </button>
                    </header>

                    <p class="mb-4 text-lg font-semibold text-gray-700 dark:text-gray-300"> Edit category </p>
                    
                    <form @submit.prevent="updateCategory()">
                        <div class="mb-10">
                            <label class="block text-sm">
                                <span class="text-gray-700 dark:text-gray-400"> Name </span>
                                <input v-model="form_data.name" required class=" block w-full mt-1 text-sm dark:text-gray-300 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-red form-input rounded" placeholder="category name"/>
                            </label>

                            <label class="block text-sm mt-4">
                                <span class="text-gray-700 dark:text-gray-400"> Description </span>
                                <textarea v-model="form_data.description" required class="block w-full mt-1 text-sm dark:text-gray-300 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-red form-input rounded" placeholder="category description"/>
                            </label>

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
                        <div class="flex flex-col items-center justify-end px-6 py-3 -mx-6 -mb-4 space-y-4 sm:space-y-0 sm:space-x-6 sm:flex-row bg-gray-50 dark:bg-gray-800">
                            <button type="submit" :disabled="is_loading" class="w-full sm:w-auto inline-flex items-center justify-center gap-2 flex-none bg-gray-900 hover:bg-gray-700 text-gray-100 text-sm leading-6 font-semibold py-2 px-4 border border-transparent rounded-lg focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-100 focus:ring-black focus:outline-none transition-colors duration-300">
                                <span>Update Category</span> 
                                <span v-if="is_loading">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 animate-spin" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M4 2a1 1 0 011 1v2.101a7.002 7.002 0 0111.601 2.566 1 1 0 11-1.885.666A5.002 5.002 0 005.999 7H9a1 1 0 010 2H4a1 1 0 01-1-1V3a1 1 0 011-1zm.008 9.057a1 1 0 011.276.61A5.002 5.002 0 0014.001 13H11a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0v-2.101a7.002 7.002 0 01-11.601-2.566 1 1 0 01.61-1.276z" clip-rule="evenodd"/>
                                    </svg>
                                </span> 
                            </button>
                            <button @click="closeModal" class="w-full px-5 py-3 text-sm font-medium leading-5 text-gray-700 transition-colors duration-150 border border-gray-300 rounded-lg dark:text-gray-400 sm:px-4 sm:py-2 sm:w-auto active:bg-transparent hover:border-gray-500 focus:border-gray-500 active:text-gray-500 focus:outline-none focus:shadow-outline-gray">
                                Cancel
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Pagination from '../../Pagination.vue';
import { ref  } from "vue";
import moment from 'moment';
import CategoryService from "../../../services/CategoryService";                 
export default {
    components:{
        Pagination
    },
    async setup(){


        const response = ref(await CategoryService.index());
        const is_loading = ref(false);
        const isUpdated = ref(false);
        const errors = ref(null);
        async function updateCategory() {
            is_loading.value = true;
            CategoryService.update(form_data.value.id, form_data.value)
            .then((updateCategoryResponse) => {
                isUpdated.value = updateCategoryResponse.status;
                closeModal();
            })
            .catch((updateCategoryError) => {
                errors.value = updateCategoryError.response.data;
                isUpdated.value = false;
                is_loading.value = false;
            });
        }
        //modal functions
        const form_data = ref({});
        const is_modal_open = ref(false);
        // function openModel(index) {
        //     console.log('Ok Open::', categories);
        //     form_data.value = this.categories[index];
        //     is_modal_open.value = true;
        //     errors.value = null;
        // }
        function closeModal() {
            form_data.value = {};
            is_modal_open.value = false;
            errors.value = null;
            is_loading.value = false;
        }
        return {
            // openModel,
            closeModal,
            form_data,
            is_modal_open,
            updateCategory,
            isUpdated,
            response,
            is_loading,
            errors
        }
    },
    data() {
        return {
            pagination: {
                dataCount: 5,
                activePage:1,
                total:0
            },
            renderComponent:true,
            categories:[],
            categories_data:[],
            moment: moment
        }
    },
    created() {
        this.initialize();
    },
    methods: {
        openModel(index) {
            // console.log('Ok Open::', this.categories);
            this.form_data = this.categories[index];
            this.is_modal_open = true;
            this.errors = null;
        },
        initialize(){
            this.categories_data = this.response.data.categories;
            this.pagination.total = this.categories_data.length;
            this.paginateItems();
            // console.log(this.categories[0]);
        },
        forceRerender() {
            // Remove my-component from the DOM
            this.renderComponent = false;

            // If you like promises better you can
            // also use nextTick this way
            this.$nextTick().then(() => {
            // Add the component back in
            this.renderComponent = true;
            });
        },
        paginateItems(){
            const start = (this.pagination.activePage-1)*this.pagination.dataCount;
            this.categories = this.categories_data.slice(start, start+this.pagination.dataCount);
        },
        setActivePage(payload){
            // console.log('Setting Active Page:', payload);
            this.pagination.activePage = payload.page;
            this.paginateItems();
            // this.forceRerender();
        }

    },
}



</script>