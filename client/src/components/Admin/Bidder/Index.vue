<template>
    
<div class="overflow-x-auto">
  <table class="table w-full">
    <thead>
      <tr>
        <th>SL</th>
        <th>Name</th> 
        <th>Account</th>  
        <th>Balance</th> 
        <th>
            Approved
        </th>
        <th>Action</th>
      </tr>
    </thead> 
    <tbody>
      <tr v-for="(bidder, idx) in bidders" :key="idx">
        <td>{{ idx+1 }}</td>
        <td>
          <div class="flex items-center space-x-3">
            <div>
                 <div class="font-bold">
                    {{ bidder.name }}
                </div> 
                <div class="text-sm opacity-50">
                   {{ bidder.email }}
                </div>
                <div class="text-sm opacity-50">
                   {{ bidder.mobile_no }}
                </div>
                <div class="text-sm opacity-60">
                   NID: {{ bidder.nid_no }}
                </div>
            </div>
          </div>
        </td> 
        <td>
          {{ bidder.account_type }}
        </td>
        <td>
           {{ bidder.deposit }} 
          <br> 

        </td>
        <td>
          <label>
            <input @click="approveBidder(bidder.id, (bidder.is_approved===1 ? 0 : 1))" type="checkbox" class="checkbox" :checked="bidder.is_approved===1 ? true : false">
          </label>
        </td>
        <td class="px-4 py-3 text-xs">
            <div class="flex items-center space-x-4 text-sm">
                <router-link :to="{name:'admin.bidders.update', params: { id: bidder.id }}">
                  <button class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-black rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray" aria-label="Edit">
                      <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                      <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"></path>
                      </svg>
                  </button>
                </router-link>
                
            </div>
        </td>
      </tr>
    </tbody> 
    <tfoot>
      <tr>
        <th>SL</th>
        <th>Name</th> 
        <th>Account</th> 
        <th>Deposit</th>
        <th>
            Approved
        </th> 
        <th>Action</th>
      </tr>
    </tfoot>
  </table>
</div>
</template>

<script>
import BidderService from '../../../services/BidderService';
export default{
    name: 'BidderIndex',
    data() {
        return {
            error: null,
            bidders:[],
        }
    },
    created() {
        this.initialize();
    },
    methods: {
        initialize(){
         BidderService.index()
         .then(res=>{
           this.bidders = res.data.bidders;
         })
         .catch(error=>{
           console.log(error);
         });
        },
        approveBidder(id, is_approved){
          BidderService.approveBidder(id, is_approved)
          .then(()=>{
            // console.log(res);
          })
          .catch(error=>{
            console.log(error);
          });
        }
    },
}
</script>
