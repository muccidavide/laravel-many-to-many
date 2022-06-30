<template>
  <div>

        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
        <div class="container">

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav mr-auto">
                  <li class="nav-item mx-2" v-for="item in menu_items" :key="item.id">
                    <router-link :to="{ name: item.route_name }">{{item.route_text}}</router-link>
                  </li>

                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto">
                    <!-- Authentication Links -->
                   
                </ul>
            </div>
        </div>
    </nav>


    <router-view></router-view>
  </div>
</template>
<script>
export default {
  name: "App",
  data() {
    return {
      menu_items: [
        { route_name: "home", route_text: "Home" },
        { route_name: "about", route_text: "About" },
        { route_name: "posts", route_text: "Posts" },
        
        
        
        
        ],
    };
  },
};
</script>