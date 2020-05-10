<template>
  <PostList fetchEndpoint="post/fetchCanHelpPosts" showEndpoint="CanHelpShow"/>
</template>

<script>
  import PostList from "../components/Layout/PostList.vue";

  export default {
    components: {
      PostList,
    },
  };
</script>