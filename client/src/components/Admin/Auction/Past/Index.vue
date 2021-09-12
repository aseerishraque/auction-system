<template>
    <div>
        <div class="w-full mb-4 overflow-hidden rounded-lg shadow-sm border">
            <div class="w-full overflow-x-auto">
                <table class="w-full whitespace-no-wrap">
                    <thead>
                        <tr class=" text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                            <th class="px-4 py-3">#</th>
                            <th class="px-4 py-3">Product Name</th>
                            <th class="px-4 py-3">Start Date</th>
                            <th class="px-4 py-3">Close Date</th>
                            <th class="px-4 py-3">Result Date</th>
                            <th class="px-4 py-3">Winner Name</th>
                            <th class="px-4 py-3">Base Price</th>
                            <th class="px-4 py-3">Winner Bid</th>
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
                                            {{ auction.name ? auction.name : "N/A" }} 
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
                                            {{ auction.winner_bid ? auction.winner_bid : "N/A" }}
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
                            <td class="px-4 py-3 text-xs" v-if="auction.is_delivered==1">
                                <button @click="Details(index)" type="submit">
                                <span class="mt-2 px-2 py-1 text-sm font-semibold leading-tight text-green-700 bg-green-100 rounded-full dark:bg-green-700 dark:text-green-100">
                                Delivered
                                </span>  
                                </button>
                            </td>
                            <td class="px-4 py-3 text-xs" v-else-if="auction.is_delivered==2">
                                <button @click="Details(index)" type="submit">
                                <!-- <span class="mt-2 px-2 py-1 text-sm font-semibold leading-tight text-blue-700 bg-blue-100 rounded-full dark:bg-blue-700 dark:text-blue-100"> -->
                                <span class="btn btn-xs">
                                Declined
                                </span>  
                                </button>
                            </td>
                            <td class="px-4 py-3 text-xs" v-else-if="auction.is_delivered==0">

                                <h2 class="px-4 py-3 text-xs" v-if="result">
                                <button @click="updateAuctionStatus(index)" type="submit">
                                <!-- <span class="mt-2 px-2 py-1 text-sm font-semibold leading-tight text-red-700 bg-red-100 rounded-full dark:bg-red-700 dark:text-red-100"> -->
                                <span class="btn btn-error btn-xs">
                                Cutfee
                                </span>  
                                </button>
                                </h2>
                                <h2 class="px-4 py-3 text-xs" v-if="!result">
                                <button @click="updateAuctionStatus(index)" type="submit">
                                <!-- <span class="mt-2 px-2 py-1 text-sm font-semibold leading-tight text-red-700 bg-red-100 rounded-full dark:bg-red-700 dark:text-red-100"> -->
                                <span class="btn btn-xs btn-accent">
                                Pending
                                </span>  
                                </button>
                                </h2>
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
        </div>
    </div>
</template>

<script>
import { ref } from "vue";
import AuctionService from "../../../../services/AuctionService";
import ProductService from "../../../../services/ProductService";
import CategoryService from "../../../../services/CategoryService";
import Pagination from '../../../Pagination.vue';
export default {
    components:{
        Pagination
    },
    async setup(){
        
        const auctionresponse = ref(await AuctionService.getPastAuction());
        // const auctions = auctionresponse.value.data.data;
        const result = auctionresponse.value.data.result;
        const productresponse=ref(await ProductService.getProduct());
        const products = productresponse.value.data.data;
        const categoryresponse=ref(await CategoryService.index());
        const categories = categoryresponse.value.data.data;
        const is_loading = ref(false);
        const isUpdated = ref(false);
        const errors = ref(null);
        const form_data = ref({});
        return {
            auctionresponse,
            result,
            productresponse,
            products,
            categoryresponse,
            categories,
            is_loading,
            isUpdated,
            errors,
            form_data
        }
    },
    data() {
        return {
            auctions_data:[],
            auctions:[],
            pagination: {
                dataCount: 5,
                activePage:1,
                total:0
            },
            renderComponent:true
        }
    },
    created() {
        this.initialize();
    },
    methods: {
        updateAuctionStatus(index) {
            this.form_data = this.auctions[index];
            AuctionService.updateAuctionStatus(this.form_data.id)
            .then((updateauctionResponse) => {
                this.errors = null;
                this.isUpdated = updateauctionResponse.status;
                console.log(this.isUpdated.status)
                window.location.reload();
            })
            .catch((updateAuctionError) => {
                this.errors = updateAuctionError.response.data;
                this.isUpdated = false;
            });
        },
        initialize(){
            // console.log(this.auctionresponse.data.data);
            this.auctions_data = this.auctionresponse.data.data;
            this.pagination.total = this.auctions_data.length;
            this.paginateItems();
            // console.log(this.categories[0]);
        },
        paginateItems(){
            const start = (this.pagination.activePage-1)*this.pagination.dataCount;
            this.auctions = this.auctions_data.slice(start, start+this.pagination.dataCount);
        },
        setActivePage(payload){
            // console.log('Setting Active Page:', payload);
            this.pagination.activePage = payload.page;
            this.paginateItems();
        }
    },
}
</script>