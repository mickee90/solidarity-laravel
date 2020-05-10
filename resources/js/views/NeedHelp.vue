<template>
  <PostList fetchEndpoint="post/fetchNeedHelpPosts" showEndpoint="NeedHelpShow"/>
</template>

<script>
import PostList from "../components/Layout/PostList.vue";

export default {
  components: {
    PostList,
  },
};
</script>
