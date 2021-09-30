<template>
<div class="container mx-auto " data-theme="cupcake">
    <NavBar/>
    <div class="grid grid-cols-4 gap-4">
        <div class="grid grid-cols-1 gap-4 content-start">
            <div class="py-4 artboard artboard-demo bg-base-200 bg-neutral-content shadow-lg">
                <ul class="menu py-3 shadow-lg bg-base-100 rounded-box w-9/12">
                    <li class="menu-title">
                         <span>
                            Categories
                        </span>
                    </li>
                    <li :class="selected_category === null ? 'bg-primary text-white' : ''">
                    <a @click="initialize()">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="inline-block w-5 h-5 mr-2 stroke-current">          
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"></path>                
                        </svg>
                            All
                    </a>
                    </li>
                    <li v-for="category in categories" :key="category.id" :class="selected_category === category.id ? 'bg-primary text-white' : ''">
                    <a @click="getByCategoryId(category.id)">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="inline-block w-5 h-5 mr-2 stroke-current">          
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"></path>                
                        </svg>
                            {{ category.name }}
                    </a>
                    </li>
                </ul>
                <ul class="mt-5 menu py-3 shadow-lg bg-base-100 rounded-box w-9/12">
                    <li class="menu-title">
                         <span>
                            Auction Type
                        </span>
                    </li>
                    <li :class="auctionType === 1 ? 'bg-primary text-white' : ''">
                    <a @click="selectAuctionType(1)">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="inline-block w-5 h-5 mr-2 stroke-current">          
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"></path>                
                        </svg>
                            Running Auctions
                    </a>
                    </li>
                    <li :class="auctionType === 2 ? 'bg-primary text-white' : ''">
                    <a @click="selectAuctionType(2)">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="inline-block w-5 h-5 mr-2 stroke-current">          
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"></path>                
                        </svg>
                            Upcoming Auctions
                    </a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="col-span-3 py-4 artboard artboard-demo bg-base-200 bg-neutral-content shadow-lg">
            <div v-if="renderComponent" class="grid grid-cols-3 gap-4 ">
                <!-- Auction Items -->
                 <AuctionItem v-for="(auction, index) in auctions" :key="index" 
                    :expiryDate="auctionType === 1 ? auction.close_time : auction.start_time"
                    :front_image="auction.front_image"
                    :product_name="auction.product_name"
                    :id="auction.id"
                    :base_price="auction.base_price"
                    :expected_value="auction.expected_value"
                    :percentage="auction.percentage"
                    :type="auctionType"
                    :start_time="auction.start_time"
                    :routeParam="auctionType"
                    />
            </div>
        </div>
    </div>
</div>
</template>
<script>
import NavBar from '../../components/Visitor/Navbar.vue';
import CategoryService from '../../services/CategoryService';
import AuctionService from '../../services/AuctionService';
import env from '../../config/env';
import AuctionItem from '../../components/Visitor/AuctionItem.vue';

export default {
    name: 'CategorisedProducts',
    data() {
        return {
            categories:[],
            runningAuctions_data:[],
            upcommingAuctions_data:[],
            auctions:[],
            auctionType:1,
            selected_category:null,
            renderComponent:true
        }
    },
    components:{
        NavBar,
        AuctionItem
    },
    created() {
        this.public_url = env.baseURL;
        this.initialize();
    },
    methods: {
        initialize(){
            this.selected_category = null;
            CategoryService.index()
            .then(res=>{
                this.categories = {...res.data.categories};
            })
            .catch(error=>{
                console.log(error);
            });

            this.getAuctions(this.auctionType);
        },
        selectAuctionType(type){
            this.auctionType = type;
            this.getAuctions(type);
        },
        getAuctions(type){
            if(type === 1){
                AuctionService.getRunningAuction()
                .then(res=>{
                    this.runningAuctions_data = res.data.data;
                    this.runningAuctions_data = this.runningAuctions_data.map(a=>{
                        if(a.front_image !== null)
                        {
                            a.front_image = this.public_url+'/'+a.front_image;
                        }else{
                            a.front_image = '/images/pre-upload.png';
                        }
                        return a;
                    });
                    if(this.selected_category !== null){
                       this.getByCategoryId(this.selected_category);
                    }else{
                        this.auctions = [...this.runningAuctions_data];
                    }
                    
                })
                .catch(error=>{
                    console.log(error);
                });
            }else{
                AuctionService.getUpcomingAuction()
                .then(res=>{
                    this.upcommingAuctions_data = res.data.data;
                    this.upcommingAuctions_data = this.upcommingAuctions_data.map(a=>{
                        if(a.front_image !== null)
                        {
                            a.front_image = this.public_url+'/'+a.front_image;
                        }else{
                            a.front_image = '/images/pre-upload.png';
                        }
                        return a;
                    });
                    if(this.selected_category !== null){
                       this.getByCategoryId(this.selected_category);
                    }else{
                        this.auctions = [...this.upcommingAuctions_data];
                    }
                    // console.log(this.runningAuctions_data[0].front_image);
                })
                .catch(error=>{
                    console.log(error);
                });
            }
            
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
        getByCategoryId(category_id){
            this.selected_category = category_id;
            if(this.auctionType === 1){
                this.auctions = [...this.runningAuctions_data.filter(item=>item.category_id === category_id ? true : false)];
            }else{
                this.auctions = [...this.upcommingAuctions_data.filter(item=>item.category_id === category_id ? true : false)];
            }
            
        }
    },
}
</script>