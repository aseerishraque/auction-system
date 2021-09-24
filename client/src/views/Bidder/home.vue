<template>
<div>
    
    <suspense>
        <template #default>
            <HomeIndex/>
        </template>
        <template #fallback> 
            <HomeIndexSkeleton/>
        </template>
    </suspense>
</div>
</template>

<script setup>
import HomeIndex from "../../components/Bidder/Index.vue";
import HomeIndexSkeleton from "../../components/Bidder/IndexSkeleton.vue";
import { useRouter } from "vue-router";
if(Store.state.currentUser === null)
{
	useRouter().push({ name:'auth.login' });
}

</script>
