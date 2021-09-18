<template>
    <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200"> Add Product </h2>
     <div v-if="statusText.length > 0" class="mt-5 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
        <span class="block sm:inline">{{ statusText }}</span>
    </div>
            <!-- <div class="bg-gray-500 pt-3">
                <div class="rounded-tl-4xl bg-gradient-to-r from-blue-400 to-gray-400 p-4 shadow text-2xl text-white">
                    <h3 class="font-bold pl-2">Add Product</h3>
                </div>
            </div> -->
    <div class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
         <form @submit.prevent="storeProduct(form_data)">
                        <div class="mb-16">
                            <div class="max-h-96  flex flex-col gap-4">
                                <div class="w-full flex items-center gap-4">
                                    <label class="w-full block text-sm">
                                        <span class="text-gray-700 dark:text-gray-400">
                                            Name <span class="-ml-1 text-red-500">*</span>
                                        </span>
                                        <input type="text" v-model="form_data.product_name" class=" block w-full mt-1 text-sm dark:text-gray-300 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-red form-input rounded" placeholder="Enter Product Name"/>
                                     <ul class="mt-1 ml-2 bg-red-100 list-disc list-inside">
                                            <li v-for="allErrors in errors.name" :key="allErrors">
                                                
                                                    <span>
                                                        {{ allErrors }}
                                                    
                                                </span>
                                            </li>
                                        </ul>
                                    </label>
                                    <label class="w-full block text-sm">
                                        <span class="text-gray-700 dark:text-gray-400">
                                            Model Number <span class="-ml-1 text-red-500">*</span>
                                        </span>
                                        <input type="text" required v-model="form_data.model_no" class=" block w-full mt-1 text-sm dark:text-gray-300 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-red form-input rounded" placeholder="Enter Product Name"/>
                                    <div v-if="errors.model_no.length > 0" class="bg-red-100 border border-red-400 text-red-700 px-4 py-2 mt-1 rounded relative" role="alert">
                                            <span class="block sm:inline">{{ errors.model_no[0]}}</span>
                                    </div>
                                    </label>
                                    <label class="w-full block text-sm">
                                        <span class="text-gray-700 dark:text-gray-400">
                                            SKU <span class="-ml-1 text-red-500">*</span>
                                        </span>
                                        <input type="text" required v-model="form_data.sku" class=" block w-full mt-1 text-sm dark:text-gray-300 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-red form-input rounded" placeholder="Enter Product SKU"/>
                                    <div v-if="errors.sku.length > 0" class="bg-red-100 border border-red-400 text-red-700 px-4 py-2 mt-1 rounded relative" role="alert">
                                            <span class="block sm:inline">{{ errors.sku[0]}}</span>
                                    </div>
                                    </label>
                                </div>
                                <div class="w-full flex items-center gap-4">
                                    <label class="w-full block text-sm">
                                        <span class="text-gray-700 dark:text-gray-400">
                                            Base Price
                                        </span>
                                        <input type="number" required v-model="form_data.base_price" class="block w-full mt-1 text-sm dark:text-gray-300 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-red form-input rounded" placeholder="Product Price"/>
                                    <div v-if="errors.base_price.length > 0" class="bg-red-100 border border-red-400 text-red-700 px-4 py-2 mt-1 rounded relative" role="alert">
                                            <span class="block sm:inline">{{ errors.base_price[0]}}</span>
                                    </div>
                                    </label>
                                    <label class="w-full block text-sm">
                                        <span class="text-gray-700 dark:text-gray-400">
                                            Expected Price
                                        </span>
                                        <input type="number" required v-model="form_data.expected_value" class="block w-full mt-1 text-sm dark:text-gray-300 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-red form-input rounded" placeholder="Product Price"/>
                                    <div v-if="errors.expected_value.length > 0" class="bg-red-100 border border-red-400 text-red-700 px-4 py-2 mt-1 rounded relative" role="alert">
                                            <span class="block sm:inline">{{ errors.expected_value[0]}}</span>
                                    </div>
                                    </label>
                                    <label class="w-full block text-sm">
                                        <span class="text-gray-700 dark:text-gray-400">
                                            Percentage
                                        </span>
                                        <input type="number" required v-model="form_data.percentage" class="block w-full mt-1 text-sm dark:text-gray-300 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-red form-input rounded" placeholder="Product Price"/>
                                    <div v-if="errors.percentage.length > 0" class="bg-red-100 border border-red-400 text-red-700 px-4 py-2 mt-1 rounded relative" role="alert">
                                            <span class="block sm:inline">{{ errors.percentage[0]}}</span>
                                    </div>
                                    </label>
                                </div>
                                <div class="w-full flex items-center gap-4">
                                    <label class="w-full block text-sm">
                                        <span class="text-gray-700 dark:text-gray-400">
                                            Select Category <span class="-ml-1 text-red-500">*</span>
                                        </span>
                                        <select class="w-full block mt-1 text-sm dark:text-gray-300 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-red form-input rounded" required v-model="form_data.category_id">
                                            <option class="py-1" value="">
                                                --Select Category--
                                            </option>
                                            <option class="py-1" v-for="(item,index) in categories" :key="index" :value="item.id">
                                                {{item.name}}
                                            </option>
                                        </select>
                                    <div v-if="errors.category_id.length > 0" class="bg-red-100 border border-red-400 text-red-700 px-4 py-2 mt-1 rounded relative" role="alert">
                                            <span class="block sm:inline">{{ errors.category_id[0]}}</span>
                                    </div>
                                    </label>
                                    <label class="w-full block text-sm">
                                        <span class="text-gray-700 dark:text-gray-400"> 
                                            Select Grade <span class="-ml-1 text-red-500">*</span>
                                        </span>
                                        <select class="w-full block mt-1 text-sm dark:text-gray-300 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-red form-input rounded" required v-model="form_data.grade">
                                            <option class="py-1" value="">
                                                --Select Grade--
                                            </option>
                                            <option class="py-1" :value="'A' + i" v-for="i in 6" :key="i">
                                                A{{ i }}
                                            </option>
                                        </select>
                                    <div v-if="errors.grade.length > 0" class="bg-red-100 border border-red-400 text-red-700 px-4 py-2 mt-1 rounded relative" role="alert">
                                            <span class="block sm:inline">{{ errors.grade[0]}}</span>
                                    </div>
                                    </label>
                                </div>
                                <div class="w-full flex items-center gap-4">
                                    <label class="block text-sm">
                                        <span class="text-gray-700 dark:text-gray-400">
                                            Front Image <span class="-ml-1 text-red-500">*</span>
                                        </span>
                                       
                                        <!-- <div>
                                            <img v-if="this.form_data.front_image" :src="this.form_data.front_image" />
                                        </div> -->
                                        <input ref="front_image" type="file" required @change="onImageChange"  class=" block w-full mt-1 text-sm dark:text-gray-300 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-red form-input rounded" placeholder="Product Image"/>
                                    </label>
                                    <label class="block text-sm">
                                        <span class="text-gray-700 dark:text-gray-400">
                                            Back Image <span class="-ml-1 text-red-500">*</span>
                                        </span>
                                        <!-- <div>
                                            <img v-if="this.form_data.back_image" :src="this.form_data.back_image" />
                                        </div> -->
                                        <input ref="back_image" type="file" required v-on:change="onImageChange1"  class=" block w-full mt-1 text-sm dark:text-gray-300 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-red form-input rounded" placeholder="Product Image"/>
                                    </label>
                                    <label class="block text-sm">
                                        <span class="text-gray-700 dark:text-gray-400">
                                            Left Image <span class="-ml-1 text-red-500">*</span>
                                        </span>
                                        <!-- <div>
                                            <img v-if="this.form_data.left_image" :src="this.form_data.left_image" />
                                        </div> -->
                                       
                                        <input ref="left_image" type="file" required v-on:change="onImageChange2"  class=" block w-full mt-1 text-sm dark:text-gray-300 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-red form-input rounded" placeholder="Product Image"/>
                                    </label>
                                    <label class="block text-sm">
                                        <span class="text-gray-700 dark:text-gray-400">
                                            Right Image <span class="-ml-1 text-red-500">*</span>
                                        </span>
                                        <!-- <div>
                                            <img v-if="this.form_data.right_image" :src="this.form_data.right_image" />
                                        </div> -->
                                         
                                        <input ref="right_image" type="file" required v-on:change="onImageChange3"  class=" block w-full mt-1 text-sm dark:text-gray-300 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-red form-input rounded" placeholder="Product Image"/>
                                    </label>
                                </div>
                                <div class="w-full flex items-center gap-4">
                                    <label class="w-full block text-sm mt-4">
                                        <span class="text-gray-700 dark:text-gray-400"> Specification </span>
                                        <textarea v-model="form_data.specification" required class="block w-full mt-1 text-sm dark:text-gray-300 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-red form-input rounded" placeholder="category description"/>
                                    <div v-if="errors.specification.length > 0" class="bg-red-100 border border-red-400 text-red-700 px-4 py-2 mt-1 rounded relative" role="alert">
                                            <span class="block sm:inline">{{ errors.specification[0]}}</span>
                                    </div>
                                    </label>
                                    <label class="w-full block text-sm mt-4">
                                        <span class="text-gray-700 dark:text-gray-400"> Description </span>
                                        <textarea v-model="form_data.description" required class="block w-full mt-1 text-sm dark:text-gray-300 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-red form-input rounded" placeholder="category description"/>
                                    <div v-if="errors.description.length > 0" class="bg-red-100 border border-red-400 text-red-700 px-4 py-2 mt-1 rounded relative" role="alert">
                                            <span class="block sm:inline">{{ errors.description[0]}}</span>
                                    </div>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="flex flex-col items-center justify-end px-6 py-3 -mx-6 -mb-4 space-y-4 sm:space-y-0 sm:space-x-6 sm:flex-row bg-gray-50 dark:bg-gray-800">
                           
                            <span v-if="is_saved" class="mt-2 px-2 py-1 text-sm font-semibold leading-tight text-green-700 bg-green-100 rounded-full dark:bg-green-700 dark:text-green-100">
                                Product has been added
                            </span>
                            <router-link :to="{name: 'admin.product.index'}">
                            <button class="w-full py-2 px-4 inline-flex items-center justify-center gap-2 flex-none text-sm font-medium leading-6 text-gray-700 transition-colors duration-150 border border-gray-300 rounded-lg dark:text-gray-400 sm:px-4 sm:py-2 sm:w-auto active:bg-transparent hover:border-gray-500 focus:border-gray-500 active:text-gray-500 focus:outline-none focus:shadow-outline-gray">
                                <span>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                                    </svg>
                                </span> 
                                Back to product
                            </button>                           
                            </router-link>

                            <button type="submit" :disabled="is_loading" class="w-full sm:w-auto inline-flex items-center justify-center gap-2 flex-none bg-gray-900 hover:bg-gray-700 text-gray-100 text-sm leading-6 font-semibold py-2 px-4 border border-transparent rounded-lg focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-100 focus:ring-black focus:outline-none transition-colors duration-300">
                                <span>Add Product</span> 
                                <span v-if="is_loading">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 animate-spin" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M4 2a1 1 0 011 1v2.101a7.002 7.002 0 0111.601 2.566 1 1 0 11-1.885.666A5.002 5.002 0 005.999 7H9a1 1 0 010 2H4a1 1 0 01-1-1V3a1 1 0 011-1zm.008 9.057a1 1 0 011.276.61A5.002 5.002 0 0014.001 13H11a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0v-2.101a7.002 7.002 0 01-11.601-2.566 1 1 0 01.61-1.276z" clip-rule="evenodd"/>
                                    </svg>
                                </span> 
                            </button>
                        </div>
                    </form>
    </div>
