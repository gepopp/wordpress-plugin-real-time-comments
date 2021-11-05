<template>
  <div class="flex space-x-4">
    <div class="avatar-radius h-12 w-12 border-2 main-border p-1">
      <img :src="comment.author_avatar_url" class="w-full h-auto avatar-radius">
    </div>
    <div class="flex-1 py-1">
      <div class="h-4 rounded w-3/4 text-sm text-gray-600">
        <span v-text="comment.comment_author" class="font-semibold"></span> |
        <span v-text="translations.posted + ' ' + comment.date_for_humans"></span>
      </div>
      <div class="space-y-2">
        <div class="rounded font-semibold text-gray-800" v-html="comment.comment_content"></div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "SingleComment",
  props : ['comment'],
  data(){
    return {
      translations
    }
  },
}
</script>

<style scoped>

</style>