export default [{
    path: "/",
    name: "visitor.home",
    component: () =>
        import ("../views/Visitor/home.vue"),
},
{
    path: "/product/:id/:type?",
    name: "visitor.product",
    component: () =>
        import ("../views/Visitor/product.vue"),
},
{
    path: "/categorised-products",
    name: "visitor.product.categorised",
    component: () =>
        import ("../views/Visitor/categorised.vue"),
}, 
];