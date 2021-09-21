<template>
    <div>
        <div v-if="isUpdated" class="-mt-12 mb-6 flex justify-end">
            <span class="text-sm px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-full dark:bg-green-700 dark:text-green-100">
                Update Successfull
            </span>
        </div>
        <div class="w-full mb-4 overflow-hidden rounded-lg shadow-sm border">
            <div class="w-full overflow-x-auto">
                <table class="w-full whitespace-no-wrap">
                    <thead>
                        <tr  class=" text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                            <th class="px-4 py-3">#</th>
                            <th class="px-4 py-3">Product Name</th>
                            <th class="px-4 py-3">Start Date</th>
                            <th class="px-4 py-3">Close Date</th>
                            <th class="px-4 py-3">Result Date</th> 
                            <th class="px-4 py-3">Base Price</th> 
                            <th class="px-4 py-3">paying time</th>
                            <th class="px-4 py-3">action</th>
                        </tr>
                        
                    </thead>
                    
                    <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                        <tr v-for="(auction, index) in auctions" :key="auction.id" class="text-gray-700 dark:text-gray-400">
                            <td class="px-4 py-3 text-sm">
                                {{ index + 1 }}
                            </td>
                           
                            <td class="px-4 py-3">
                                <div class="flex items-center text-sm">
                                    <div>
                                        <p class="font-semibold">
                                            
                                            {{ auction.product_name ? auction.product_name : "N/A" }}
                                        </p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-4 py-3">
                                <div class="flex items-center text-sm">
                                    <div>
                                        <p class="font-semibold">
                                            {{ auction.start_time ? auction.start_time : "N/A" }}
                                        </p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-4 py-3">
                                <div class="flex items-center text-sm">
                                    <div>
                                        <p class="font-semibold">
                                            {{ auction.close_time ? auction.close_time : "N/A" }}
                                        </p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-4 py-3">
                                <div class="flex items-center text-sm">
                                    <div>
                                        <p class="font-semibold">
                                            {{ auction.result_time ? auction.result_time : "N/A" }}
                                        </p>
                                    </div>
                                </div>
                            </td>
                            
                            <td class="px-4 py-3">
                                <div class="flex items-center text-sm">
                                    <div>
                                        <p class="font-semibold">
                                            {{ auction.base_price ? auction.base_price : "N/A" }}
                                        </p>
                                    </div>
                                </div>
                            </td>
                            
                            <td class="px-4 py-3">
                                <div class="flex items-center text-sm">
                                    <div>
                                        <p class="font-semibold">
                                            {{ auction.paying_time ? auction.paying_time : "N/A" }}
                                        </p>
                                    </div>
                                </div>
                            </td>
                            
                            <td class="px-4 py-3 text-xs">
                                <div class="flex items-center space-x-4 text-sm">
                                    <button @click="openModel(index)" class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-black rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray" aria-label="Edit">
                                        <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"></path>
                                        </svg>
                                    </button>
                                    <button @click="deleteAuction(auction.id, index)">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                            
                        </tr>
                    </tbody>
                </table>
            <Pagination
                v-if="renderComponent"
                @set-active-page="setActivePage"
                :total="pagination.total"
                :pageCount="pagination.dataCount"
                :activePage="pagination.activePage"
            />
            </div>
            <div v-if="is_modal_open" class="fixed inset-0 z-30 flex items-end bg-black bg-opacity-50 sm:items-center sm:justify-center">
                <div v-if="is_modal_open" class="w-full px-6 py-4 overflow-hidden bg-white rounded-t-lg dark:bg-gray-800 sm:rounded-lg sm:m-4 sm:max-w-xl" role="dialog" id="modal">
                    <header class="flex justify-end">
                        <button @click="closeModal" class="inline-flex items-center justify-center w-6 h-6 text-gray-400 transition-colors duration-150 rounded dark:hover:text-gray-200 hover: hover:text-gray-700" aria-label="close">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20" role="img" aria-hidden="true">
                                <path d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" fill-rule="evenodd"></path>
                            </svg>
                        </button>
                    </header>

                    <p class="mb-4 text-lg font-semibold text-gray-700 dark:text-gray-300"> Edit Auction </p>
                <div v-if="statusText.length > 0" class="mt-5 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                    <span class="block sm:inline">{{ statusText }}</span>
                </div>
                <form @submit.prevent="updateAuction(form_data)">     
                        <div class="mb-16">
                            <div class="max-h-96 overflow-y-auto flex flex-col gap-4">
                                <div class="w-full flex items-center gap-4">   
                                    <label class="w-full block text-sm">
                                        <span class="text-gray-700 dark:text-gray-400">
                                            Start Time
                                        </span>
                                        <input type="datetime-local" v-model="form_data.start_time" class="block w-full mt-1 text-sm dark:text-gray-300 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-red form-input rounded" placeholder="Product Price"/>
                                    </label>
                                    <label class="w-full block text-sm">
                                        <span class="text-gray-700 dark:text-gray-400">
                                            Close Time
                                        </span>
                                        <input type="datetime-local" v-model="form_data.close_time" class="block w-full mt-1 text-sm dark:text-gray-300 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-red form-input rounded" placeholder="Product Price"/>
                                    </label>
                                </div>
                                <div class="w-full flex items-center gap-4">   
                                    <label class="w-full block text-sm">
                                        <span class="text-gray-700 dark:text-gray-400">
                                            Result Time
                                        </span>
                                        <input type="datetime-local" v-model="form_data.result_time" class="block w-full mt-1 text-sm dark:text-gray-300 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-red form-input rounded" placeholder="Product Price"/>
                                    </label>
                                    <label class="w-full block text-sm">
                                        <span class="text-gray-700 dark:text-gray-400">
                                            Paying Time
                                        </span>
                                        <input type="datetime-local" v-model="form_data.paying_time" class="block w-full mt-1 text-sm dark:text-gray-300 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-red form-input rounded" />
                                    </label>
                                </div>
                                <div class="w-full flex items-center gap-4">
                                    <label class="w-full block text-sm">
                                        <span class="text-gray-700 dark:text-gray-400">
                                            Select Category <span class="-ml-1 text-red-500">*</span>
                                        </span>
                                        <input type="hidden" v-model="form_data.category_id">
                                        <select disabled class="w-full block mt-1 text-sm dark:text-gray-300 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-red form-input rounded" required v-model="form_data.category_id">
                                            <option class="py-1" value="">
                                                --Select Category--
                                            </option>
                                            <option class="py-1" v-for="(item,index) in categories" :key="index" :value="item.id">
                                                {{item.name}}
                                            </option>
                                        </select>
                                    </label>
                                    <label class="w-full block text-sm">
                                        <span class="text-gray-700 dark:text-gray-400">
                                            Select Product <span class="-ml-1 text-red-500">*</span>
                                        </span>
                                        <input type="hidden" v-model="form_data.product_id"/>
                                        <select disabled class="w-full block mt-1 text-sm dark:text-gray-300 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-red form-input rounded" required v-model="form_data.product_id">
                                            <option class="py-1" value="">
                                                --Select product--
                                            </option>
                                            <option class="py-1" v-for="(item,index) in products" :key="index" :value="item.id">
                                                {{item.product_name}}
                                            </option>
                                        </select>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="flex flex-col items-center justify-end px-6 py-3 -mx-6 -mb-4 space-y-4 sm:space-y-0 sm:space-x-6 sm:flex-row bg-gray-50 dark:bg-gray-800">
                            <button type="submit" :disabled="is_loading" class="w-full sm:w-auto inline-flex items-center justify-center gap-2 flex-none bg-gray-900 hover:bg-gray-700 text-gray-100 text-sm leading-6 font-semibold py-2 px-4 border border-transparent rounded-lg focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-100 focus:ring-black focus:outline-none transition-colors duration-300">
                                <span>Update Auction</span> 
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
import moment from 'moment';
import ProductService from "../../../../services/ProductService";
import AuctionService from "../../../../services/AuctionService";
import CategoryService from "../../../../services/CategoryService";
import Pagination from '../../../Pagination.vue';

