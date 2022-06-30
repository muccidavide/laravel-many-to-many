<template>
  <div>
    <div class="jumbotron bg-dark text-white">
      <h1 class="display-3">Boolpress Blog</h1>
      <p class="lead">
        Lorem ipsum, dolor sit amet consectetur adipisicing elit. Voluptates,
        asperiores laboriosam impedit rerum illum quidem tempora est blanditiis
        maxime quis!
      </p>
      <hr class="my-2" />
      <p class="lead">
        <a class="btn btn-primary btn-lg" href="Jumbo action link" role="button"
          >Jumbo action name</a
        >
      </p>
    </div>
    <section>
      <div class="container">
        <div class="row">
            <div class="col-4" v-for="post in posts" :key="post.id">
                <div class="card">
                    <!-- <img class="img-fluid" :src="'/storage/' + post.cover_image" alt=""> -->
                    <img class="img-fluid " :src=" asset('/storage/' + post.cover_image )" :alt="'cover of' +  post.title ">
                    <p>
                        {{ post.content + '...' }}
                    </p>
                </div>
            </div>
        </div>
      </div>
    </section>
  </div>
</template>
<script>
import  Axios  from "axios";
export default {
  name: "Home",
  data(){
    return {
        posts: ''
    }
    
  },
  methods: {
        
    },
    mounted(){
        Axios.get('/api/posts')
        .then(response=> {
            console.log(response.data.data);
             const posts = response.data.data;
            this.posts =  posts;  
        })
        .catch(e =>{
            console.error(e);
        })
    }
};
</script>
