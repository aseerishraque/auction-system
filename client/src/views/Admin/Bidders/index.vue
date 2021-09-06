<template>
<div class="bidders-crud">
    <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200"> Bidders </h2>

    <!-- <div class="mb-4">
        <link-button to="admin.category.create" name="Add Category">
            <span>Add Bidder</span>
        </link-button>
    </div> -->

    <div v-if="error" class="px-3 mb-4 py-2 w-full border border-red-500 rounded text-sm text-red-500 transition delay-1000 duration-500">
        <ul class="mt-1 ml-2 list-disc list-inside">
            <li>
                <span class="-ml-2">{{ error }}</span>
            </li>
        </ul>
    </div>

<div class="overflow-x-auto">
  <table class="table w-full">
    <thead>
      <tr>
        <th>SL</th>
        <th>Name</th> 
        <th>Vat</th> 
        <th>Account</th> 
        <th>Details</th>
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
            <div class="avatar">
              <div class="w-12 h-12 mask mask-squircle">
                <img src="https://cdn5.vectorstock.com/i/1000x1000/27/64/avatar-man-cartoon-vector-10622764.jpg" alt="Avatar Tailwind CSS Component">
              </div>
            </div> 
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
          <div class="flex items-center space-x-3">
            <div class="avatar">
              <div class="w-12 h-12 mask mask-squircle">
                <img src="https://cdn5.vectorstock.com/i/1000x1000/27/64/avatar-man-cartoon-vector-10622764.jpg" alt="Avatar Tailwind CSS Component">
              </div>
            </div> 
            <div>
                 <div class="font-bold">
                    {{ bidder.vat_no }}
                </div>
            </div>
          </div>
        </td>
        <td>
           Deposit: {{ bidder.deposit }}
            
          <br> 
          <span class="badge badge-outline badge-sm">{{ bidder.account_type }}</span>
        </td> 
        <th>
          <button class="btn btn-primary btn-xs">View</button>
        </th>
        <td>
          <label>
            <input type="checkbox" class="checkbox" :checked="bidder.is_approved===1 ? true : false">
          </label>
        </td>
        <td class="px-4 py-3 text-xs">
            <div class="flex items-center space-x-4 text-sm">
                <button class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-black rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray" aria-label="Edit">
                    <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"></path>
                    </svg>
                </button>
            </div>
        </td>
      </tr>
    </tbody> 
    <tfoot>
      <tr>
        <th>SL</th>
        <th>Name</th> 
        <th>Vat</th> 
        <th>Account</th> 
        <th>Details</th>
        <th>
            Approved
        </th> 
        <th>Action</th>
      </tr>
    </tfoot>
  </table>
</div>

</div>
</template>
<script>
import BidderService from '../../../services/BidderService';
export default{
    name: 'BiddersIndex',
    data() {
        return {
            error: null,
            bidders:[]
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
        }
    },
}
</script>
