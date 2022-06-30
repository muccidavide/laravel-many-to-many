<template>
  <div class="wrapper">
    <div class="single-page">
      <img :src="post.cover_image" :alt="post.title" />
      <h1>{{ post.title }}</h1>
      <p>
        {{ post.content }}
      </p>

      <hr />
      <p v-if="post.category > 0">Category: {{ post.category.name }}</p>

      <div class="tags" v-if="post.tags > 0">
        <ul>
          <li v-for="tag in post.tags" :key="tag.name">
            {{ tag.name }}
          </li>
        </ul>
      </div>
      <div class="notags" v-else>
        <h2>No Tags</h2>
      </div>
    </div>
  </div>
</template>

<script>
import Axios from "axios";
export default {
  name: "Post",
  data() {
    return {
      post: "",
    };
  },
  methods: {},
  mounted() {
    Axios.get("/api/posts/" + this.$route.params.slug)
      .then((response) => {
        console.log(response);
        this.post = response.data;
      })
      .catch((e) => {
        console.error(e);
      });
  },
};
</script>

<style lang='scss' scoped>
</style>