<template>
    
<div class="overflow-x-auto">
  <table class="table w-full">
    <thead>
      <tr>
        <th>SL</th>
        <th>Name</th> 
        <th>Vat</th> 
        <th>Account</th> 
        <th>Details</th>
        <th>
            Approved
        </th>
        <th>Action</th>
      </tr>
    </thead> 
    <tbody>
      <tr v-for="i in 5" :key="i">
        <td>
          <div class="w-10 h-5 bg-gray-200 dark:bg-gray-500 animate-pulse"></div>
        </td>
        <td>
          <div class="w-10 h-5 bg-gray-200 dark:bg-gray-500 animate-pulse"></div>
        </td> 
        <td>
            <div class="w-10 h-5 bg-gray-200 dark:bg-gray-500 animate-pulse"></div>
        </td>
        <td>
            <div class="w-10 h-5 bg-gray-200 dark:bg-gray-500 animate-pulse"></div>
        </td> 
        <th>
            <div class="w-10 h-5 bg-gray-200 dark:bg-gray-500 animate-pulse"></div>
        </th>
        <td>
            <div class="w-10 h-5 bg-gray-200 dark:bg-gray-500 animate-pulse"></div>
        </td>
        <td class="px-4 py-3 text-xs">
            <div class="w-10 h-5 bg-gray-200 dark:bg-gray-500 animate-pulse"></div>
        </td>
      </tr>
    </tbody> 
    <tfoot>
      <tr>
        <th>SL</th>
        <th>Name</th> 
        <th>Vat</th> 
        <th>Account</th> 
        <th>Details</th>
        <th>
            Approved
        </th> 
        <th>Action</th>
      </tr>
    </tfoot>
  </table>
</div>
</template>
<script>
export default {
    name: 'BidderIndexSkeleton'
}
</script>