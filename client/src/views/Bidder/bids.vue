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
        <div class="btn-group float-right">
            <button class="btn">Previous</button> 
            <button class="btn">1</button> 
            <button class="btn btn-active">2</button> 
            <button class="btn">3</button> 
            <button class="btn">4</button> 
            <button class="btn">Next</button>
        </div>
    </div>
        
</div>
</template>
<script>
import BidderService from '../../services/BidderService';
import { useRouter } from "vue-router";

export default {
    data() {
        return {
            errors: null,
            bids:[],
            userId: Store.state.currentUser.id
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
                this.bids = res.data.bids;
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
        }
    },
}
</script>