<template>
  <div class="rtc-comment-input-field">
    <div class="rtc-input-holder">
          <textarea
              type="text"
              class="rtc-input rtc-main-border rtc-text-gray-800"
              :placeholder="translations.comment_placeholder"
              v-model="newComment"
              name="content"
          ></textarea>
    </div>
  </div>
</template>

<script>
export default {
  name: "CommentInputField",
  data(){
    return {
      translations: translations,
      newComment: '',
    }
  },
  computed: {
    commentable() {
      return this.newComment.length >= 3;
    },
  }
}
</script>

<style scoped>

</style>