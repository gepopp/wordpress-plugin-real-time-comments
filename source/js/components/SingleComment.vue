<template>
  <div class="rtc-commenting-user">
    <div class="rtc-commenting-user-inner">
      <div class="rtc-avatar rtc-avatar-radius rtc-main-border">
        <img :src="comment.author_avatar_url" class="rtc-avatar rtc-avatar-radius">
      </div>
      <div class="rtc-comment-content">
        <div class="rtc-commenting-user-meta">
          <span v-text="comment.comment_author" class="rtc-main-color rtc-user-name"></span> |
          <span v-text="translations.posted + ' ' + comment.date_for_humans" class="rtc-comment-date"></span>
        </div>
        <div class="rtc-comment-content-holder">
          <div class="rtc-content" v-html="comment.comment_content"></div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "SingleComment",
  props: ['comment'],
  data() {
    return {
      translations
    }
  },
}
</script>

<style scoped>

</style>