<template>
  <form ref="comment-form" @submit.prevent="submitComment">
    <transition name="fade">
      <div class="rtc-text-green-600 rtc-py-5 rtc-bg-green-100 rtc-bg-opacity-25" v-if="success">
        <p v-text="translations.comment_succes"></p>
      </div>
    </transition>
    <transition name="fade">
      <div class="rtc-text-red-600 rtc-py-5 rtc-bg-red-100 rtc-bg-opacity-25" v-if="errors.length">
        <ol class="rtc-list-none">
          <li v-for="error in errors" v-html="error"></li>
        </ol>
      </div>
    </transition>
    <input type='hidden' name='post' :value='post_id' id='comment_post_ID'/>
    <div class="rtc-comment-form-holder">
      <slot name="user"></slot>
      <div class="rtc-comment-form">
        <slot name="comment-form">
          <comment-input-field></comment-input-field>
        </slot>
        <slot name="after-comments-form"></slot>
        <slot name="comment-submit-button">
          <comment-submit-button></comment-submit-button>
        </slot>
      </div>

    </div>
  </form>
</template>

<script>
import UserCommenting from "./UserCommenting.vue";
import NoUserCommentForm from "./NoUserCommentForm.vue";
import CommentInputField from "./CommentInputField.vue";
import CommentSubmitButton from "./CommentSubmitButton.vue";

export default {
  name: "CommentsForm",
  components: {
    CommentSubmitButton,
    CommentInputField,
    NoUserCommentForm,
    UserCommenting
  },
  props: ['post_id', 'user_id', 'parent_id'],
  data() {
    return {
      translations: translations,
      user: null,
      errors: [],
      submitting: false,
      success: false
    }
  },
  methods: {
    submitComment() {

      this.errors = [];

      this.submitting = true;

      var formData = new FormData(this.$refs["comment-form"]);

      this.$rest.post('/wp/v2/comments', formData)
          .then((response) => {
            this.newComment = '';
            this.flashSuccess();
          })
          .catch((response) => {
            this.errors.push(response.response.data.message);
          })
          .then(() => {
            this.submitting = false;
          })
    },
    flashSuccess() {
      this.success = true;
      setTimeout(() => {
        this.success = false;
      }, 3000)
    }
  }
}
</script>

<style scoped lang="scss">

.rtc-fade-enter-active, .rtc-fade-leave-active {
  transition: opacity .5s;
}

.rtc-fade-enter, .rtc-fade-leave-to /* .fade-leave-active below version 2.1.8 */
{
  opacity: 0;
}
</style>