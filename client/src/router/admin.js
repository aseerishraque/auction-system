const ROLE = "admin";
const PATH = "../views/Admin/";

export default [{
    path: "/admin",
    component: () =>
        import ("../views/Layout/main.vue"),
    meta: { requiresAuth: true, role: ROLE },
    redirect: { name: "admin.home" },
    children: [{
            path: "dashboard",
            name: "admin.home",
            component: () =>
                import ( /* @vite-ignore */PATH + "home.vue"),
        },
        {
            path: "categories",
            name: "admin.category.index",
            component: () =>
                import (/* @vite-ignore */PATH + "Category/index.vue"),
        },
        {
            path: "categories/create",
            name: "admin.category.create",
            component: () =>
                import (/* @vite-ignore */PATH + "Category/create.vue"),
        },
        {
            path: "product",
            name: "admin.product.index",
            component: () =>
                import (/* @vite-ignore */PATH + "Product/index.vue"),
        },
        {
            path: "product/create",
            name: "admin.product.create",
            component: () =>
                import (/* @vite-ignore */PATH + "Product/create.vue"),
        },
        {
            path: "auction/past",
            name: "admin.auction.past",
            component: () =>
                import (/* @vite-ignore */PATH + "Auction/Past.vue"),
        },
        {
            path: "auction/running",
            name: "admin.auction.running",
            component: () =>
                import (/* @vite-ignore */PATH + "Auction/Running.vue"),
        },
        {
            path: "auction/upcoming",
            name: "admin.auction.upcoming",
            component: () =>
                import (/* @vite-ignore */PATH + "Auction/Upcoming.vue"),
        },
        {
            path: "auction/create",
            name: "admin.auction.create",
            component: () =>
                import (/* @vite-ignore */PATH + "Auction/create.vue"),
        },
        {
            path: "auction/details/:id",
            name: "admin.auction.details",
            component: () =>
                import (/* @vite-ignore */PATH + "Auction/Details.vue"),
        },
        {
            path: "bidders",
            name: "admin.bidders.index",
            component: () =>
                import (/* @vite-ignore */PATH + "Bidders/index.vue"),
        },
        {
            path: "bidders/update-info/:id",
            name: "admin.bidders.update",
            component: () =>
                import (/* @vite-ignore */PATH + "Bidders/update.vue"),
        },
    ]
}, ];