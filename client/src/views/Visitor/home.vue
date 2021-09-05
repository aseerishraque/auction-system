<template>
<div class="container mx-auto">
    <!-- NavBar Start -->
    <div class="navbar mb-2 shadow-lg bg-neutral text-neutral-content rounded-box">
    <div class="px-2 mx-2 navbar-start">
        <span class="text-lg font-bold">
                Auction
            </span>
    </div> 
    <div class="hidden px-2 mx-2 navbar-center lg:flex">
        <div class="flex items-stretch">
        <a class="btn btn-ghost btn-sm rounded-btn">
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
                </a>
        </div>
    </div> 
    <div class="navbar-end">
        <button class="btn btn-square btn-ghost">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="inline-block w-6 h-6 stroke-current">     
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>                     
        </svg>
        </button> 
        <button class="btn btn-square btn-ghost">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="inline-block w-6 h-6 stroke-current">             
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>             
        </svg>
        </button>
    </div>
    </div>
    <!-- NavBar END -->
<!-- Carousel start -->
    <div class="carousel relative shadow-2xl bg-white rounded-box">
        <div class="carousel-inner relative overflow-hidden w-full">
        <!--Slide 1-->
            <input class="carousel-open" type="radio" id="carousel-1" name="carousel" aria-hidden="true" hidden="" checked="checked">
            <div class="carousel-item absolute opacity-0" style="height:50vh;">
                <div class="block h-full w-full bg-indigo-500 text-white text-5xl text-center">
                    <img src="https://picsum.photos/1000/260" class="w-screen">
                </div>
            </div>
            <label for="carousel-3" class="prev control-1 w-10 h-10 ml-2 md:ml-10 absolute cursor-pointer hidden text-3xl font-bold text-black hover:text-white rounded-full bg-white hover:bg-blue-700 leading-tight text-center z-10 inset-y-0 left-0 my-auto">‹</label>
            <label for="carousel-2" class="next control-1 w-10 h-10 mr-2 md:mr-10 absolute cursor-pointer hidden text-3xl font-bold text-black hover:text-white rounded-full bg-white hover:bg-blue-700 leading-tight text-center z-10 inset-y-0 right-0 my-auto">›</label>
            
            <!--Slide 2-->
            <input class="carousel-open" type="radio" id="carousel-2" name="carousel" aria-hidden="true" hidden="">
            <div class="carousel-item absolute opacity-0" style="height:50vh;">
                <div class="block h-full w-full bg-orange-500 text-white text-5xl text-center">
                    <img src="https://picsum.photos/1000/280" class="w-screen">
                </div>
            </div>
            <label for="carousel-1" class="prev control-2 w-10 h-10 ml-2 md:ml-10 absolute cursor-pointer hidden text-3xl font-bold text-black hover:text-white rounded-full bg-white hover:bg-blue-700 leading-tight text-center z-10 inset-y-0 left-0 my-auto">‹</label>
            <label for="carousel-3" class="next control-2 w-10 h-10 mr-2 md:mr-10 absolute cursor-pointer hidden text-3xl font-bold text-black hover:text-white rounded-full bg-white hover:bg-blue-700 leading-tight text-center z-10 inset-y-0 right-0 my-auto">›</label> 
            
            <!--Slide 3-->
            <input class="carousel-open" type="radio" id="carousel-3" name="carousel" aria-hidden="true" hidden="">
            <div class="carousel-item absolute opacity-0" style="height:50vh;">
                <div class="block h-full w-full bg-green-500 text-white text-5xl text-center">
                    <img src="https://picsum.photos/1000/270" class="w-screen">
                </div>
            </div>
            <label for="carousel-2" class="prev control-3 w-10 h-10 ml-2 md:ml-10 absolute cursor-pointer hidden text-3xl font-bold text-black hover:text-white rounded-full bg-white hover:bg-blue-700 leading-tight text-center z-10 inset-y-0 left-0 my-auto">‹</label>
            <label for="carousel-1" class="next control-3 w-10 h-10 mr-2 md:mr-10 absolute cursor-pointer hidden text-3xl font-bold text-black hover:text-white rounded-full bg-white hover:bg-blue-700 leading-tight text-center z-10 inset-y-0 right-0 my-auto">›</label>

            <!-- Add additional indicators for each slide-->
            <ol class="carousel-indicators">
                <li class="inline-block mr-3">
                    <label for="carousel-1" class="carousel-bullet cursor-pointer block text-4xl text-white hover:text-blue-700">•</label>
                </li>
                <li class="inline-block mr-3">
                    <label for="carousel-2" class="carousel-bullet cursor-pointer block text-4xl text-white hover:text-blue-700">•</label>
                </li>
                <li class="inline-block mr-3">
                    <label for="carousel-3" class="carousel-bullet cursor-pointer block text-4xl text-white hover:text-blue-700">•</label>
                </li>
            </ol>
            
        </div>
    </div>
