<template>
  <div class="rtc-no-user-form">
    <div class="rtc-input-holder">
      <input type="text"
             name="author_name"
             class="rtc-input rtc-main-border rtc-text-gray-800"
             :placeholder="translations.name_placeholder"
             v-model="user.name"
             @focus="errors.name = ''"
      />
      <transition name="rtc-fade">
            <span v-show="errors.name"
                  v-text="errors.name"
                  class="rtc-input-error">
            </span>
      </transition>
    </div>
    <div class="rtc-input-holder">
      <input type="email"
             name="author_email"
             class="rtc-input rtc-main-border rtc-text-gray-800"
             :placeholder="translations.email_placeholder"
             v-model="user.email"
             @focus="errors.email = ''"
      />
      <transition name="rtc-fade">
            <span v-show="errors.email"
                  v-text="errors.email"
                  class="rtc-input-error">
            </span>
      </transition>
    </div>
  </div>
</template>

<script>
export default {
  name: "NoUserCommentForm",
  data() {
    return {
      translations: translations,
      errors: {},
      user: {
        name: '',
        email: ''
      }
    }
  }
}
</script>

<style scoped>

</style>