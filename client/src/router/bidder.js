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
    }]
}, ];