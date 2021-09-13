<template>
<!-- <div class="w-3/5"> -->
    <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200"> Products </h2>
<!-- <div class="bg-gray-500 pt-3">
                <div class="rounded-tl-4xl bg-gradient-to-r from-blue-400 to-gray-400 p-4 shadow text-2xl text-white">
                    <h3 class="font-bold pl-2">Products</h3>
                </div>
            </div> -->
    <div class="mb-4 mx-124">
        <link-button to="admin.product.create" name="Add Product">Add Product</link-button>
    </div>
        <div class="w-full mb-4 overflow-hidden rounded-lg shadow-sm border">
            <div class="w-full overflow-x-auto">
                <table class="w-full whitespace-no-wrap">
                    <thead>
                        <tr class=" text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                            <th class="px-4 py-3">#</th>
                            <th class="px-4 py-3">Name</th>
                            <th class="px-4 py-3">Model</th>
                            <th class="px-4 py-3">Grade</th>
                            <th class="px-4 py-3">Base Price</th>
                            <th class="px-4 py-3">Expected Price</th>
                            <th class="px-4 py-3">Percentage</th>
                            <th class="px-4 py-3">Description</th>
                            <th class="px-4 py-3">Front-Image</th>
                            <th class="px-4 py-3">Back-Image</th>
                            <th class="px-4 py-3">Left-Image</th>
                            <th class="px-4 py-3">Right-Image</th>
                            <th class="px-4 py-3">Action</th>
                            
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                        <tr v-for="(product, index) in products" :key="product.id" class="text-gray-700 dark:text-gray-400">
                            <td class="px-4 py-3 text-sm">
                                {{ index + 1 }}
                            </td>
                            <td class="px-4 py-3">
                                <div class="flex items-center text-sm">
                                    <div>
                                        <p class="font-semibold">
                                            {{ product.product_name ? product.product_name : "N/A" }}
                                        </p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-4 py-3">
                                <div class="flex items-center text-sm">
                                    <div>
                                        <p class="font-semibold">
                                            {{ product.model_no ? product.model_no : "N/A" }}
                                        </p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-4 py-3">
                                <div class="flex items-center text-sm">
                                    <div>
                                        <p class="font-semibold">
                                            {{ product.grade ? product.grade : "N/A" }}
                                        </p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-4 py-3">
                                <div class="flex items-center text-sm">
                                    <div>
                                        <p class="font-semibold">
                                            {{ product.base_price ? product.base_price : "N/A" }}
                                        </p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-4 py-3">
                                <div class="flex items-center text-sm">
                                    <div>
                                        <p class="font-semibold">
                                            {{ product.expected_value ? product.expected_value : "N/A" }}
                                        </p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-4 py-3">
                                <div class="flex items-center text-sm">
                                    <div>
                                        <p class="font-semibold">
                                            {{ product.percentage ? product.percentage : "N/A" }}%
                                        </p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-4 py-3 text-xs">
                                <div class="w-40 truncate">
                                    {{ product.description ? product.description : "N/A" }}
                                    
                                </div>
                            </td>
                             <td class="px-4 py-3 text-xs">
                                <div class="w-40">
                                    <img class="w-20 h-20" :src="path + product.front_image">
                                </div>
                            </td>
                            
                             <td class="px-4 py-3 text-xs">
                                <div class="w-40">
                                    <img class="w-20 h-20" :src="path + product.back_image">
                                </div>
                            </td>
                            
                             <td class="px-4 py-3 text-xs">
                                <div class="w-40">
                                    <img class="w-20 h-20" :src="path + product.left_image">
                                </div>
                            </td>

                             <td class="px-4 py-3 text-xs">
                                <div class="w-40">
                                    <img class="w-20 h-20" :src="path + product.right_image">
                                </div>
                            </td>
                             <td class="px-4 py-3 text-xs">
                                <div class="flex items-center space-x-4 text-sm">
                                    <button @click="openModal(index)" class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-black rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray" aria-label="Edit">
                                        <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"></path>
                                        </svg>
                                    </button>
                                </div>
                            </td>
                            
                        </tr>
                    </tbody>
                </table>
            </div>
  <Pagination
      v-if="renderComponent"
      @set-active-page="setActivePage"
      :total="pagination.total"
      :pageCount="pagination.dataCount"
      :activePage="pagination.activePage"
    />
            <br>
            <div v-if="is_modal_open" class="fixed inset-0 z-30 flex items-end bg-black bg-opacity-50 sm:items-center sm:justify-center">
                <div v-if="is_modal_open" class="w-full px-6 py-4 overflow-hidden bg-white rounded-t-lg dark:bg-gray-800 sm:rounded-lg sm:m-4 sm:max-w-5xl" role="dialog" id="modal">
                    <header class="flex justify-end">
                        <button @click="closeModal" class="inline-flex items-center justify-center w-6 h-6 text-gray-400 transition-colors duration-150 rounded dark:hover:text-gray-200 hover: hover:text-gray-700" aria-label="close">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20" role="img" aria-hidden="true">
                                <path d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" fill-rule="evenodd"></path>
                            </svg>
                        </button>
                    </header>

                    <p class="mb-4 text-lg font-semibold text-gray-700 dark:text-gray-300"> Edit category </p>
                    
                    <form @submit.prevent="updateProduct(form_data)">
                        <div class="mb-16">
                            <div class="max-h-96 overflow-y-auto flex flex-col gap-4">
                                <div class="w-full flex items-center gap-4">
                                    <label class="w-full block text-sm">
                                        <span class="text-gray-700 dark:text-gray-400">
                                            Name <span class="-ml-1 text-red-500">*</span>
                                        </span>
                                        <input type="text" required v-model="form_data.product_name" class=" block w-full mt-1 text-sm dark:text-gray-300 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-red form-input rounded" placeholder="Enter Product Name"/>
                                    </label>
                                    <label class="w-full block text-sm">
                                        <span class="text-gray-700 dark:text-gray-400">
                                            Model Number <span class="-ml-1 text-red-500">*</span>
                                        </span>
                                        <input type="text" required v-model="form_data.model_no" class=" block w-full mt-1 text-sm dark:text-gray-300 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-red form-input rounded" placeholder="Enter Product Name"/>
                                    </label>
                                    <label class="w-full block text-sm">
                                        <span class="text-gray-700 dark:text-gray-400">
                                            SKU <span class="-ml-1 text-red-500">*</span>
                                        </span>
                                        <input type="text" required v-model="form_data.sku" class=" block w-full mt-1 text-sm dark:text-gray-300 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-red form-input rounded" placeholder="Enter Product SKU"/>
                                    </label>
                                </div>
                                <div class="w-full flex items-center gap-4">
                                    <label class="w-full block text-sm">
                                        <span class="text-gray-700 dark:text-gray-400">
                                            Base Price
                                        </span>
                                        <input type="number" required v-model="form_data.base_price" class="block w-full mt-1 text-sm dark:text-gray-300 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-red form-input rounded" placeholder="Product Price"/>
                                    </label>
                                    <label class="w-full block text-sm">
                                        <span class="text-gray-700 dark:text-gray-400">
                                            Expected Price
                                        </span>
                                        <input type="number" required v-model="form_data.expected_value" class="block w-full mt-1 text-sm dark:text-gray-300 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-red form-input rounded" placeholder="Product Price"/>
                                    </label>
                                    <label class="w-full block text-sm">
                                        <span class="text-gray-700 dark:text-gray-400">
                                            Percentage
                                        </span>
                                        <input type="text" required v-model="form_data.percentage" class="block w-full mt-1 text-sm dark:text-gray-300 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-red form-input rounded" placeholder="Product Price"/>
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
                                    </label>
                                </div>
                                <div class="w-full flex items-center gap-4">
                                    <label class="block text-sm">
                                        <span class="text-gray-700 dark:text-gray-400">
                                            Front Image <span class="-ml-1 text-red-500">*</span>
                                        </span>
                                        <img class="w-20 h-20" :src="form_data.front_image">
                                        <input type="file" @change="onImageChange"  class=" block w-full mt-1 text-sm dark:text-gray-300 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-red form-input rounded" placeholder="Product Image"/>
                                    </label>
                                    <label class="block text-sm">
                                        <span class="text-gray-700 dark:text-gray-400">
                                            Back Image <span class="-ml-1 text-red-500">*</span>
                                        </span>
                                        <img class="w-20 h-20" :src="form_data.back_image">
                                        <input type="file" v-on:change="onImageChange1"  class=" block w-full mt-1 text-sm dark:text-gray-300 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-red form-input rounded" placeholder="Product Image"/>
                                    </label>
                                    <label class="block text-sm">
                                        <span class="text-gray-700 dark:text-gray-400">
                                            Left Image <span class="-ml-1 text-red-500">*</span>
                                        </span>
                                        <img class="w-20 h-20" :src="form_data.left_image">
                                        <input type="file" v-on:change="onImageChange2"  class=" block w-full mt-1 text-sm dark:text-gray-300 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-red form-input rounded" placeholder="Product Image"/>
                                    </label>
                                    <label class="block text-sm">
                                        <span class="text-gray-700 dark:text-gray-400">
                                            Right Image <span class="-ml-1 text-red-500">*</span>
                                        </span>
                                        <img class="w-20 h-20" :src="form_data.right_image">
                                        <input type="file" v-on:change="onImageChange3"  class=" block w-full mt-1 text-sm dark:text-gray-300 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-red form-input rounded" placeholder="Product Image"/>
                                    </label>
                                </div>
                                <div class="w-full flex items-center gap-4">
                                    <label class="w-full block text-sm mt-4">
                                        <span class="text-gray-700 dark:text-gray-400"> Specification </span>
                                        <textarea v-model="form_data.specification" required class="block w-full mt-1 text-sm dark:text-gray-300 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-red form-input rounded" placeholder="category description"/>
                                    </label>
                                    <label class="w-full block text-sm mt-4">
                                        <span class="text-gray-700 dark:text-gray-400"> Description </span>
                                        <textarea v-model="form_data.description" required class="block w-full mt-1 text-sm dark:text-gray-300 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-red form-input rounded" placeholder="category description"/>
                                    </label>
                                </div>
                            </div>

                            <div v-if="errors" class="mt-4 px-3 py-2 w-full rounded text-sm text-red-500 bg-red-100 animate-pulse">
                                <p class="font-semibold tracking-wide">
                                    <strong>Error:</strong> {{ errors.message }}
                                </p>
                                <ul class="mt-1 ml-2 list-disc list-inside">
                                    <li v-for="allErrors in errors.errors" :key="allErrors">
                                        <span v-for="errorKeys in allErrors" :key="errorKeys">
                                            <span v-for="errorMessage in errorKeys" :key="errorMessage">
                                                {{ errorMessage }}
                                            </span> 
                                        </span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="flex flex-col items-center justify-end px-6 py-3 -mx-6 -mb-4 space-y-4 sm:space-y-0 sm:space-x-6 sm:flex-row bg-gray-50 dark:bg-gray-800">
                            <button type="submit" :disabled="is_loading" class="w-full sm:w-auto inline-flex items-center justify-center gap-2 flex-none bg-gray-900 hover:bg-gray-700 text-gray-100 text-sm leading-6 font-semibold py-2 px-4 border border-transparent rounded-lg focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-100 focus:ring-black focus:outline-none transition-colors duration-300">
                                <span>Update Product</span> 
                                <span v-if="is_loading">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 animate-spin" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M4 2a1 1 0 011 1v2.101a7.002 7.002 0 0111.601 2.566 1 1 0 11-1.885.666A5.002 5.002 0 005.999 7H9a1 1 0 010 2H4a1 1 0 01-1-1V3a1 1 0 011-1zm.008 9.057a1 1 0 011.276.61A5.002 5.002 0 0014.001 13H11a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0v-2.101a7.002 7.002 0 01-11.601-2.566 1 1 0 01.61-1.276z" clip-rule="evenodd"/>
                                    </svg>
                                </span> 
                            </button>
                            <button @click="closeModal" class="w-full px-5 py-3 text-sm font-medium leading-5 text-gray-700 transition-colors duration-150 border border-gray-300 rounded-lg dark:text-gray-400 sm:px-4 sm:py-2 sm:w-auto active:bg-transparent hover:border-gray-500 focus:border-gray-500 active:text-gray-500 focus:outline-none focus:shadow-outline-gray">
                                Cancel
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
<!-- </div> -->
</template>

