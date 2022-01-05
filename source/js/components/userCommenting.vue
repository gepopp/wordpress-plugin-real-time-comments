<template>
  <div class="rtc-loader-holder" v-if="!user">
    <div class="rtc-loader-holder-inner">
      <div class="rtc-gravatar-placeholder rtc-main-bg rtc-avatar-radius"></div>
      <div class="rtc-flex-1 rtc-py-1">
        <div class="rtc-firstline rtc-main-bg"></div>
        <div class="rtc-secondline rtc-main-bg"></div>
      </div>
    </div>
  </div>
  <div class="rtc-commenting-user" v-else>
    <div class="rtc-commenting-user-inner">
      <div class="rtc-avatar rtc-avatar-radius rtc-main-border">
        <img :src="user.avatar_urls[48]" class="artc-vatar-radius">
      </div>
      <div class="rtc-user-name">
        <div class="rtc-name-holder">
          <p v-text="user.name" class="rtc-name rtc-main-color"></p>
        </div>
        <div class="rtc-nickname-holder">
          <p v-text="user.slug" class="rtc-nickname"></p>
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