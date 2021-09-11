export default [{
    path: "/",
    name: "visitor.home",
    component: () =>
        import ("../views/Visitor/home.vue"),
},
{
    path: "/product/:id",
    name: "visitor.product",
    component: () =>
        import ("../views/Visitor/product.vue"),
}, 
];