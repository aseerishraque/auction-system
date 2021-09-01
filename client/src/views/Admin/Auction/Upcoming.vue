<template>
<div>
    <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">Upcoming Auctions </h2>
        <!-- <div class="bg-gray-500 pt-3">
            <div class="rounded-tl-4xl bg-gradient-to-r from-blue-400 to-gray-400 p-4 shadow text-2xl text-white">
                <h3 class="font-bold pl-2">Upcoming Auctions</h3>
            </div>
        </div> -->
    <div class="mb-4">
        <link-button to="admin.auction.create" name="Add Auction">Add Auction</link-button>
    </div>
    <suspense>
        <template #default>
            <AuctionIndex/>
        </template>
        <template #fallback>
            <AuctionIndexSkeleton/>
        </template>
    </suspense>
</div>
</template>

<script setup>
import AuctionIndex from "../../../components/Admin/Auction/Upcoming/Index.vue";
import AuctionIndexSkeleton from "../../../components/Admin/Auction/Upcoming/IndexSkeleton.vue";
import LinkButton from "../../../components/LinkButton.vue";
</script>