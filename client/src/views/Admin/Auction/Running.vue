<template>
    <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">Running Auctions </h2>
            <!-- <div class="bg-gray-500 pt-3">
                <div class="rounded-tl-4xl bg-gradient-to-r from-blue-400 to-gray-400 p-4 shadow text-2xl text-white">
                    <h3 class="font-bold pl-2">Running Auctions</h3>
                </div>
            </div> -->
    <suspense>
        <template #default>
            <AuctionIndex/>
        </template>
        <template #fallback>
            <AuctionIndexSkeleton/>
        </template>
    </suspense>
</template>

<script setup>
import AuctionIndex from "../../../components/Admin/Auction/Running/Index.vue";
import AuctionIndexSkeleton from "../../../components/Admin/Auction/Running/IndexSkeleton.vue";
import LinkButton from "../../../components/LinkButton.vue";
</script>