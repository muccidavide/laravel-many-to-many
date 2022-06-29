<template>
    <div>
        <h1 class="text-center">
            Work In progress
        </h1>
        
            <div class="container">
                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3">
                    <div class="col" v-for="post in posts" :key="post.id" >
                        <div class="product card">
                            <img :src="post.cover_image" :alt="post.title">
                            <div class="card-body">
                                <h3>{{post.title}}</h3>
                                <p>{{post.content}}</p>

                            </div>
                            <div class="card-footer">
                                <span v-if="post.category"><strong>Category: </strong>{{post.category.name}}</span>
                                <div class="tags" v-if="post.tags.length> 0">
                                    <strong>Tags:</strong>
                                    <ul>
                                        <li v-for="tag in post.tags" :key="tag.id">
                                            {{tag.name}}
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            
                        </div>


                    </div>

                </div>
            </div>
      
    </div>
</template>
<script>
export default {
    name: "App",
    components: {},
    data(){
        return{
            posts: ''
        }
    },
    methods:{
        getAllPosts(){

        }
    },
    mounted(){
        axios.get('api/posts')
        .then((response)=>{
            console.log(response);
            this.posts = response.data.data
        }).catch(e =>{
            console.error(e);
        })
    }
}
</script>