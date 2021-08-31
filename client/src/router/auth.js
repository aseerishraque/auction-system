export default [{
        path: "/login",
        name: "auth.login",
        component: () =>
            import ("../views/Auth/login.vue"),
    },
    {
        path: "/register",
        name: "auth.register",
        component: () =>
            import ("../views/Auth/register.vue"),
    },
];