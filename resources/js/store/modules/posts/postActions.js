import axios from "../../../axios/axios";

export const actions = {
  async storePost({ rootGetters, commit }, data) {
    const profile = rootGetters["profile/getProfile"];

    let post = { ...data, user_id: profile.id, city_id: profile.city_id };

    const response = await axios
      .post(`/api/v1/createPost`, post)
      .then((res) => res.data);

    if (!response) return;

    post = { ...response };
    commit("storePost", post);

    return true;
  },

  async editPost({ commit, getters, rootGetters }, data) {
    const response = await axios
      .put(`/api/v1/post/${data.id}/update`, {
        ...data,
      })
      .then((res) => res.data);

    if (!response) return;

    commit("storePost", response);

    return true;
  },

  async fetchPost({ commit, rootGetters }) {
    const user = rootGetters['profile/getProfile'];

    const response = await axios
      .get(`/api/v1/user/${user.id}/post`)
      .then((res) => res.data);

    if (!response) return;

    await commit("storePost", response);

    return true;
  },

  async fetchSinglePost({}, postId) {
    console.log('fetchSinglePost', postId);

    const response = await axios
      .get(`/api/v1/post/${postId}`)
      .then((res) => res.data);

    console.log('fetchSinglePost', response);

    if (!response) return;

    return response;
  },

  async fetchPosts({ rootGetters, dispatch }, payload) {
    let cities = rootGetters.getCities;

    if(cities.length === 0) {
      cities = dispatch('fetchCities', null, {root: true});
    }

    let city = cities.find(city => city.id === payload.city_id);

    if(city.length === 0) {
      city = cities.find(city => city.id === 1);
    }

    const response = await axios
      .get(
        `/posts/${city.uid}/${payload.type}`
      )
      .then((res) => res.data);

    if (!response) return;

    return response;
  },

  async fetchCanHelpPosts({ rootGetters, dispatch }) {
    const city_id = rootGetters["getCityId"];

    return await dispatch("fetchPosts", { city_id, type: 2 });
  },

  async fetchNeedHelpPosts({ rootGetters, dispatch }) {
    const city_id = rootGetters["getCityId"];

    return await dispatch("fetchPosts", { city_id, type: 1 });
  },
};
