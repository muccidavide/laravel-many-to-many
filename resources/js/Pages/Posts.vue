<template>

  <div>
    <h1>Posts</h1>
    <h1 class="text-center">Work In progress</h1>

    <div class="container">
      <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3">
        <div class="col p-3" v-for="post in postsResponse.data" :key="post.id">
         
          <div class="product card h-100">
            
            <img class="img-fluid " :src="'/storage/' + post.cover_image "  :alt="'cover of' + post.title">
            <div class="card-body">
              <h3>{{ post.title }}</h3>
              <p>{{ post.content }}</p>
            </div>
            <div class="card-footer">
              <span v-if="post.category"
                ><strong>Category: </strong>{{ post.category.name }}</span
              >
             
              <div class="tags" v-if="post.tags.length > 0">
                <strong>Tags:</strong>
                <ul>
                  <li v-for="tag in post.tags" :key="tag.id">
                    {{ tag.name }}
                  </li>
                </ul>
                
              </div>
                <router-link :to="{ name:'post', params:  { slug : post.slug }  }">Read More</router-link>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="pagination d-flex justify-content-center py-4">
      <nav aria-label="Page navigation" class="py-5">
        <ul class="pagination">
          <li class="page-item">
            <a
              class="page-link"
              href="#"
              aria-label="Previous"
              v-if="postsResponse.current_page > 1"
              @click.prevent="getAllPosts(postsResponse.current_page - 1)"
            >
              <span aria-hidden="true">&laquo;</span>
              <span>Previous</span>
            </a>
          </li>
          <!-- Number Pagination -->
          <li
            class="page-item"
            :class="postsResponse.current_page == 1 ? 'active' : ' '"
          >
            <a
              class="page-link"
              href="#"
              @click.prevent="getAllPosts(1)"
              >1</a
            >
          </li>
          <li
            class="page-item"
            :class="postsResponse.current_page == 2 ? 'active' : ' '"
          >
            <a
              class="page-link"
              href="#"
              @click.prevent="getAllPosts(2)"
              >2</a
            >
          </li>
          <li
            class="page-item"
            v-if="postsResponse.current_page < postsResponse.last_page"
          >
            <!-- Next Page -->
            <a
              class="page-link"
              href="#"
              aria-label="Next"
              @click.prevent="getAllPosts(postsResponse.current_page + 1)"
            >
              <span aria-hidden="true">&raquo;</span>
              <span>Next</span>
            </a>
          </li>
        </ul>
      </nav>
    </div>
  </div>
    
</template>
<script>

export default {
  name: "Posts",
  components: {},
  data() {
    return {
      categories: "",
      postsResponse: "",
    };
  },
  methods: {
    getAllPosts(postPage) {
      axios
        .get("api/posts", {
          params: {
            page: postPage,
          },
        })
        .then((response) => {
  
          this.posts = response.data.data;
          this.postsResponse = response.data;
          console.log(this.posts);
        })
        .catch((e) => {
          console.error(e);
        });
    },
    getallCategories() {
      axios
        .get("api/categories")
        .then((response) => {
          
          this.categories = response.data;
        })
        .catch((e) => {
          console.error(e);
        });
    },
  },
  mounted() {
    console.log("mounted");
    this.getAllPosts(1);
    this.getallCategories();
    console.log(this.postsResponse);
  },
};
</script>