<template>
<div>
    <NavBar/>
    <div class="grid grid-cols-2 gap-4">
        <div class="grid grid-cols-2 gap-4">
            <div class="card text-center shadow-xl h-72 text-center">
                <figure class="pt-10 object-contain h-48 w-full">
                    <img :src="auction.front_image" class="rounded-xl object-contain h-32 w-full">
                </figure> 
                <div class="card-body">
                    <h2 class="card-title">Front</h2>
                </div>
            </div>
            <div class="card text-center shadow-xl h-72 text-center">
                <figure class="pt-10 object-contain h-48 w-full">
                    <img :src="auction.back_image" class="rounded-xl object-contain h-32 w-full">
                </figure> 
                <div class="card-body">
                    <h2 class="card-title">Back</h2>
                </div>
            </div>
            <div class="card text-center shadow-xl h-72 text-center">
                <figure class="pt-10 object-contain h-48 w-full">
                    <img :src="auction.left_image" class="rounded-xl object-contain h-32 w-full">
                </figure> 
                <div class="card-body">
                    <h2 class="card-title">Left</h2>
                </div>
            </div>
            <div class="card text-center shadow-xl h-72 text-center">
                <figure class="pt-10 object-contain h-48 w-full">
                    <img :src="auction.right_image" class="rounded-xl object-contain h-32 w-full">
                </figure> 
                <div class="card-body">
                    <h2 class="card-title">Right</h2>
                </div>
            </div>
        </div>
        <div class="card lg:card-side bordered">
            <div class="card-body">
                <h2 class="card-title">Product: {{ auction.product_name }}</h2> 
                <h2 class="text-lg font-bold">Description:</h2>
                <p> {{ auction.description }} </p>
                <h2 class="text-lg font-bold">Specification:</h2>
                <p> {{ auction.specification }} </p>
                <h2 class="text-lg font-bold">Required Balance: {{ auction.expected_value*(auction.percentage/100) }}</h2>
               
                
                <CountDown v-if="renderComponent" :dateTime="this.$route.params.type === '2' ? auction.start_time: auction.close_time" />
                <h2 class="text-lg font-bold">Base Price: {{ auction.base_price }}</h2> 
                <h2 v-if="can_bid" class="text-lg font-bold">Highest Bidder: {{ auction.user_name }}</h2> 
                <h2 v-if="can_bid" class="text-lg font-bold">Highest Bid: {{ auction.winner_bid }}</h2> 
                <!-- <div class="form-control">
                 <input type="text" placeholder="Bid" class="input input-bordered">
                </div>  -->
                <div class="card-actions mt-10" v-if="can_bid">
                    <input v-model="bid.bidding_price" :disabled="!is_logged_in" type="number" placeholder="00.0" class="input input-bordered">
                    <button  @click="bidProduct" :disabled="!is_logged_in" :class="btn_loading ? 'ml-10 btn btn-primary loading': 'ml-10 btn btn-primary'">Bid</button> 
                <!-- <button class="btn btn-ghost">More info</button> -->
                </div>
                <div v-if="errorAlert" class="alert alert-warning mt-10">
                    <div class="flex-1">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="w-6 h-6 mx-2 stroke-current"> 
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>                         
                        </svg> 
                        <label> {{ msg }} </label>
                    </div>
                </div>
                <div v-if="successAlert" class="alert alert-success mt-10">
                <div class="flex-1">
                    <i class="fas fa-check w-6 h-6 mx-2 stroke-current"></i>
                    <label> {{ msg }} </label>
                </div>
                </div>
            </div>
        </div>
    </div>
</div>
</template>

<script>
import NavBar from '../../components/Visitor/Navbar.vue';
import AuctionService from '../../services/AuctionService';
import BidderService from '../../services/BidderService';
import CountDown from '../../components/Visitor/CountDown.vue';
import env from '../../config/env';
let datetime = new Date();
datetime.setSeconds(datetime.getSeconds() + 0);
datetime = datetime.toISOString();

export default {
    components:{
        NavBar,
        CountDown
    },
    data() {
        return {
            auctions:[],
            auction:{
                front_image: '/images/pre-upload.png',
                back_image: '/images/pre-upload.png',
                left_image: '/images/pre-upload.png',
                right_image: '/images/pre-upload.png',
                close_time: datetime
            },
            auctionid: this.$route.params.id,
            renderComponent:true,
            is_logged_in: false,
            btn_loading:false,
            successAlert:false,
            errorAlert:false,
            can_bid: true,
            msg:'',
            bid:{
                user_id:null,
                bidding_price:0,
                auction_id: null,
                bidding_date:'',
                percentage:null,
                expected_value:null,
                base_price: null
            }
        }
    },
    created() {
        if(Store.state.currentUser !== null){
            this.is_logged_in = true;
            if(Store.state.currentUser.role !== 'bidder'){
                this.is_logged_in = false;
                this.errorAlert = true;
                this.msg = "Admin cannot Bid!";
            }
        }else{
            this.errorAlert = true;
            this.msg = "Please Sign In to Bid!";
        }
        
        this.getauctiondetails();
        // setInterval(()=>{
        //     this.getauctiondetails();
        // }, 2000)
    },
    methods: {
        bidProduct(){
            this.btn_loading = true;
            this.bid.user_id = Store.state.currentUser.id;
            BidderService.bidProduct(this.bid)
            .then(res=>{
                if(res.data.status){
                    this.errorAlert = false;
                    this.successAlert = true;
                    this.auction.winner_bid = res.data.auction.winner_bid;
                }else{
                    this.errorAlert = true;
                    this.successAlert = false;
                }
                this.msg = res.data.message;
                this.btn_loading = false;
                this.bid.bidding_price = 0;
                
            })
            .catch(response => {
                this.errors=response.error.data;
            });
        },
        getauctiondetails()
        {
        
        AuctionService.getauctiondetails(this.auctionid)
                .then(response => {
                    // console.log("Called");
                    this.auctions = response.data.data;
                    this.auction = this.auctions[0];
                    this.can_bid = response.data.can_bid;
                    if(this.auction.front_image !== null){
                        this.auction.front_image = env.baseURL + '/' + this.auction.front_image;
                    }else{
                        this.auction.front_image = '/images/pre-upload.png';
                    }
                    if(this.auction.back_image !== null){
                        this.auction.back_image = env.baseURL + '/' + this.auction.back_image;
                    }else{
                        this.auction.back_image = '/images/pre-upload.png';
                    }
                    if(this.auction.left_image !== null){
                        this.auction.left_image = env.baseURL + '/' + this.auction.left_image;
                    }else{
                        this.auction.left_image = '/images/pre-upload.png';
                    }
                    if(this.auction.right_image !== null){
                        this.auction.right_image = env.baseURL + '/' + this.auction.right_image;
                    }else{
                        this.auction.right_image = '/images/pre-upload.png';
                    }
                    // this.bid.user_id = Store.state.currentUser.id;
                    this.bid.auction_id = this.auction.id;
                    this.bid.percentage = this.auction.percentage;
                    this.bid.expected_value = this.auction.expected_value;
                    this.bid.base_price = this.auction.base_price;
                    this.bid.bidding_date = new Date().toISOString().split('T')[0];
                    this.forceRerender();
                    // this.forceRerender();
                    // console.log(this.auction.front_image)	
                }).catch(response => {
                    this.errors=response.error.data;
                    // console.log(response)
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
    },
    
}
</script>