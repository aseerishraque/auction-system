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
                        <tr class=" text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                            <th class="px-4 py-3">#</th>
                            <th class="px-4 py-3">Product Name</th>
                            <th class="px-4 py-3">Start Date</th>
                            <th class="px-4 py-3">Close Date</th>
                            <th class="px-4 py-3">Result Date</th>
                            <th class="px-4 py-3">Paying Time</th>
                            <th class="px-4 py-3">Base Price</th>
                          
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
                                            {{ auction.paying_time ? auction.paying_time : "N/A" }}
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
    async setup() {
        const auctionresponse = ref(await AuctionService.getRunningAuction());
        // const auctions = auctionresponse.value.data.data;
        const is_loading = ref(false);
        const isUpdated = ref(false);
        const errors = ref(null);
        return {
            auctionresponse,
            is_loading,
            isUpdated,
            errors
        }
    },
    created() {
        this.initialize();
    },
    methods: {
        initialize(){
            // console.log(this.auctionresponse.data.data);
            this.auctions_data = this.auctionresponse.data.data;
            this.pagination.total = this.auctions_data.length;
            console.log(this.auctionresponse.data.now);
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