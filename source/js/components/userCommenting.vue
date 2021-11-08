<template>
  <div class="loader-holder" v-if="!user">
    <div class="loader-holder-inner">
      <div class="gravatar-placeholder main-bg avatar-radius"></div>
      <div class="flex-1 py-1">
        <div class="firstline main-bg"></div>
        <div class="secondline main-bg"></div>
      </div>
    </div>
  </div>
  <div class="commenting-user" v-else>
    <div class="commenting-user-inner">
      <div class="avatar avatar-radius main-border">
        <img :src="user.avatar_urls[48]" class="avatar-radius">
      </div>
      <div class="user-name">
        <div class="name-holder">
          <p v-text="user.name" class="name main-color"></p>
        </div>
        <div class="nickname-holder">
          <p v-text="user.slug" class="nickname"></p>
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