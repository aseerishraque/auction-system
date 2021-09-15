<template>
<div class="container mx-auto " data-theme="cupcake">
    <!-- NavBar Start -->
    <NavBar/>
    <!-- NavBar END -->
<!-- Carousel start -->
    <div class="carousel relative shadow-2xl bg-white rounded-box">
        <div class="carousel-inner relative overflow-hidden w-full">
        <!--Slide 1-->
            <input class="carousel-open" type="radio" id="carousel-1" name="carousel" aria-hidden="true" hidden="" checked="checked">
            <div class="carousel-item absolute opacity-0" style="height:50vh;">
                <div class="block h-full w-full bg-indigo-500 text-white text-5xl text-center">
                    <img src="https://picsum.photos/1000/260" class="w-screen">
                </div>
            </div>
            <label for="carousel-3" class="prev control-1 w-10 h-10 ml-2 md:ml-10 absolute cursor-pointer hidden text-3xl font-bold text-black hover:text-white rounded-full bg-white hover:bg-blue-700 leading-tight text-center z-10 inset-y-0 left-0 my-auto">‹</label>
            <label for="carousel-2" class="next control-1 w-10 h-10 mr-2 md:mr-10 absolute cursor-pointer hidden text-3xl font-bold text-black hover:text-white rounded-full bg-white hover:bg-blue-700 leading-tight text-center z-10 inset-y-0 right-0 my-auto">›</label>
            
            <!--Slide 2-->
            <input class="carousel-open" type="radio" id="carousel-2" name="carousel" aria-hidden="true" hidden="">
            <div class="carousel-item absolute opacity-0" style="height:50vh;">
                <div class="block h-full w-full bg-orange-500 text-white text-5xl text-center">
                    <img src="https://picsum.photos/1000/280" class="w-screen">
                </div>
            </div>
            <label for="carousel-1" class="prev control-2 w-10 h-10 ml-2 md:ml-10 absolute cursor-pointer hidden text-3xl font-bold text-black hover:text-white rounded-full bg-white hover:bg-blue-700 leading-tight text-center z-10 inset-y-0 left-0 my-auto">‹</label>
            <label for="carousel-3" class="next control-2 w-10 h-10 mr-2 md:mr-10 absolute cursor-pointer hidden text-3xl font-bold text-black hover:text-white rounded-full bg-white hover:bg-blue-700 leading-tight text-center z-10 inset-y-0 right-0 my-auto">›</label> 
            
            <!--Slide 3-->
            <input class="carousel-open" type="radio" id="carousel-3" name="carousel" aria-hidden="true" hidden="">
            <div class="carousel-item absolute opacity-0" style="height:50vh;">
                <div class="block h-full w-full bg-green-500 text-white text-5xl text-center">
                    <img src="https://picsum.photos/1000/270" class="w-screen">
                </div>
            </div>
            <label for="carousel-2" class="prev control-3 w-10 h-10 ml-2 md:ml-10 absolute cursor-pointer hidden text-3xl font-bold text-black hover:text-white rounded-full bg-white hover:bg-blue-700 leading-tight text-center z-10 inset-y-0 left-0 my-auto">‹</label>
            <label for="carousel-1" class="next control-3 w-10 h-10 mr-2 md:mr-10 absolute cursor-pointer hidden text-3xl font-bold text-black hover:text-white rounded-full bg-white hover:bg-blue-700 leading-tight text-center z-10 inset-y-0 right-0 my-auto">›</label>

            <!-- Add additional indicators for each slide-->
            <ol class="carousel-indicators">
                <li class="inline-block mr-3">
                    <label for="carousel-1" class="carousel-bullet cursor-pointer block text-4xl text-white hover:text-blue-700">•</label>
                </li>
                <li class="inline-block mr-3">
                    <label for="carousel-2" class="carousel-bullet cursor-pointer block text-4xl text-white hover:text-blue-700">•</label>
                </li>
                <li class="inline-block mr-3">
                    <label for="carousel-3" class="carousel-bullet cursor-pointer block text-4xl text-white hover:text-blue-700">•</label>
                </li>
            </ol>
            
        </div>
    </div>
<!-- Carousel END -->
<!-- Featured Section Start -->
    <h1 v-if="runningAuctions.length > 0" class="text-3xl mt-10">Running Auctions</h1>
    <div class="grid grid-cols-3 gap-3">
      <AuctionItem v-for="(runningAuction, index) in runningAuctions" :key="index" 
        :expiryDate="runningAuction.close_time"
        :front_image="runningAuction.front_image"
        :product_name="runningAuction.product_name"
        :id="runningAuction.id"
        />
    </div>