export default {
        components:{
            Pagination
        },
        data(){
            return {
                statusText: '',
                products:[],
                categories:[],
                auctions:[],
                auctions_data:[],
                form_data:{},
                errors:null,
                message:'',
                categoryid:'',
                is_loading:false,
                is_saved:null,
                is_modal_open:false,
                isUpdated:false,
                pagination: {
                    dataCount: 5,
                    activePage:1,
                    total:0
                },
                renderComponent:true,
                moment: moment
            }
        },
        created(){
            this.getcategories();
            this.getauctions();
            // this.select_value();
	    },
        methods: {
            deleteAuction(id, index){
                var is_del = confirm("Are you sure to delete ?!");
                if(is_del){
                    this.is_loading=true;
                    AuctionService.deleteAuction(id)
                    .then(()=>{
                        this.auctions.splice(index, 1);
                        this.is_loading=false;
                    })
                    .catch(error => {
                        this.is_loading=false
                        let data = error.response.data
                        console.log(data)
                        for (let key in data.errors) {
                            this.errors[key] = []
                            let errorMessage = data.errors[key]
                            if (errorMessage){
                                this.errors[key] = errorMessage
                            }
                        }	
                        
                    });
                }
                
            },
            updateAuction(form_data)
            {
                this.is_loading=true
                AuctionService.updateAuction(this.form_data.id,form_data)
                .then(response => {
                    console.log(response);
                    this.is_loading=false;
                    this.closeModal();
                    this.statusText = '';
                })
                .catch(error => {
                    this.statusText = error.response.statusText;
                    this.is_loading=false
                    let data = error.response.data
                    console.log(data)
                    for (let key in data.errors) {
						this.errors[key] = []
						let errorMessage = data.errors[key]
						if (errorMessage){
							this.errors[key] = errorMessage
						}
					}	
					
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
            paginateItems(){
            const start = (this.pagination.activePage-1)*this.pagination.dataCount;
            this.auctions = this.auctions_data.slice(start, start+this.pagination.dataCount);
            },
            setActivePage(payload){
                // console.log('Setting Active Page:', payload);
                this.pagination.activePage = payload.page;
                this.paginateItems();
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
            getauctions()
            {
                    AuctionService.getUpcomingAuction()
                .then(response => {
                    this.auctions_data = response.data.data;
                    this.pagination.total = this.auctions_data.length;
                    this.paginateItems();
                    this.forceRerender();
                   // console.log(this.products)	
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
                 this.categoryid=e.target.value;
                 this.getproducts();    
            },
            openModel(index){
            this.form_data = {...this.auctions[index]};
            // this.getproducts();
             console.log(this.form_data.paying_time);
            this.is_modal_open = true;
            this.errors = null;
            this.categoryid = this.form_data.category_id;
            this.getproducts();    
        },
        closeModal() {
            this.form_data = {};
            this.is_modal_open = false;
            this.errors = null;
            this.getcategories();
              this.getauctions();
        }

        }
    }

</script>