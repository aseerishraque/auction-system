<template>
<div class="admin-dashboard">
<div class="main-content flex-1 bg-gray-100 mt-12 md:mt-2 pb-24 md:pb-5">

            <div class="mb-3">
                <div class="rounded-tl-4xl bg-gradient-to-r from-white-300 to-white-600 p-4 text-2xl text-black">
                    <h3 class="font-bold pl-2">Analytics</h3>
                </div>
            </div>

            <div class="flex flex-wrap">
               
                <div class="w-full filter drop-shadow-lg stats">
                <div class="stat place-items-center place-content-center">
                    <div class="stat-title">Total Users</div> 
                    <div class="stat-value">{{ users ? users : "0" }}</div> 
                    <div class="stat-desc">Jan 1st - Feb 1st</div>
                </div> 
                <div class="stat place-items-center place-content-center">
                    <div class="stat-title">Total Categories</div> 
                    <div class="stat-value text-success">{{ categories ? categories : "0" }}</div> 
                    <div class="stat-desc text-success">↗︎ 400 (22%)</div>
                </div> 
                <div class="stat place-items-center place-content-center">
                    <div class="stat-title">Total Products</div> 
                    <div class="stat-value text-error">{{ products ? products : "0" }}</div> 
                    <div class="stat-desc text-error">↘︎ 90 (14%)</div>
                </div>
                </div>


                <div class="w-full md:w-1/2 xl:w-1/3 p-6">
                   
                    <div class="bg-gradient-to-b from-white-200 to-white-100 border-b-4 border-white-500 rounded-lg shadow-xl p-5">
                        <div class="flex flex-row items-center">
                            
                            <div class="flex-1 text-right md:text-center">
                                <h5 class="font-bold uppercase text-gray-600">Past Auction</h5>
                                <h3 class="font-bold text-3xl">{{ past_auctions ? past_auctions : "0" }}</h3>
                            </div>
                        </div>
                    </div>
                   
                </div>
                <div class="w-full md:w-1/2 xl:w-1/3 p-6">
                    
                    <div class="bg-gradient-to-b from-white-200 to-white-100 border-b-4 border-white-500 rounded-lg shadow-xl p-5">
                        <div class="flex flex-row items-center">
                            
                            <div class="flex-1 text-right md:text-center">
                                <h5 class="font-bold uppercase text-gray-600">Running Auction</h5>
                                <h3 class="font-bold text-3xl">{{ running_auctions ? running_auctions : "0" }}</h3>
                            </div>
                        </div> 
                    </div>
                   
                </div>
                <div class="w-full md:w-1/2 xl:w-1/3 p-6">
                    
                    <div class="bg-gradient-to-b from-white-200 to-white-100 border-b-4 border-white-500 rounded-lg shadow-xl p-5">
                        <div class="flex flex-row items-center">
                            
                            <div class="flex-1 text-right md:text-center">
                                <h5 class="font-bold uppercase text-gray-600">Upcoming Auction</h5>
                                <h3 class="font-bold text-3xl">{{ upcoming_auctions ? upcoming_auctions : "0" }}<span class="text-red-500"><i class="fas fa-caret-up"></i></span></h3>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
        <div class="bg-white-600">
                <div class="rounded-tl-5xl bg-gradient-to-r from-white-400 to-white-900 p-4 shadow text-2xl text-black">
                    <h3 class="font-bold pl-2 text-center">All Auctions</h3>
                </div>
            </div>
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
                           <td class="px-4 py-3 text-xs">
                                <button type="submit">
                                <span class="mt-2 px-2 py-1 text-sm font-semibold leading-tight 
                                text-green-700 bg-green-100 rounded-full dark:bg-green-700 dark:text-green-100">
                                <router-link :to="{ path:'auction/details/'+ auction.id}">Details</router-link>
                               
                                </span>  
                                </button>
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
import { ref } from "vue";
import moment from 'moment';
import AllService from "../../../../services/AllService";
import AuctionService from "../../../../services/AuctionService";
const auctionresponse = ref(await AllService.getallAuction());
const auctions = auctionresponse.value.data.data;
const allcount = ref(await AllService.getallCount());
const users = allcount.value.data.users;
const categories = allcount.value.data.categories;
const products = allcount.value.data.products;
const past_auctions = allcount.value.data.past_auctions;
const running_auctions = allcount.value.data.running_auctions;
const upcoming_auctions = allcount.value.data.upcoming_auctions;
</script>