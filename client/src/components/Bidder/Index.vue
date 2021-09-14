<template>
<div class="admin-dashboard">
<div class="main-content flex-1 bg-gray-100 mt-12 md:mt-2 pb-24 md:pb-5">

            <div class="mb-3">
                <div class="rounded-tl-4xl bg-gradient-to-r from-white-300 to-white-600 p-4 text-2xl text-black">
                    <!-- <h3 class="font-bold pl-2">Analytics</h3> -->
                </div>
            </div>

            <div class="flex flex-wrap">
               
              


                <div class="w-full md:w-1/2 xl:w-1/3 p-6">
                   
                    <div class="bg-gradient-to-b from-white-200 to-white-100 border-b-4 border-white-500 rounded-lg shadow-xl p-5">
                        <div class="flex flex-row items-center">
                            
                            <div class="flex-1 text-right md:text-center">
                                <h5 class="font-bold uppercase text-gray-600">Total Bids</h5>
                                <h3 class="font-bold text-3xl">{{ items.bids > 0 ? items.bids : "0" }}</h3>
                            </div>
                        </div>
                    </div>
                   
                </div>
                <div class="w-full md:w-1/2 xl:w-1/3 p-6">
                    
                    <div class="bg-gradient-to-b from-white-200 to-white-100 border-b-4 border-white-500 rounded-lg shadow-xl p-5">
                        <div class="flex flex-row items-center">
                            
                            <div class="flex-1 text-right md:text-center">
                                <h5 class="font-bold uppercase text-gray-600">Products</h5>
                                <h3 class="font-bold text-3xl">{{ items.products ? items.products : "0" }}</h3>
                            </div>
                        </div> 
                    </div>
                   
                </div>
                <div class="w-full md:w-1/2 xl:w-1/3 p-6">
                    
                    <div class="bg-gradient-to-b from-white-200 to-white-100 border-b-4 border-white-500 rounded-lg shadow-xl p-5">
                        <div class="flex flex-row items-center">
                            
                            <div class="flex-1 text-right md:text-center">
                                <h5 class="font-bold uppercase text-gray-600">Payable</h5>
                                <h3 class="font-bold text-3xl">{{ items.payables ? items.payables : "0" }}<span class="text-red-500"><i class="fas fa-caret-up"></i></span></h3>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
        <div class="bg-white-600">
                <div class="rounded-tl-5xl bg-gradient-to-r from-white-400 to-white-900 p-4 shadow text-2xl text-black">
                    <h3 class="font-bold pl-2 text-center">Auction Results</h3>
                </div>
            </div>
  <div>
        <div class="overflow-x-auto place-items-center">
        <table class="table w-full table-zebra">
            <thead>
            <tr>
                <th>SL</th> 
                <th>Product</th> 
                <th>Result Time</th> 
                <th>Winner Bid</th>
                <th class="text-center">Actions</th>
            </tr>
            </thead> 
            <tbody>
            <tr v-for="(product, idx) in products" :key="idx">
                <th>{{ idx+1 }}</th> 
                <td>{{ product.product_name }}</td> 
                <td>{{ product.result_time }}</td> 
                <td>{{ product.winner_bid }}</td> 
                <td class="text-center">
                    <button class="btn btn-primary btn-xs mr-5">Pay Now</button>
                    <button @click="declineProduct(product.id, idx)" class="btn btn-error btn-xs">Decline</button>
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
import BidderService from '../../services/BidderService';

const userId = Store.state.currentUser.id;
const homeItemsResponse = ref(await BidderService.getHomeItems(userId));
const items = homeItemsResponse.value.data;
const productsResponse = ref(await BidderService.getUserProducts(userId));
const products = productsResponse.value.data.products;

function declineProduct(auction_id, index){
    BidderService.declineProduct({
        user_id: userId,
        auction_id: auction_id
    })
    .then(res=>{
        products.splice(index, 1);
    })
    .catch(error=>{
        console.log(error);
    });
}

</script>