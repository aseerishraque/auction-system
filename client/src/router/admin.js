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
                import (PATH + "home.vue"),
        },
        {
            path: "categories",
            name: "admin.category.index",
            component: () =>
                import (PATH + "Category/index.vue"),
        },
        {
            path: "categories/create",
            name: "admin.category.create",
            component: () =>
                import (PATH + "Category/create.vue"),
        },
        {
            path: "product",
            name: "admin.product.index",
            component: () =>
                import (PATH + "Product/index.vue"),
        },
        {
            path: "product/create",
            name: "admin.product.create",
            component: () =>
                import (PATH + "Product/create.vue"),
        },
        {
            path: "auction",
            name: "admin.auction.past",
            component: () =>
                import (PATH + "Auction/Past.vue"),
        },
        {
            path: "auction",
            name: "admin.auction.running",
            component: () =>
                import (PATH + "Auction/Running.vue"),
        },
        {
            path: "auction",
            name: "admin.auction.upcoming",
            component: () =>
                import (PATH + "Auction/Upcoming.vue"),
        },
        {
            path: "auction/create",
            name: "admin.auction.create",
            component: () =>
                import (PATH + "Auction/create.vue"),
        },
        {
            path: "auction/details/:id",
            name: "admin.auction.details",
            component: () =>
                import (PATH + "Auction/Details.vue"),
        },
    ]
}, ];