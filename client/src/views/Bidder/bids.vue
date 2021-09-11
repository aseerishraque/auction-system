<template>
<div>
<h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200"> History </h2>
    <div class="overflow-x-auto place-items-center">
        <table class="table w-full table-zebra">
            <thead>
            <tr>
                <th>SL</th> 
                <th>Product</th> 
                <th>Bidding Price</th> 
                <th>Bidding Date</th>
            </tr>
            </thead> 
            <tbody>
            <tr v-for="(bid, idx) in bids" :key="idx">
                <th>{{ idx+1 }}</th> 
                <td>{{ bid.product_name }}</td> 
                <td>{{ bid.bidding_price }}</td> 
                <td>{{ bid.bidding_date }}</td>
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
</template>
<script>
import BidderService from '../../services/BidderService';
import { useRouter } from "vue-router";
import Pagination from '../../components/Pagination.vue';

export default {
    components:{
      Pagination
    },
    data() {
        return {
            errors: null,
            bids_data:[],
            bids:[],
            userId: Store.state.currentUser.id,
            pagination: {
                dataCount: 5,
                activePage:1,
                total:0
            },
            renderComponent:true
        }
    },
    created() {
        const user = Store.state.currentUser;
        const router = useRouter();
        if(user){
            this.userId = user.id;
        }else{
            router.push("/login");
        }
        this.initialize();
    },
    methods: {
        initialize(){
            BidderService.getUserBids(this.userId)
            .then(res=>{
                this.bids_data = res.data.bids;
                this.pagination.total = this.bids_data.length;
                this.paginateItems();
                this.forceRerender();
            })
            .catch(error => {
					let data = error.response.data
                    for (let key in data.errors) {
						this.errors[key] = []
						let errorMessage = data.errors[key]
						if (errorMessage){
							this.errors[key] = errorMessage
						}
					}
					
				});
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
          this.bids = this.bids_data.slice(start, start+this.pagination.dataCount);
        },
        setActivePage(payload){
          // console.log('Setting Active Page:', payload);
          this.pagination.activePage = payload.page;
          this.paginateItems();
        }
    },
}
</script>