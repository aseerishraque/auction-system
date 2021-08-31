import { createRouter, createWebHistory } from "vue-router";
import AuthRoutes from "./auth";
import AdminRoutes from "./admin";
import BidderRoutes from "./bidder";
import VisitorRoutes from "./visitor";

const router = createRouter({
    history: createWebHistory(),
    routes: [
        ...VisitorRoutes,
        ...AuthRoutes,
        ...AdminRoutes,
        ...BidderRoutes,
        {
            path: "/:pathMatch(.*)*",
            name: "error.404",
            component: () =>
                import ("../views/error/404.vue"),
        },
    ],
});

// middleware
router.beforeEach((to, from, next) => {
    const USER = Store.getters.getCurrentUser;
    const ROLE = USER ? USER.role : null;
    const IS_LOGGED_IN = USER ? true : false;

    if (to.meta.requiresAuth) {
        if (IS_LOGGED_IN && to.meta.role === USER.role) next();
        else next({ name: "auth.login" });
    } else {
        if (IS_LOGGED_IN && (to.name === "auth.login" || to.name === "auth.register")) {
            if (ROLE === "admin") router.push({ name: "admin.home" });
            else if (ROLE === "bidder") router.push({ name: "bidder.home" });

        } else
            next();
    }
});
export default router;