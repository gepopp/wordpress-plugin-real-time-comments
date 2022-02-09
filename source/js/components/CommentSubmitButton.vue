<template>
  <div class="rtc-submit-button-holder">
    <button type="submit"
            class="rtc-submit-button rtc-main-bg">
            <span v-show="submitting" class="rtc-mr-2">
              <svg class="rtc-animate-spin rtc--ml-1 rtc-mr-3 rtc-h-5 rtc-w-5 rtc-text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <circle class="rtc-opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="rtc-opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
              </svg>
            </span>
            <span v-text="translations.submit"></span>
    </button>
  </div>
</template>

<script>
export default {
  name: "CommentSubmitButton",
  data(){
    return {
      translations: translations,
      submitting: false
    }
  }
}
</script>

<style scoped>

</style>