</template>

<script>
import ProductService from "../../../services/ProductService";
import CategoryService from "../../../services/CategoryService";
import LinkButton from '../../../components/LinkButton.vue';
export default {
        data(){
            return {
				errors:null,
                categories:[],
                statusText:'',
                errors:{
					product_name: [],
					model_no: [],
					sku: [],
                    base_price:[],
					expected_value: [],
                    percentage:[],
                    category_id:[],
                    grade:[],
                    specification:[],
                    description:[]
				},
                form_data:{
                 sku:"",
                 product_name:"",
                 expected_value:0,
                 base_price:0,
                 percentage:"",
                 grade:"",
                 model_no:"",
                 specification:"",
                 description:"",
                 category_id:"",
                 front_image:"",
                 back_image:"",
                 left_image:"",
                 right_image:"",
                 is_sold:'0'
                },
                default_form_data:{
                 sku:"",
                 product_name:"",
                 expected_value:0,
                 base_price:0,
                 percentage:"",
                 grade:"",
                 model_no:"",
                 specification:"",
                 description:"",
                 category_id:"",
                 front_image:"",
                 back_image:"",
                 left_image:"",
                 right_image:"",
                 is_sold:'0'
                },
                is_loading:false,
                is_saved:null
            }
        },
        created(){
            CategoryService.index()
			.then(response => {
				this.categories = response.data.categories;	
			}).catch(response => {
				console.log(response);
			});
	    },
        methods: {
            resetFormData(){
                this.$nextTick(() => {
                this.form_data = Object.assign({}, this.default_form_data);
                this.$refs.front_image.value=null;
                this.$refs.back_image.value=null;
                this.$refs.left_image.value=null;
                this.$refs.right_image.value=null;
              });
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
                    vm.form_data.front_image = e.target.result;
                    // console.log(this.front_image)
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
                    vm.form_data.back_image = e.target.result;
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
                    vm.form_data.left_image = e.target.result;
                };
                reader.readAsDataURL(file);
            },
            onImageChange3(e) {
                let files = e.target.files || e.dataTransfer.files;
                if (!files.length)
                    return;
                this.createImage3(files[0]);
            },
            createImage3(file) {
                let reader = new FileReader();
                let vm = this;
                reader.onload = (e) => {
                    vm.form_data.right_image = e.target.result;
                    // console.log(this.right_image)
                };
                reader.readAsDataURL(file);
            },
            storeProduct(form_data){
                  this.is_loading=true
                ProductService.storeProduct(form_data)
                .then(response => {
                    this.is_saved = response.data.status;
                    this.is_loading=false;
                    this.resetFormData();
                    this.statusText = '';
                })
                .catch(error => {
                    this.is_loading=false
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
            }
        }
    }
</script>
<style>
#preview img {
  max-width: 50%;
  max-height: 400px;
}
</style>