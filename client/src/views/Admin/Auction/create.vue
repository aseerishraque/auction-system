<template>
<div>
    <router-link :to="{name: 'admin.auction.upcoming'}">
        <button class="float-left mt-5 w-full py-2 px-4 inline-flex items-center justify-center gap-2 flex-none text-sm font-medium leading-6 text-gray-700 transition-colors duration-150 border border-gray-300 rounded-lg dark:text-gray-400 sm:px-4 sm:py-2 sm:w-auto active:bg-transparent hover:border-gray-500 focus:border-gray-500 active:text-gray-500 focus:outline-none focus:shadow-outline-gray float-left">
            <span>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                </svg>
            </span> 
            View in Upcomming Auctions
        </button>                           
    </router-link>
    <br>
        <h2 class="clear-left my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200"> Add Auction </h2>
            <!-- <div class="bg-gray-500 pt-3">
                <div class="rounded-tl-4xl bg-gradient-to-r from-blue-400 to-gray-400 p-4 shadow text-2xl text-white">
                    <h3 class="font-bold pl-2">Add Auction</h3>
                </div>
            </div> -->
    <div class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
        <form @submit.prevent="storeAuction(form_data)" class="mt-4">
            <div class="max-h-96 overflow-y-auto flex flex-col gap-4">
                <div class="w-full flex items-center gap-4">
                    <label class="w-full block text-sm">
                        <span class="text-gray-700 dark:text-gray-400">
                            Start Date <span class="-ml-1 text-red-500">*</span>
                        </span>
                        <input type="datetime-local" required v-model="form_data.start_time" class="block w-full mt-1 text-sm dark:text-gray-300 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-red form-input rounded" placeholder="Product Price"/>
                        <!-- <div v-if="errors.start_time.length > 0" class="bg-red-100 border border-red-400 text-red-700 px-4 py-2 mt-1 rounded relative" role="alert">
                                <span class="block sm:inline">{{ errors.start_time[0]}}</span>
                        </div> -->
                    </label>
                    <label class="w-full block text-sm">
                        <span class="text-gray-700 dark:text-gray-400">
                            Close Date <span class="-ml-1 text-red-500">*</span>
                        </span>
                        <input type="datetime-local" required v-model="form_data.close_time" class="block w-full mt-1 text-sm dark:text-gray-300 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-red form-input rounded" placeholder="Product Price"/>
                        <!-- <div v-if="errors.close_time.length > 0" class="bg-red-100 border border-red-400 text-red-700 px-4 py-2 mt-1 rounded relative" role="alert">
                                <span class="block sm:inline">{{ errors.close_time[0]}}</span>
                        </div> -->
                    </label>
                    <label class="w-full block text-sm">
                        <span class="text-gray-700 dark:text-gray-400">
                            Result Date <span class="-ml-1 text-red-500">*</span>
                        </span>
                        <input type="datetime-local" required v-model="form_data.result_time" class="block w-full mt-1 text-sm dark:text-gray-300 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-red form-input rounded" placeholder="Product Price"/>
                        <!-- <div v-if="errors.close_time.length > 0" class="bg-red-100 border border-red-400 text-red-700 px-4 py-2 mt-1 rounded relative" role="alert">
                                <span class="block sm:inline">{{ errors.close_time[0]}}</span>
                        </div> -->
                    </label>
                </div>
            </div>

            <div class="max-h-96 overflow-y-auto flex flex-col gap-4">
                <div class="w-full flex items-center gap-4">
                    <label class="w-full block text-sm mt-5">
                        <span class="text-gray-700 dark:text-gray-400">
                            Select Category <span class="-ml-1 text-red-500">*</span>
                        </span>
                        <select @change="select_value" class="w-full block mt-1 text-sm dark:text-gray-300 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-red form-input rounded" required v-model="form_data.category_id">
                            <option class="py-1" value="0">
                                --Select Categories--
                            </option>
                            <option class="py-1" v-for="(item,index) in categories" :key="index" :value="item.id">
                                {{item.name}}
                            </option>
                        </select>
                        <!-- <div v-if="errors.product_id.length > 0" class="bg-red-100 border border-red-400 text-red-700 px-4 py-2 mt-1 rounded relative" role="alert">
                                <span class="block sm:inline">{{ errors.product_id[0]}}</span>
                        </div> -->
                    </label> 
                    <label class="w-full block text-sm mt-5">
                        <span class="text-gray-700 dark:text-gray-400">
                            Select Product <span class="-ml-1 text-red-500">*</span>
                        </span>
                        <select class="w-full block mt-1 text-sm dark:text-gray-300 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-red form-input rounded" required v-model="form_data.product_id">
                            <option class="py-1" value="0" >
                                --Select Product--
                            </option>
                            <option class="py-1" v-for="(item,index) in products" :key="index" :value="item.id">
                                {{item.product_name}}
                            </option>
                        </select>
                        <!-- <div v-if="errors.product_id.length > 0" class="bg-red-100 border border-red-400 text-red-700 px-4 py-2 mt-1 rounded relative" role="alert">
                                <span class="block sm:inline">{{ errors.product_id[0]}}</span>
                        </div> -->
                    </label>
                    <label class="w-full block text-sm mt-5">
                        <span class="text-gray-700 dark:text-gray-400">
                            Paying Date <span class="-ml-1 text-red-500">*</span>
                        </span>
                        <input type="datetime-local" required v-model="form_data.paying_time" class="block w-full mt-1 text-sm dark:text-gray-300 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-red form-input rounded" placeholder="Paying Date"/>
                        <!-- <div v-if="errors.close_time.length > 0" class="bg-red-100 border border-red-400 text-red-700 px-4 py-2 mt-1 rounded relative" role="alert">
                                <span class="block sm:inline">{{ errors.close_time[0]}}</span>
                        </div> -->
                    </label>
                </div>
            </div>
            
            <div class="mt-4 mb-2 flex flex-col md:flex-row items-center justify-between">
                <button type="submit" :disabled="is_loading" class="w-full sm:w-auto inline-flex items-center justify-center gap-2 flex-none bg-gray-900 hover:bg-gray-700 text-gray-100 text-sm leading-6 font-semibold py-2 px-4 border border-transparent rounded-lg focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-100 focus:ring-black focus:outline-none transition-colors duration-300">
                    <span>Add Auction</span> 
                    <span v-if="is_loading">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 animate-spin" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M4 2a1 1 0 011 1v2.101a7.002 7.002 0 0111.601 2.566 1 1 0 11-1.885.666A5.002 5.002 0 005.999 7H9a1 1 0 010 2H4a1 1 0 01-1-1V3a1 1 0 011-1zm.008 9.057a1 1 0 011.276.61A5.002 5.002 0 0014.001 13H11a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0v-2.101a7.002 7.002 0 01-11.601-2.566 1 1 0 01.61-1.276z" clip-rule="evenodd"/>
                        </svg>
                    </span> 
                </button>
                <span v-if="is_saved" class="mt-2 px-2 py-1 text-sm font-semibold leading-tight text-green-700 bg-green-100 rounded-full dark:bg-green-700 dark:text-green-100">
                    {{this.message}}
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
</div>
</template>

