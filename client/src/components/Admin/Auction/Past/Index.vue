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
                                            {{ auction.start_time ? moment(auction.start_time).format('MMMM Do YYYY') : "N/A" }}
                                        </p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-4 py-3">
                                <div class="flex items-center text-sm">
                                    <div>
                                        <p class="font-semibold">
                                            {{ auction.close_time ? moment(auction.close_time).format('MMMM Do YYYY') : "N/A" }}
                                        </p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-4 py-3">
                                <div class="flex items-center text-sm">
                                    <div>
                                        <p class="font-semibold">
                                            {{ auction.result_time ? moment(auction.result_time).format('MMMM Do YYYY') : "N/A" }}
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
                                            {{ auction.paying_time ? moment(auction.paying_time).format('MMMM Do YYYY') : "N/A" }}
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
                                <span class="mt-2 px-2 py-1 text-sm font-semibold leading-tight text-blue-700 bg-blue-100 rounded-full dark:bg-blue-700 dark:text-blue-100">
                                Declined
                                </span>  
                                </button>
                            </td>
                            <td class="px-4 py-3 text-xs" v-else-if="auction.is_delivered==0">

                                <h2 class="px-4 py-3 text-xs" v-if="result">
                                <button @click="updateAuctionStatus(index)" type="submit">
                                <span class="mt-2 px-2 py-1 text-sm font-semibold leading-tight text-red-700 bg-red-100 rounded-full dark:bg-red-700 dark:text-red-100">
                                Cutfee
                                </span>  
                                </button>
                                </h2>
                                <h2 class="px-4 py-3 text-xs" v-if="!result">
                                <button @click="updateAuctionStatus(index)" type="submit">
                                <span class="mt-2 px-2 py-1 text-sm font-semibold leading-tight text-red-700 bg-red-100 rounded-full dark:bg-red-700 dark:text-red-100">
                                Pending
                                </span>  
                                </button>
                                </h2>
                            </td>
                            
                            
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref } from "vue";
import moment from 'moment';
import AuctionService from "../../../../services/AuctionService";
import ProductService from "../../../../services/ProductService";
import CategoryService from "../../../../services/CategoryService";
const auctionresponse = ref(await AuctionService.getPastAuction());
const auctions = auctionresponse.value.data.data;
const result = auctionresponse.value.data.result;
const productresponse=ref(await ProductService.getProduct());
const products = productresponse.value.data.data;
const categoryresponse=ref(await CategoryService.getCategory());
const categories = categoryresponse.value.data.data;
const is_loading = ref(false);
const isUpdated = ref(false);
const errors = ref(null);
const form_data = ref({});
async function updateAuctionStatus(index) {
    form_data.value = auctions[index];
    AuctionService.updateAuctionStatus(form_data.value.id)
    .then((updateauctionResponse) => {
        errors.value = null;
        isUpdated.value = updateauctionResponse.status;
        console.log(isUpdated.value.status)
        window.location.reload();
    })
    .catch((updateAuctionError) => {
        errors.value = updateAuctionError.response.data;
        isUpdated.value = false;
    });
}
</script>