<!-- Featured Section END -->
<!-- Footer Start -->
<footer class="p-10 footer bg-base-200 text-base-content">
  <div>
    <svg width="50" height="50" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" fill-rule="evenodd" clip-rule="evenodd" class="fill-current">
      <path d="M22.672 15.226l-2.432.811.841 2.515c.33 1.019-.209 2.127-1.23 2.456-1.15.325-2.148-.321-2.463-1.226l-.84-2.518-5.013 1.677.84 2.517c.391 1.203-.434 2.542-1.831 2.542-.88 0-1.601-.564-1.86-1.314l-.842-2.516-2.431.809c-1.135.328-2.145-.317-2.463-1.229-.329-1.018.211-2.127 1.231-2.456l2.432-.809-1.621-4.823-2.432.808c-1.355.384-2.558-.59-2.558-1.839 0-.817.509-1.582 1.327-1.846l2.433-.809-.842-2.515c-.33-1.02.211-2.129 1.232-2.458 1.02-.329 2.13.209 2.461 1.229l.842 2.515 5.011-1.677-.839-2.517c-.403-1.238.484-2.553 1.843-2.553.819 0 1.585.509 1.85 1.326l.841 2.517 2.431-.81c1.02-.33 2.131.211 2.461 1.229.332 1.018-.21 2.126-1.23 2.456l-2.433.809 1.622 4.823 2.433-.809c1.242-.401 2.557.484 2.557 1.838 0 .819-.51 1.583-1.328 1.847m-8.992-6.428l-5.01 1.675 1.619 4.828 5.011-1.674-1.62-4.829z"></path>
    </svg> 
    <p>Auction System ORG
      <br>Providing reliable Service since 2021
    </p>
  </div> 
  <div>
    <span class="footer-title">Services</span> 
    <a class="link link-hover">Branding</a> 
    <a class="link link-hover">Design</a> 
    <a class="link link-hover">Marketing</a> 
    <a class="link link-hover">Advertisement</a>
  </div> 
  <div>
    <span class="footer-title">Company</span> 
    <a class="link link-hover">About us</a> 
    <a class="link link-hover">Contact</a> 
    <a class="link link-hover">Jobs</a> 
    <a class="link link-hover">Press kit</a>
  </div> 
  <div>
    <span class="footer-title">Legal</span> 
    <a class="link link-hover">Terms of use</a> 
    <a class="link link-hover">Privacy policy</a> 
    <a class="link link-hover">Cookie policy</a>
  </div>
</footer>
<!-- Footer END -->
</div>
</template>
<script>
import AuctionItem from '../../components/Visitor/AuctionItem.vue';
import AuctionService from '../../services/AuctionService';
import env from '../../config/env';
import NavBar from '../../components/Visitor/Navbar.vue';
export default {
    components:{
        AuctionItem,
        NavBar
    },
    data() {
        return {
            runningAuctions_data:[],
            runningAuctions:[],
            public_url: ''
        }
    },
    created() {
        this.public_url = env.baseURL;
        this.initialize();
    },
    methods: {
        initialize(){
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
                this.runningAuctions = {...this.runningAuctions_data};
                // console.log(this.runningAuctions_data[0].front_image);
            })
            .catch(error=>{
                console.log(error);
            });
        }
    },
}
</script>

<style scoped>
			.carousel-open:checked + .carousel-item {
				position: static;
				opacity: 100;
			}
			.carousel-item {
				-webkit-transition: opacity 0.6s ease-out;
				transition: opacity 0.6s ease-out;
			}
			#carousel-1:checked ~ .control-1,
			#carousel-2:checked ~ .control-2,
			#carousel-3:checked ~ .control-3 {
				display: block;
			}
			.carousel-indicators {
				list-style: none;
				margin: 0;
				padding: 0;
				position: absolute;
				bottom: 2%;
				left: 0;
				right: 0;
				text-align: center;
				z-index: 10;
			}
			#carousel-1:checked ~ .control-1 ~ .carousel-indicators li:nth-child(1) .carousel-bullet,
			#carousel-2:checked ~ .control-2 ~ .carousel-indicators li:nth-child(2) .carousel-bullet,
			#carousel-3:checked ~ .control-3 ~ .carousel-indicators li:nth-child(3) .carousel-bullet {
				color: #2b6cb0;  /*Set to match the Tailwind colour you want the active one to be */
			}
</style>