<script>
import ProductService from "../../../services/ProductService";
import AuctionService from "../../../services/AuctionService";
import CategoryService from "../../../services/CategoryService";
export default {
        data(){
            return {
                products:[],
                categories:[],
                statusText:'',
                errors:null,
                message:'',
                form_data:{
                 start_time:'',
                 close_time:'',
                 result_time:'',
                 paying_time:'',
                 product_id:'',
                 category_id:''
                },
                default_form_data:{
                 start_time:'',
                 close_time:'',
                 result_time:'',
                 paying_time:'',
                 product_id:'',
                 category_id:''
                },
                categoryid:'',
                is_loading:false,
                is_saved:null
            }
        },
        created(){
             this.getcategories();
             
	    },
        methods: {
            resetFormData(){
                this.$nextTick(() => {
                this.form_data = Object.assign({}, this.default_form_data)
              });
            },
            storeAuction(form_data){
                  this.is_loading=true
                AuctionService.storeAuction(form_data)
                .then(response => {
                    this.is_saved = response.data.status;
                    this.is_loading=false
                    this.message = response.data.message;
                    this.resetFormData();
                    this.statusText = '';
                    this.errors = null;
                })
                .catch(error => {
                    this.statusText = error.response.statusText;
                    this.is_loading=false
                    this.errors=error.response.data;
                    this.message = '';
                    this.is_saved = null;
				})
            },
            getproducts()
            {
                    ProductService.getcurrentproducts(this.categoryid)
                .then(response => {
                    this.products = response.data.products;
                    console.log(this.products)	
                }).catch(error => {
                    this.errors=error.response.data;
                });
            },
            getcategories()
            {
                    CategoryService.index()
                .then(response => {
                    this.categories = response.data.categories;
                    	
                }).catch(error => {
                    this.errors=error.response.data;
                });
            },
            select_value(e)
            {
                 this.categoryid = e.target.value;
                 this.getproducts();
            }

        }
    }
</script>