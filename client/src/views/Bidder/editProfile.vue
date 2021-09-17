<template>
<div>
    <div class="grid grid-cols-2 gap-2">
        <div class="flex items-center w-full">
            <div class="w-full bg-white px-8 py-4 rounded-lg shadow-lg">
                <a class="flex items-center w-50 mb-4 font-medium text-gray-900 title-font md:mb-0">
                    <!-- <div class="w-2 h-2 p-2 mr-2 rounded-full bg-gradient-to-tr from-blue-300 to-blue-600">
                    </div> -->
                    <h2 class="text-lg font-bold tracking-tighter text-black uppercase duration-300 ease-in-out transform transition hover:text-blue-500 dark:text-gray-400"> Edit Personal Information </h2>
                </a>
                <div v-if="statusText.length > 0" class="mt-5 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                    <span class="block sm:inline">{{ statusText }}</span>
                </div>
                <form enctype="multipart/form-data" class="mt-6 flex flex-col gap-4" method="POST" @submit.prevent="updateUser(userId, user)">
                    <div class="flex flex-col md:flex-row gap-4 justify-center">
                        <div class="w-full">
                            <label class="mb-1 block text-sm font-medium leading-relaxed tracking-tighter text-gray-700">Name</label>
                            <input type="text" v-model="user.name" required placeholder="Your Name" class="w-full px-4 py-2 text-base text-black transition duration-300 ease-in-out transform border-transparent rounded-lg bg-gray-100 focus:border-gray-500 focus:bg-white focus:outline-none focus:ring-2 ring-offset-2 ">
                        </div>
                        <div class="w-full">
                            <label class="mb-1 block text-sm font-medium leading-relaxed tracking-tighter text-gray-700">Email Address</label>
                            <input type="email" v-model="user.email" required placeholder="Your Email" class="w-full px-4 py-2 text-base text-black transition duration-300 ease-in-out transform border-transparent rounded-lg bg-gray-100 focus:border-gray-500 focus:bg-white focus:outline-none focus:ring-2 ring-offset-2">
                        </div>
                        <div v-if="errors.email.length > 0" class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                            <span class="block sm:inline">{{ errors.email[0]}}</span>
                        </div>
                        
                    </div>
                    <div class="flex flex-col md:flex-row gap-4 justify-center">
                        <div class="w-full">
                            <label class="mb-1 block text-sm font-medium leading-relaxed tracking-tighter text-gray-700">Mobile Number</label>
                            <input type="number" v-model="user.mobile_no" required minlength="11" placeholder="Your Mobile No." class="w-full px-4 py-2 text-base text-black transition duration-300 ease-in-out transform border-transparent rounded-lg bg-gray-100 focus:border-gray-500 focus:bg-white focus:outline-none focus:ring-2 ring-offset-2">
                        </div> 
                    </div>
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert" v-show="user.mobile_no.length>11">
                            <span class="block sm:inline">Must be 11 digit</span>
                        </div>
                
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert" v-show="user.mobile_no.length==1">
                            <span class="block sm:inline">Must be 11 digit</span>
                        </div>
                        <div v-if="errors.mobile_no.length > 0" class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                            <span class="block sm:inline">{{ errors.mobile_no[0]}}</span>
                        </div>
                    <div>
                        <label class="mb-1 block text-sm font-medium leading-relaxed tracking-tighter text-gray-700">Password</label>
                        <input type="password" v-model="user.password" minlength="6" placeholder="Your Password" class="w-full px-4 py-2 text-base text-black transition duration-300 ease-in-out transform border-transparent rounded-lg bg-gray-100 focus:border-gray-500 focus:bg-white focus:outline-none focus:ring-2 ring-offset-2" >
                    </div> 
                    <div>
                        <label class="mb-1 block text-sm font-medium leading-relaxed tracking-tighter text-gray-700">Confirm Password</label>
                        <input type="password" v-model="user.password_confirmation" minlength="6" placeholder="Confirm Password" class="w-full px-4 py-2 text-base text-black transition duration-300 ease-in-out transform border-transparent rounded-lg bg-gray-100 focus:border-gray-500 focus:bg-white focus:outline-none focus:ring-2 ring-offset-2" >
                    </div>
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert" v-show="user.password!=user.password_confirmation && user.password_confirmation.length>0">
                        <span class="block sm:inline">Password and Confirm Password doesnt match</span>
                    </div>
                    <div v-if="errors.password.length > 0" class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                            <span class="block sm:inline">{{ errors.password[0]}}</span>
                        </div>
                    <div class="flex flex-col md:flex-row gap-4 justify-center">
                        <div class="w-full">
                                <label class="mb-1 block text-sm font-medium leading-relaxed tracking-tighter text-gray-700">Account Type</label>
                            <div class="mt-2">
                                    <label class="inline-flex items-center" v-on:click="loginType = false">
                                    <input type="radio" v-model="user.account_type" class="form-radio" name="accountType" value="personal">
                                    <span class="ml-2">Personal</span>
                                    </label>
                                    <label class="inline-flex items-center ml-4" v-on:click="loginType = true">
                                    <input type="radio" v-model="user.account_type" class="form-radio" name="accountType" value="company">
                                    <span class="ml-2">Business</span>
                                    </label>
                            </div>
                        </div>     
                    </div>
                    <div>
                        <label class="mb-1 block text-sm font-medium leading-relaxed tracking-tighter text-gray-700">NID Number(For institution Head of the institution)</label>
                        <input type="number" v-model="user.nid_no" required minlength="10" placeholder="Your NID Number" class="w-full px-4 py-2 text-base text-black transition duration-300 ease-in-out transform border-transparent rounded-lg bg-gray-100 focus:border-gray-500 focus:bg-white focus:outline-none focus:ring-2 ring-offset-2" >
                    </div> 
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert" v-show="user.nid_no.length>10">
                            <span class="block sm:inline">NID Number Must be 10 digit</span>
                        </div>
                
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert" v-show="user.nid_no.length==1">
                            <span class="block sm:inline">NID Number Must be 10 digit</span>
                        </div>
                        <div v-if="errors.nid_no.length > 0" class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                            <span class="block sm:inline">{{ errors.nid_no[0]}}</span>
                        </div>
                    <div>
                        <label class="mb-1 block text-sm font-medium leading-relaxed tracking-tighter text-gray-700">NID Scan copy(Front Part)</label>
                        <input type="file" v-on:change="onImageChange" placeholder="NID Scan copy(front Part)" class="w-full px-4 py-2 text-base text-black transition duration-300 ease-in-out transform border-transparent rounded-lg bg-gray-100 focus:border-gray-500 focus:bg-white focus:outline-none focus:ring-2 ring-offset-2" >
                    </div>
                    <div>
                        <label class="mb-1 block text-sm font-medium leading-relaxed tracking-tighter text-gray-700">NID Scan copy(Back Part)</label>
                        <input type="file" v-on:change="onImageChange1" placeholder="NID Scan copy(back Part)" class="w-full px-4 py-2 text-base text-black transition duration-300 ease-in-out transform border-transparent rounded-lg bg-gray-100 focus:border-gray-500 focus:bg-white focus:outline-none focus:ring-2 ring-offset-2" >
                    </div>
                    <div  v-if="loginType">
                        <div>
                            <label class="mb-1 block text-sm font-medium leading-relaxed tracking-tighter text-gray-700">VAT Number</label>
                            <input :disabled="!loginType" type="number" v-model="user.vat_no" placeholder="Your VAT Number"  class="w-full px-4 py-2 text-base text-black transition duration-300 ease-in-out transform border-transparent rounded-lg bg-gray-100 focus:border-gray-500 focus:bg-white focus:outline-none focus:ring-2 ring-offset-2" >
                        </div> 
                        <div v-if="errors.vat_no.length > 0" class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                            <span class="block sm:inline">{{ errors.vat_no[0]}}</span>
                        </div>
                        <div>
                            <label class="mb-1 block text-sm font-medium leading-relaxed tracking-tighter text-gray-700">VAT Scan Copy</label>
                            <input :disabled="!loginType" type="file" v-on:change="onImageChange2" placeholder="Scan copy" class="w-full px-4 py-2 text-base text-black transition duration-300 ease-in-out transform border-transparent rounded-lg bg-gray-100 focus:border-gray-500 focus:bg-white focus:outline-none focus:ring-2 ring-offset-2" >
                        </div> 
                    </div>                    
                    <button type="submit" class="block w-full px-4 py-3  mt-6 mb-4 font-semibold text-white transition duration-300 ease-in-out transform bg-black rounded-lg hover:bg-gray-700 active:bg-black focus:shadow-outline focus:outline-none focus:ring-2 focus:ring-black ring-offset-2">
                        Update
                    </button>
                </form>
                <div class="p-2 bg-blue-800 items-center text-indigo-100 leading-none lg:rounded-full flex lg:inline-flex" role="alert" v-if="msg">
                    <p>{{this.msg}}</p>
                </div>
            </div>
        </div>  
        <div class="grid grid-cols-2 gap-2 h-3/5">
            <div class="card text-center shadow-xl h-72 text-center">
                <figure class="px-10 pt-10 object-contain h-48 w-full">
                    <img :src="user.nid_front_img" class="rounded-xl object-contain h-32 w-full">
                </figure> 
                <div class="card-body">
                    <h2 class="card-title">NID Front</h2>
                </div>
            </div> 
            <div class="card text-center shadow-xl h-72">
                <figure class="px-10 pt-10 object-contain h-48 w-full">
                    <img :src="user.nid_back_img" class="rounded-xl object-contain h-32 w-full">
                </figure> 
                <div class="card-body">
                    <h2 class="card-title">NID Back</h2>
                </div>
            </div> 
            <div class="card text-center shadow-xl h-72">
                <div class="card-body">
                    <h2 class="card-title">Balance: {{ user.deposit }}</h2>
                    <!-- <h2 class="card-title">  </h2> -->
                    <div class="form-control">
                    <input v-model="deposit" type="number" placeholder="Add Money" class="input input-bordered">
                    <button @click="addMoney" :class="btn_loading ? 'btn mt-5 loading' : 'btn mt-5'">Add Money</button> 
                    <div v-if="success" class="alert alert-success mt-5">
                    <div class="flex-1">
                        <label>Deposit Success!</label>
                    </div>
                    </div>
                </div>
                </div>
            </div>
            <div class="card text-center shadow-xl h-72">
                <figure class="px-10 pt-10 ">
                    <img :src="user.vat_img" class="rounded-xl object-contain h-32 w-full">
                </figure>
                <div class="card-body">
                    <h2 class="card-title">Vat</h2>
                </div>
            </div> 
        </div>
    </div>
