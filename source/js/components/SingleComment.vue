<template>
  <div class="commenting-user">
    <div class="commenting-user-inner">
      <div class="avatar avatar-radius main-border">
        <img :src="comment.author_avatar_url" class="avatar avatar-radius">
      </div>
      <div class="comment-content">
        <div class="commenting-user-meta">
          <span v-text="comment.comment_author" class="main-color user-name"></span> |
          <span v-text="translations.posted + ' ' + comment.date_for_humans" class="comment-date"></span>
        </div>
        <div class="comment-content-holder">
          <div class="content" v-html="comment.comment_content"></div>
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