<template>
<div class="card bordered shadow-lg">
    <figure class="">
        <!-- <img src="https://picsum.photos/id/1005/400/250"> -->
        <img :src="front_image" class="object-contain h-36 w-full">
    </figure> 
    <div class="card-body">
        <h2 class="card-title">{{ product_name }}
        <!-- <div class="badge mx-2 badge-primary">NEW</div> -->
        </h2> 
        <div v-if="type === 1" class="grid grid-flow-col gap-5 text-center auto-cols-max">
            <div class="flex flex-col p-2 bg-neutral rounded-box text-neutral-content">
                <span class="font-mono text-2xl countdown">
                <span :style="'--value:'+timer.days.value"></span>
                </span>
                    days 
                
            </div> 
            <div class="flex flex-col p-2 bg-neutral rounded-box text-neutral-content">
                <span class="font-mono text-2xl countdown">
                <span :style="'--value:'+timer.hours.value"></span>
                </span>
                    hrs
                
            </div> 
            <div class="flex flex-col p-2 bg-neutral rounded-box text-neutral-content">
                <span class="font-mono text-2xl countdown">
                <span :style="'--value:'+timer.minutes.value"></span>
                </span>
                    min 
                
            </div> 
            <div class="flex flex-col p-2 bg-neutral rounded-box text-neutral-content">
                <span class="font-mono text-2xl countdown">
                <span :style="'--value:'+timer.seconds.value"></span>
                </span>
                    sec
                
            </div>
        </div>
        <span v-if="type === 2"> <b> Start Time:</b> {{ start_time }}</span>
        <span> <b> Base Price:</b> {{ base_price }}</span>
        <span> <b>Required Balance:</b> {{ expected_value*(percentage/100) }}</span>
        <div class="justify-end card-actions">
        <router-link :to="{name: 'visitor.product', params: {id: id, type: routeParam}}">
            <button class="btn btn-primary btn-sm">More info</button>
        </router-link>
        </div>
    </div>
</div>
</template>

<script>
import {  watchEffect, onMounted } from "vue";
import { useTimer } from 'vue-timer-hook';

export default {
    props: {
        expiryDate: String,
        product_name: String,
        front_image: String,
        id: Number,
        base_price: Number,
        expected_value: Number,
        percentage: Number,
        type: Number,
        routeParam: Number,
        start_time: String
    },
    setup(props){
        const time = new Date(props.expiryDate);
        // time.setSeconds(time.getSeconds() + 600); // 10 minutes timer
        const timer = useTimer(time);
        onMounted(() => {
        watchEffect(async () => {
            if(timer.isExpired.value) {
                console.warn('IsExpired')
            }
        })
        })
        return {
            timer
        }
    },
    created() {
        // console.log(this.expiryDate)
    },
    
}
</script>