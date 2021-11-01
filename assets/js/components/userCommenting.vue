<template>
  <div class="max-w-sm w-full mb-3" v-if="!user">
    <div class="animate-pulse flex space-x-4">
      <div class="rounded-full bg-gray-400 h-12 w-12"></div>
      <div class="flex-1 py-1">
        <div class="h-4 bg-gray-400 rounded w-3/4 mb-2"></div>
        <div class="h-3 bg-gray-400 rounded w-1/4"></div>
      </div>
    </div>
  </div>
  <div class="max-w-sm w-full mb-3" v-else>
    <div class="flex space-x-4">
      <div class="rounded-full h-12 w-12 border-2 border-gray-900 p-1">
        <img :src="user.avatar_urls[48]" class="w-full h-auto rounded-full">
      </div>
      <div class="flex-1 py-1">
        <div class="h-4 mb-2">
          <p v-text="user.name" class="text-lg font-semibold mb-3"></p>
        </div>
        <div class="h-3">
          <p v-text="user.slug" class="text-sm"></p>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "userCommenting",
  props: ['user']
}
</script>

<style scoped>

</style>