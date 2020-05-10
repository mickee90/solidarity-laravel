export const getInitState = () => {
  return {
    post: {
      title: "",
      ingress: "",
      content: "",
      type: 1,
      email: "",
      phone: "",
      website: "",
      user_id: null,
      published: false,
      queryProp: "",
      postId: null,
    },
  };
};

export const mutations = {
  storePost(state, data) {
    state.post = data;
  },
  resetState(state) {
    Object.assign(state, getInitState());
  },
};
