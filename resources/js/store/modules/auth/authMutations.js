export const getInitState = () => {
  return {
    authToken: null,
    idToken: null,
    user_id: null,
    expirationDate: null,
    refreshToken: null,
    user: null,
  };
};

export const mutations = {
  authUser(state, userData) {
    state.idToken = userData.idToken;
    state.user_id = userData.user_id;
    state.expirationDate = userData.expirationDate;
    state.refreshToken = userData.refreshToken;
  },
  authToken(state, token) {
    state.authToken = token
  },
  setUser(state, user) {
    state.user = user;
  },
  storeUser(state, user) {
    state.user = user;
  },
  resetState(state) {
    Object.assign(state, getInitState());
  },
};