</div>
</template>
<script>
import env from '../../config/env';
import BidderService from '../../services/BidderService';
import { useRouter } from "vue-router";
export default {
    name:'BidderUpdate',
    data() {
        return {
            userId: '',
            loginType:false,
            statusText:'',
            errors:{
                name: [],
                email: [],
                password: [],
                mobile_no:[],
                password_confirmation: [],
                account_type:[],
                nid_no:[],
                vat_no:[],
            },
            user: {
                name: "",
                mobile_no: "",
                email: "",
                password:"",
                password_confirmation:"",
                account_type:"",
                nid_no:"",
                nid_front_img:"/images/pre-upload.png",
                nid_back_img:"/images/pre-upload.png",
                vat_no:null,
                vat_img:"/images/pre-upload.png",
                is_approved:0,
                deposit:0
            },
            msg:'',
            path: '',
            deposit:0,
            success: false,
            btn_loading:false,
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
        this.path = env.baseURL;
        this.getBidder(this.userId);
    },
    methods: {
            viewCompanyFields(){
                if(this.user.account_type === 'company'){
                    this.loginType = true;
                }else{
                    this.loginType = false;
                }
            },
            addMoney(){
                this.btn_loading = true;
                BidderService.deposit({
                    user_id: this.userId,
                    deposit: this.deposit
                })
                .then((res)=>{
                    this.user.deposit = res.data.deposit;
                    this.deposit = 0;
                    this.success = true;
                    this.btn_loading = false;
                    Store.commit('setDeposit', { deposit: res.data.deposit})
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
					
				})
            },
            setImagePath(){
                if(this.user.nid_front_img !== null){
                    this.user.nid_front_img = this.path + "/" + this.user.nid_front_img;
                }else{
                    this.user.nid_front_img = "/images/pre-upload.png";
                }
                if(this.user.nid_back_img !== null){
                    this.user.nid_back_img = this.path + "/" + this.user.nid_back_img;
                }else{
                    this.user.nid_back_img = "/images/pre-upload.png";
                }
                if(this.user.vat_img !== null){
                    this.user.vat_img = this.path + "/" + this.user.vat_img;
                }else{
                    this.user.vat_img = "/images/pre-upload.png";
                }
            },
            onImageChange(e) {
                let files = e.target.files || e.dataTransfer.files;
                if (!files.length)
                    return;
                this.createImage(files[0]);
            },
            createImage(file) {
                let reader = new FileReader();
                let vm = this;
                reader.onload = (e) => {
                    vm.user.nid_front_img = e.target.result;
                };
                reader.readAsDataURL(file);
            },
            onImageChange1(e) {
                let files = e.target.files || e.dataTransfer.files;
                if (!files.length)
                    return;
                this.createImage1(files[0]);
            },
            createImage1(file) {
                let reader = new FileReader();
                let vm = this;
                reader.onload = (e) => {
                    vm.user.nid_back_img = e.target.result;
                };
                reader.readAsDataURL(file);
            },
            onImageChange2(e) {
                let files = e.target.files || e.dataTransfer.files;
                if (!files.length)
                    return;
                this.createImage2(files[0]);
            },
            createImage2(file) {
                let reader = new FileReader();
                let vm = this;
                reader.onload = (e) => {
                    vm.user.vat_img = e.target.result;
                };
                reader.readAsDataURL(file);
            },
            updateUser(id, user){
                BidderService.update(id, user)
                .then(response => {
                    let successMessage = response.data.message
                    this.msg=successMessage;
                    this.statusText = '';
                })
                .catch(error => {
                    this.statusText = error.response.statusText;
					let data = error.response.data
                    for (let key in data.errors) {
						this.errors[key] = []
						let errorMessage = data.errors[key]
						if (errorMessage){
							this.errors[key] = errorMessage
						}
					}
					
				})
            },
            getBidder(id){
                BidderService.getBidder(id)
                .then(res=>{
                    this.user = res.data.bidder;
                    this.setImagePath();
                    this.viewCompanyFields();
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
				})
            }
        }
}
</script>