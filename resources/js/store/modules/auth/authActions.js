import axios from "../../../axios/axios";

import router from "../../../router/index";

export const actions = {
  async register({ commit, dispatch }, payload) {
    const response = await axios
        .post("/api/v1/register", payload)
        .then((res) => res.data)
        .catch((err) => alert(err.message));

    if (!response) return false;

    commit("authToken", response.token);

    await commit("profile/storeProfile", { ...response.user, token: response.token }, { root: true });
    await commit("setCityId", response.city_id, { root: true });

    router.push({name: "Profile"});
  },

  async login({ commit, dispatch }, payload) {
    const response = await axios
        .post("/api/v1/login", {
          username: payload.username,
          password: payload.password,
        })
        .then((res) => res.data)
        .catch((err) => alert(err.message));

    if (!response) return false;

    commit("authToken", response.token);

    console.log(response);

    await commit("profile/storeProfile", { ...response.user, token: response.token }, { root: true });
    await commit("setCityId", response.user.city_id, { root: true });

    await dispatch("post/fetchPost", null, { root: true });
    router.push({name: "Profile"});
  },

  async changePassword({ commit, dispatch }, payload) {
    const response = await axios
        .put("/api/v1/user/updatePassword", {
          password: payload.password,
          password_confirmation: payload.password_confirmation,
        })
        .then((res) => res.data)
        .catch((err) => alert(err.message));

    if (!response) return;

    return true;
  },

  logout({ dispatch }) {
    dispatch("resetAllStates", null, { root: true });

    router.push({name: "Login"});
  },

};
