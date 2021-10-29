<template>
  <div class="flex space-x-4">
    <div class="rounded-full h-12 w-12 border-2 border-gray-900 p-1">
      <img :src="comment.author_avatar_urls[48]" class="w-full h-auto rounded-full">
    </div>
    <div class="flex-1 py-1">
      <div class="h-4 rounded w-3/4 text-sm text-gray-600 my-2">
        <span v-text="comment.author_name" class="font-semibold"></span> |
        <span v-text="translations.posted + ' ' + formatDate(comment.date)"></span>
      </div>
      <div class="space-y-2">
        <div class="rounded font-semibold" v-html="comment.content.rendered"></div>
      </div>
    </div>
  </div>
</template>

<script>
var moment = require('moment'); // require

export default {
  name: "SingleComment",
  props : ['comment'],
  data(){
    return {
      translations
    }
  },
  methods:{
    formatDate(date) {
      return moment(date).format('DD.MM.YYYY HH:mm')
    }
  }
}
</script>

<style scoped>

</style>