<template>
<div class="main-content flex-1 bg-gray-100 mt-12 md:mt-2 pb-24 md:pb-5">

            <div class="bg-white-800 pt-3">
                <div class="rounded-tl-4xl bg-gradient-to-r from-white-400 to-white-600 p-4 shadow text-2xl text-white">
                    <h3 class="font-bold pl-2"></h3>
                </div>
            </div>
   
            <div class="flex flex-wrap">
                <div class="w-full md:w-1/2 xl:w-1/3 p-6">
                    <!--Metric Card-->
                    <div class="bg-gradient-to-b from-white-200 to-white-100 border-b-4 border-white-400 rounded-lg shadow-xl p-5">
                        <div class="flex flex-row items-center">
                            <div class="flex-shrink pr-4">
                                <div class="rounded-full p-5 bg-white-600"><i class="fa fa-wallet fa-2x fa-inverse"></i></div>
                            </div>
                            <div class="flex-1 text-right md:text-center">
                                <h5 class="font-bold uppercase text-gray-600"></h5>
                                <!-- <h3 class="font-bold text-3xl"><span class="text-green-500"><i class="fas fa-caret-up"></i></span></h3> -->
                            </div>
                        </div>
                    </div>
                    <!--/Metric Card-->
                </div>
                <div class="w-full md:w-1/2 xl:w-1/3 p-6">
                    <!--Metric Card-->
                    <div class="bg-gradient-to-b from-white-200 to-white-100 border-b-4 border-white-500 rounded-lg shadow-xl p-5">
                        <div class="flex flex-row items-center">
                            <div class="flex-shrink pr-4">
                                <div class="rounded-full p-5 bg-white-600"><i class="fas fa-users fa-2x fa-inverse"></i></div>
                            </div>
                            <div class="flex-1 text-right md:text-center">
                                <h5 class="font-bold uppercase text-gray-600"></h5>
                                <!-- <h3 class="font-bold text-3xl"><span class="text-pink-500"><i class="fas fa-exchange-alt"></i></span></h3> -->
                            </div>
                        </div>
                    </div>
                    <!--/Metric Card-->
                </div>
                <div class="w-full md:w-1/2 xl:w-1/3 p-6">
                    <!--Metric Card-->
                    <div class="bg-gradient-to-b from-white-200 to-white-100 border-b-4 border-white-500 rounded-lg shadow-xl p-5">
                        <div class="flex flex-row items-center">
                            <div class="flex-shrink pr-4">
                                <div class="rounded-full p-5 bg-white-600"><i class="fas fa-tasks fa-2x fa-inverse"></i></div>
                            </div>
                            <div class="flex-1 text-right md:text-center">
                                <h5 class="font-bold uppercase text-gray-600"></h5>
                                <h3 class="font-bold text-3xl"></h3>
                            </div>
                        </div> 
                    </div>
                    <!--/Metric Card-->
                </div>
               
            </div>
        </div>
        <div class="bg-white-800 pt-3">
                <div class="rounded-tl-3xl bg-gradient-to-r from-white-400 to-white-900 p-4 shadow text-2xl text-white">
                    <h3 class="font-bold pl-2 text-center"></h3>
                </div>
            </div>
	<div class="w-full overflow-hidden rounded-lg shadow-xs">
		<div class="w-full overflow-x-auto">
            <table class="table w-full table-zebra">
                <thead>
                <tr>
                    <th>SL</th> 
                    <th>Product</th> 
                    <th>Result Time</th> 
                    <th>Winner Bid</th>
                    <th>Delivered</th>
                </tr>
                </thead> 
                <tbody>
                <tr v-for="i in 5" :key="i">
                    
                    <td>
                        <div class="flex items-center text-sm">
                            <div class="flex flex-col gap-1">
                                <div class="w-10 h-3 bg-gray-200 dark:bg-gray-500 animate-pulse"></div>
                            </div>
                        </div>
                    </td> 
                    <td>
                        <div class="flex items-center text-sm">
                            <div class="flex flex-col gap-1">
                                <div class="w-16 h-3 bg-gray-200 dark:bg-gray-500 animate-pulse"></div>
                            </div>
                        </div>
                    </td> 
                    <td>
                        <div class="flex items-center text-sm">
                            <div class="flex flex-col gap-1">
                                <div class="w-16 h-3 bg-gray-200 dark:bg-gray-500 animate-pulse"></div>
                            </div>
                        </div>
                    </td> 
                    <td>
                        <div class="flex items-center text-sm">
                            <div class="flex flex-col gap-1">
                                <div class="w-16 h-3 bg-gray-200 dark:bg-gray-500 animate-pulse"></div>
                            </div>
                        </div>
                    </td> 
                    <td>
                        <div class="flex items-center text-sm">
                            <div class="flex flex-col gap-1">
                                <div class="w-16 h-3 bg-gray-200 dark:bg-gray-500 animate-pulse"></div>
                            </div>
                        </div>
                    </td> 
                </tr>
                </tbody>
            </table>
		</div>
	</div>
</template>