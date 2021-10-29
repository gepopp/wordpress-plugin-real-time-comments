<template>
  <div>
    <p v-text="user.name"></p>
    <div class="flex space-x-3">
      <!--      TODO add conditional styling option - use theme styles : dequeues plugin css-->
      <div class="w-full relative">
        <input
            type="text"
            class="block bg-white p-3 flex-1 w-full"
            :placeholder="translations.comment_placeholder"
            v-model="newComment"
        >
        <p class="text-xs text-red-600 absolute" v-text="submitError"></p>
      </div>
      <div class="relative"
           @mouseenter="toggleWarn()"
           @mouseleave="toggleWarn()"
      >
        <button type="submit"
                class="bg-gray-800 text-white text-center px-5 h-full flex items-center"
                :disabled="!commentable"
                :class="{'cursor-not-allowed' : !commentable }"
                @click="submitComment"

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
  </div>
</template>

<script>
export default {
  name: "commentsForm",
  props: ['post_id', 'user_id'],
  data() {
    return {
      translations: translations,
      newComment: '',
      submitError: '',
      warn: false,
      user: false,
      submitting: false
    }
  },
  mounted() {
    if (this.user_id !== 0) {
      this.$rest('/wp/v2/users/' + this.user_id, {})
          .then((response) => {
            this.user = response.data;
          });
    }
  },
  methods: {
    toggleWarn() {
      if (this.commentable) {
        this.warn = false;
      } else {
        this.warn = !this.warn;
      }
    },
    submitComment() {

      this.submitting = true;

      this.$rest.post('/wp/v2/comments', {
        author: this.user.id,
        author_email: this.user.email,
        author_name: this.user.name,
        content: this.newComment,
        post: this.post_id
      }).then((response) => {
        this.newComment = '';
      })
          .catch((response) => {
            this.submitError = response.response.data.message;
          })
          .then(() => {
            this.submitting = false;
          })
    }
  },
  computed: {
    commentable() {
      return this.newComment.length >= 10;
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