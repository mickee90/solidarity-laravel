import Vue from "vue";
import VueRouter from "vue-router";

import Home from "../views/Home.vue";
import NeedHelp from "../views/NeedHelp.vue";
import NeedHelpShow from "../views/NeedHelpShow.vue";
import CanHelp from "../views/CanHelp.vue";
import CanHelpShow from "../views/CanHelpShow.vue";
import Register from "../views/Register.vue";
import Profile from "../views/Profile.vue";
import Login from "../views/Login.vue";
import ContactUs from "../views/ContactUs.vue";
import EditPost from "../views/EditPost.vue";
import CreatePost from "../views/CreatePost.vue";

Vue.use(VueRouter);

const routes = [
  {
    path: "/",
    name: "Home",
    component: Home,
  },
  {
    path: "/:city_id/need-help",
    name: "NeedHelp",
    component: NeedHelp,
  },
  {
    path: "/:city_id/need-help-show/:postId",
    name: "NeedHelpShow",
    component: NeedHelpShow,
  },
  {
    path: "/:city_id/can-help",
    name: "CanHelp",
    component: CanHelp,
  },
  {
    path: "/:city_id/can-help-show/:postId",
    name: "CanHelpShow",
    component: CanHelpShow,
  },
  {
    path: "/login",
    name: "Login",
    component: Login,
  },
  {
    path: "/register",
    name: "Register",
    component: Register,
  },
  {
    path: "/profile",
    name: "Profile",
    component: Profile,
  },
  {
    path: "/edit-post/:postId",
    name: "EditPost",
    component: EditPost,
  },
  {
    path: "/create-post",
    name: "CreatePost",
    component: CreatePost,
  },
  {
    path: "/contact-us",
    name: "ContactUs",
    component: ContactUs,
  },
];

const router = new VueRouter({
  mode: "history",
  base: process.env.MIX_BASE_URL,
  routes,
});

export default router;
