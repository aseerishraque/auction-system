const ROLE = "bidder";

export default [{
    path: "/bidder",
    component: () =>
        import ("../views/Layout/main.vue"),
    meta: { requiresAuth: true, role: ROLE },
    redirect: { name: "bidder.home" },
    children: [{
        path: "dashboard",
        name: "bidder.home",
        component: () =>
            import ("../views/Bidder/home.vue"),
    },
    {
        path: "edit-profile",
        name: "bidder.profile.edit",
        component: () =>
            import ("../views/Bidder/editProfile.vue"),
    },
    {
        path: "bidding-history",
        name: "bidder.bids",
        component: () =>
            import ("../views/Bidder/bids.vue"),
    },
    {
        path: "my-products",
        name: "bidder.products",
        component: () =>
            import ("../views/Bidder/products.vue"),
    }
    
]
}, ];