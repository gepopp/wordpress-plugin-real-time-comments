<template>
  <div class="relative">
    <div v-if="user_id == 0">
      <div class="flex space-x-3 w-full mb-3">
        <div class="flex-1 relative">
          <input type="text"
                 name="name"
                 class="block p-3 w-full text-gray-800"
                 :placeholder="translations.name_placeholder"
                 v-model="user.name"
                 @focus="errors.name = ''"
          />
          <transition name="fade">
            <span v-show="errors.name"
                  v-text="errors.name"
                  class="absolute bottom-0 p-0 text-xs text-red-800">
            </span>
          </transition>
        </div>
        <div class="flex-1 relative">
          <input type="email"
                 name="email"
                 class="block p-3 w-full text-gray-800"
                 :placeholder="translations.email_placeholder"
                 v-model="user.email"
                 @focus="errors.email = ''"
          />
          <transition name="fade">
            <span v-show="errors.email"
                  v-text="errors.email"
                  class="absolute bottom-0 p-0 text-xs text-red-800">
            </span>
          </transition>
        </div>
      </div>
    </div>
    <user-commenting :user="user" v-if="user_id"></user-commenting>

    <div class="flex space-x-3">
      <!--      TODO add conditional styling option - use theme styles : dequeues plugin css-->
      <div class="w-full relative">
        <input
            type="text"
            class="block bg-white p-3 flex-1 w-full text-gray-800"
            :placeholder="translations.comment_placeholder"
            v-model="newComment"
            v-on:keyup.enter="validation"
            @focus="submitError = ''"
        >
        <p class="text-xs text-red-600 absolute" v-html="submitError"></p>
      </div>
      <div class="relative"
           @mouseenter="toggleWarn('enter')"
           @mouseleave="toggleWarn('leave')"
      >
        <button type="submit"
                class="main-bg text-white text-center px-5 h-full flex items-center"
                :disabled="!commentable"
                :class="{'cursor-not-allowed' : !commentable }"
                @click="validation"

        >
          <span v-show="submitting" class="mr-2">
              <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
              </svg>
            </span>
          <span v-text="translations.submit"></span>
        </button>
        <transition name="fade">
          <div v-text="translations.submit_warning"
               v-show="warn"
               class="absolute tooltip p-1 text-xs shadow-lg border border-red-900 bg-red-500 bg-opacity-50 text-white mt-3 rounded">
          </div>
        </transition>
      </div>
    </div>

    <transition name="fade">
      <div class="absolute top-0 left-0 w-full h-full bg-white flex justify-center items-center text-green-800" v-show="success">
        <p v-text="translations.comment_succes"></p>
      </div>
    </transition>
  </div>

</template>

<script>
import userCommenting from "./userCommenting.vue";

export default {
  name: "commentsForm",
  components: {
    userCommenting
  },
  props: ['post_id', 'user_id', 'parent_id'],
  data() {
    return {
      translations: translations,
      newComment: '',
      submitError: '',
      warn: false,
      user: false,
      submitting: false,
      errors: {},
      success: false
    }
  },
  mounted() {
    if (this.user_id !== 0) {
      this.$rest('/wp/v2/users/' + this.user_id, {})
          .then((response) => {
            this.user = response.data;
          });
    } else {
      this.user = {
        email: '',
        name: ''
      }
    }
  },
  methods: {
    toggleWarn(mouse) {
      if (!this.commentable && mouse == 'enter') {
        this.warn = true;
      } else {
        this.warn = false;
      }
    },
    submitComment() {

      this.submitting = true;

      var data = {
        author_email: this.user.email,
        author_name: this.user.name,
        content: this.newComment,
        post: this.post_id
      }

      if (this.user_id != 0) {
        data.author = this.user_id;
      }

      if(this.parent_id !== undefined){
        data.parent = this.parent_id
      }

      this.$rest.post('/wp/v2/comments', data)
          .then((response) => {
            this.newComment = '';
            this.flashSuccess();
          })
          .catch((response) => {
            this.submitError = response.response.data.message;
          })
          .then(() => {
            this.submitting = false;
          })
    },
    validation() {

      this.errors = {};

      if (this.user_id == 0 && this.user.name == '') {
        this.errors.name = this.translations.name_required
      }

      if (this.user_id == 0 && !this.validEmail(this.user.email)) {
        this.errors.email = this.translations.valid_email;
      }

      if (!this.commentable) {
        this.errors.comment = this.translations.submit_warning;
      }

      if (!Object.keys(this.errors).length) this.submitComment();
    },
    flashSuccess() {
      this.success = true;
      setTimeout(() => {
        this.success = false;
      }, 3000)
    },
    validEmail: function (email) {
      var re = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
      return re.test(email);
    }

  },
  computed: {
    commentable() {
      return this.newComment.length >= 3;
    },
  }
}
</script>

<style scoped lang="scss">
.tooltip {
  white-space: nowrap;
}

.fade-enter-active, .fade-leave-active {
  transition: opacity .5s;
}

.fade-enter, .fade-leave-to /* .fade-leave-active below version 2.1.8 */
{
  opacity: 0;
}
</style>