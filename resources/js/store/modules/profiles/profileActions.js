import axios from "../../../axios/axios";

export const actions = {
  async storeProfile({ commit, rootGetters }, data) {
    const response = await axios
      .post(`/profiles.json`, data)
      .then((res) => res.data);

    if (!response) return;

    commit("storeProfile", response);

    return true;
  },

  async editProfile({ commit, getters, rootGetters }, updatedProfile) {
    const user = rootGetters['profile/getProfile'];

    const response = await axios
      .put(`/api/v1/user/${user.id}`, {
        ...updatedProfile,
      })
      .then((res) => res.data);

    if (!response) return;

    commit("storeProfile", response);

    return true;
  },

  editAvatar({ commit, rootGetters }, avatar) {
    const user = rootGetters['profile/getProfile'];

    const profile = { ...user, avatar };

    commit("editProfile", profile, { root: true });
  },
};
