<template>
<div class="container mx-auto " data-theme="cupcake">
    <NavBar/>
    <div class="grid grid-cols-4 gap-4">
        <div class="grid grid-cols-1 gap-4">
            <div class="py-4 artboard artboard-demo bg-base-200 bg-neutral-content shadow-lg">
                <ul class="menu py-3 shadow-lg bg-base-100 rounded-box w-9/12">
                    <li class="menu-title">
                         <span>
                            Categories
                        </span>
                    </li>
                    <li>
                    <a>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="inline-block w-5 h-5 mr-2 stroke-current">          
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"></path>                
                        </svg>
                            Category 1
                    </a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="col-span-3 py-4 artboard artboard-demo bg-base-200 bg-neutral-content shadow-lg">
            <div class="grid grid-cols-3 gap-4 ">
                <!-- Auction Items -->
            </div>
        </div>
    </div>
</div>
</template>
<script>
import NavBar from '../../components/Visitor/Navbar.vue';

export default {
    name: 'CategorisedProducts',
    data() {
        return {
            
        }
    },
    components:{
        NavBar
    }
}
</script>