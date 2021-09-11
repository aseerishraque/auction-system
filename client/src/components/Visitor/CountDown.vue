<template>
<div class="mt-10 grid grid-flow-col gap-5 text-center auto-cols-max">
    <div class="flex flex-col p-2 bg-neutral rounded-box text-neutral-content">
        <span class="font-mono text-5xl countdown">
        <span :style="'--value:'+timer.days.value"></span>
        </span>
            days 
        
    </div> 
    <div class="flex flex-col p-2 bg-neutral rounded-box text-neutral-content">
        <span class="font-mono text-5xl countdown">
        <span :style="'--value:'+timer.hours.value"></span>
        </span>
            hours
        
    </div> 
    <div class="flex flex-col p-2 bg-neutral rounded-box text-neutral-content">
        <span class="font-mono text-5xl countdown">
        <span :style="'--value:'+timer.minutes.value"></span>
        </span>
            min 
        
    </div> 
    <div class="flex flex-col p-2 bg-neutral rounded-box text-neutral-content">
        <span class="font-mono text-5xl countdown">
        <span :style="'--value:'+timer.seconds.value"></span>
        </span>
            sec
        
    </div>
</div>
</template>
<script>
import {  watchEffect, onMounted } from "vue";
import { useTimer } from 'vue-timer-hook';
export default {
    props:{
        dateTime: String
    },
    setup(props){
         const time =  new Date(props.dateTime);
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
}
</script>