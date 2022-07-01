<template>
  <div class="page">
    <div class="jumbotron">
      <div class="container">
        <div class="avater">
          <img src="https://picsum.photos/200/300" alt="img profile" />
        </div>
        <div class="jumbo_title">
          <h1 class="display-3">Contact Me</h1>
          <p class="lead">Jumbo helper text</p>
        </div>

        <div class="more_info">
          <hr class="my-2" />
          <p>More info</p>
          <p class="lead">
            <router-link :to="{ name: 'posts' }">Read My Blog</router-link>
          </p>
        </div>
      </div>

      <div class="container">
        <div class="content">
          <!-- Form Here -->
          <VueForm action="contact-form" method="post">
            <div class="form-group">
              <label for="full_name">Full Name</label>
              <input
                type="text"
                class="form-control"
                name="full_name"
                id="full_name"
                aria-describedby="full_namehelpId"
                placeholder="maRIO rOSSI"
              />
              <small id="full_namehelpId" class="form-text text-muted"
                >Help text</small
              >
            </div>

            //

            <div class="form-group">
              <label for="email">Email</label>
              <input
                type="email"
                class="form-control"
                name="email"
                id="email"
                aria-describedby="emailhelpId"
                placeholder="mariorossi@email.com"
              />
              <small id="emailhelpId" class="form-text text-muted">Name</small>
            </div>

            <div class="form-group">
              <label for="subject">subject</label>
              <input
                type="text"
                class="form-control"
                name="subject"
                id="subject"
                aria-describedby="subjecthelpId"
                placeholder=""
              />
              <small id="subjecthelpId" class="form-text text-muted"
                >Help text</small
              >
            </div>

            <div class="form-group">
              <label for="subject">subject</label>
              <input
                type="text"
                class="form-control"
                name="subject"
                id="subject"
                aria-describedby="subjecthelpId"
                placeholder=""
              />
              <small id="subjecthelpId" class="form-text text-muted"
                >Help text</small
              >
            </div>

            <div class="form-group">
              <label for="message">Content</label>
              <textarea
                class="form-control"
                name="message"
                id="message"
                rows="6"
              ></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Send Message</button>
          </VueForm>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import VueForm from "../components/VueForm.vue";

export default {
  name: "Contacts",
  components: VueForm,
};
</script>
