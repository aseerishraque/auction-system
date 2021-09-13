<template>
<div>
    <div class="navbar mb-2 shadow-lg bg-neutral text-neutral-content rounded-box">
        <div class="px-2 mx-2 navbar-start">
            <router-link :to="{name: 'visitor.home'}">
                <span class="text-lg font-bold">
                    Auction
                </span>
            </router-link>  
        </div> 
        <div class="hidden px-2 mx-2 navbar-center lg:flex">
            <div class="flex items-stretch">
            <!-- <a class="btn btn-ghost btn-sm rounded-btn">
                    Home
                    </a> 
            <a class="btn btn-ghost btn-sm rounded-btn">
                    Portfolio
                    </a> 
            <a class="btn btn-ghost btn-sm rounded-btn">
                    About
                    </a> 
            <a class="btn btn-ghost btn-sm rounded-btn">
                    Contact
                    </a> -->
            </div>
        </div> 
        <div class="navbar-end">
            <!-- <button class="btn btn-square btn-ghost">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="inline-block w-6 h-6 stroke-current">     
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>                     
            </svg>
            </button> 
            <button class="btn btn-square btn-ghost">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="inline-block w-6 h-6 stroke-current">             
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>             
            </svg>
            </button> -->
            <router-link v-if="is_logged_in" :to="{name: homeRoute}">
                <button class="btn btn-info rounded-md mr-10 text-white">Dashboard</button> 
            </router-link>
            <router-link v-if="!is_logged_in" :to="{name: 'auth.register'}">
                <button class="btn btn-info rounded-md mr-5 text-white">Sign Up</button> 
            </router-link>
            <router-link v-if="!is_logged_in" :to="{name: 'auth.login'}">
                <button class="btn btn-info rounded-md mr-10 text-white">Login</button> 
            </router-link>
            <button @click.prevent="logout" v-else class="btn btn-accent rounded-md mr-10 text-white">Log Out</button> 
            
        </div>
    </div>
</div>
</template>
<script>
export default {
    data() {
        return {
            is_logged_in:false,
            homeRoute: ''
        }
    },
    created() {
        if(Store.state.currentUser !== null)
        {
            this.is_logged_in = true;
            if(Store.state.currentUser.role === 'admin')
            {
                this.homeRoute = 'admin.home';
            }else{
                this.homeRoute = 'bidder.home';
            }
        }else{
            this.is_logged_in = false;
        }
    },
    methods: {
        logout() {
            Store
                .dispatch("logout")
                .then(() => {
                    this.$router.push({name: 'auth.login'});
                })
                .catch((error) => {
                    alert(error);
                });
        }
    },
}
</script>