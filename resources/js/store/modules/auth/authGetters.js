export const getters = {
  getUser(state) {
    return state.user;
  },
  isAuthenticated(state) {
    return state.authToken !== null;
  },
  getAuthToken(state) {
    return state.authToken;
  },
};