<script>
import ProductService from "../../../services/ProductService";
import CategoryService from "../../../services/CategoryService";
import LinkButton from "../../../components/LinkButton.vue";
import env from "../../../config/env";
import Pagination from '../../../components/Pagination.vue';
export default{
    components:{LinkButton, Pagination},

    data() {
        return {
            products_data:[],
            products:[],
            categories:[],
            errors:[],
            form_data:{},
            msg:'',
            path:'http://127.0.0.1:8000/',
            is_modal_open:false,
            update_product:[],
            is_loading:false,
            pagination: {
                dataCount: 4,
                activePage:1,
                total:0
            },
            renderComponent:true,
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
            left_image_preview:'',
        }
    },
    created()
    { 
    this.getproducts();
    this.getcategories();
    this.left_image_preview = this.path + this.form_data.left_image;
    },
     methods:{
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
                };
                reader.readAsDataURL(file);
            },
            openModal(index) {
                this.form_data = this.products[index];
                this.form_data.left_image = this.path + this.form_data.left_image;
                this.form_data.right_image = this.path + this.form_data.right_image;
                this.form_data.front_image = this.path + this.form_data.front_image;
                this.form_data.back_image = this.path + this.form_data.back_image;
                this.is_modal_open = true;
                this.errors = null;
            },
            closeModal() {
                this.getproducts();
                this.form_data = [];
                this.is_modal_open = false;
                this.errors = null;
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
            this.products = this.products_data.slice(start, start+this.pagination.dataCount);
            },
            setActivePage(payload){
            // console.log('Setting Active Page:', payload);
            this.pagination.activePage = payload.page;
            this.paginateItems();
            },
            getproducts()
            {
                ProductService.getProduct()
                .then(response => { 
                    this.msg = response.data.status;
                    this.products_data=response.data.data;
                    this.pagination.total = this.products_data.length;
                    this.paginateItems();
                    this.forceRerender();
                })
                .catch(error => {
                    this.errors=error.response.data;
				})
            },
            getcategories()
            {
                CategoryService.index()
                .then(response => {
                    this.categories = response.data.categories;	
                }).catch(response => {
                    console.log(response);
                });
            },
            updateProduct(form_data)
            {
                this.is_loading=true
                ProductService.updateProduct(this.form_data.id,form_data)
                .then(response => {
                    this.is_loading=false
                    this.closeModal();
                })
                .catch(error => {
					 this.is_loading=false
                    let data = error.response.data
                    console.log(data)
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