<!-- Carousel END -->
<!-- Featured Section Start -->
    <h1 class="text-3xl mt-10">Featured Section</h1>
    <div class="grid grid-cols-3 gap-3">
        <div class="card bordered">
        <figure>
            <img src="https://picsum.photos/id/1005/400/250">
        </figure> 
        <div class="card-body">
            <h2 class="card-title">Title
            <div class="badge mx-2 badge-primary">NEW</div>
            </h2> 
            <div class="grid grid-cols-3">
                
            <div class="avatar">
                <div class="bg-gray-100 text-lg mb-8 w-16 h-16 ring ring-gray-200 ring-offset-base-100 ring-offset-2 text-center item-center">
                    00 Hr
                </div>
            </div> 
            <div class="avatar">
                <div class="bg-gray-100 text-lg mb-8 w-16 h-16 ring ring-gray ring-offset-base-100 ring-offset-2 text-center item-center">
                00 Min
                </div>
            </div> 
            <div class="avatar">
                <div class="bg-gray-100 text-lg mb-8 w-16 h-16 ring ring-gray ring-offset-base-100 ring-offset-2 text-center item-center">
                    00 Sec
                </div>
            </div> 

            </div>
            <div class="justify-end card-actions">
            <button class="btn btn-primary">More info</button>
            </div>
        </div>
        </div> 
        <div class="card bordered">
        <figure>
            <img src="https://picsum.photos/id/1005/400/250">
        </figure> 
        <div class="card-body">
            <h2 class="card-title">Title
            <div class="badge mx-2 badge-secondary">NEW</div>
            </h2> 
            <div class="grid grid-cols-3">
                
            <div class="avatar">
                <div class="bg-gray-100 text-lg mb-8 w-16 h-16 ring ring-gray ring-offset-base-100 ring-offset-2 text-center item-center">
                    00 Hr
                </div>
            </div> 
            <div class="avatar">
                <div class="bg-gray-100 text-lg mb-8 w-16 h-16 ring ring-gray ring-offset-base-100 ring-offset-2 text-center item-center">
                00 Min
                </div>
            </div> 
            <div class="avatar">
                <div class="bg-gray-100 text-lg mb-8 w-16 h-16 ring ring-gray ring-offset-base-100 ring-offset-2 text-center item-center">
                    00 Sec
                </div>
            </div> 

            </div>
            <div class="justify-end card-actions">
            <button class="btn btn-primary">More info</button>
            </div>
        </div>
        </div> 
               <div class="card bordered">
        <figure>
            <img src="https://picsum.photos/id/1005/400/250">
        </figure> 
        <div class="card-body">
            <h2 class="card-title">Title
            <div class="badge mx-2 badge-secondary">NEW</div>
            </h2> 
            <div class="grid grid-cols-3">
                
            <div class="avatar">
                <div class="bg-gray-100 text-lg mb-8 w-16 h-16 ring ring-gray ring-offset-base-100 ring-offset-2 text-center item-center">
                    00 Hr
                </div>
            </div> 
            <div class="avatar">
                <div class="bg-gray-100 text-lg mb-8 w-16 h-16 ring ring-gray ring-offset-base-100 ring-offset-2 text-center item-center">
                00 Min
                </div>
            </div> 
            <div class="avatar">
                <div class="bg-gray-100 text-lg mb-8 w-16 h-16 ring ring-gray ring-offset-base-100 ring-offset-2 text-center item-center">
                    00 Sec
                </div>
            </div> 

            </div>
            <div class="justify-end card-actions">
            <button class="btn btn-secondary">More info</button>
            </div>
        </div>
        </div> 
    </div>
<!-- Featured Section END -->
</div>
</template>


<style scoped>
			.carousel-open:checked + .carousel-item {
				position: static;
				opacity: 100;
			}
			.carousel-item {
				-webkit-transition: opacity 0.6s ease-out;
				transition: opacity 0.6s ease-out;
			}
			#carousel-1:checked ~ .control-1,
			#carousel-2:checked ~ .control-2,
			#carousel-3:checked ~ .control-3 {
				display: block;
			}
			.carousel-indicators {
				list-style: none;
				margin: 0;
				padding: 0;
				position: absolute;
				bottom: 2%;
				left: 0;
				right: 0;
				text-align: center;
				z-index: 10;
			}
			#carousel-1:checked ~ .control-1 ~ .carousel-indicators li:nth-child(1) .carousel-bullet,
			#carousel-2:checked ~ .control-2 ~ .carousel-indicators li:nth-child(2) .carousel-bullet,
			#carousel-3:checked ~ .control-3 ~ .carousel-indicators li:nth-child(3) .carousel-bullet {
				color: #2b6cb0;  /*Set to match the Tailwind colour you want the active one to be */
			}
</style>