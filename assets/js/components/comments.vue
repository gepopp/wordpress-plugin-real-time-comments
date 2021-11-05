<template>
  <div class="comments-list" v-if="comments.length">
    <transition-group name="list" tag="div">
      <div v-for="comment in comments" class="list-item" :key="comment.comment_ID">
        <div class="comment-card">
          <single-comment :comment="comment"></single-comment>
          <div class="comment-reply-holder">
            <div class="spacer"></div>
            <div class="comment-reply-switcher">
              <span v-text="translations.reply_now" class="reply-now" @click="showReplies = comment.comment_ID"></span>
              |
              <span v-text="translations.replies"></span> <span v-text="comment.children.length"></span>
              <span v-if="comment.children.length && showReplies != comment.comment_ID" v-text="translations.show_replies" class="reply-link" @click="showReplies = comment.comment_ID"></span>
              <span v-if="comment.children.length && showReplies == comment.comment_ID" v-text="translations.close_replies" class="reply-link" @click="showReplies = false"></span>
              <div v-show="showReplies == comment.comment_ID" class="mt-3">
                <div v-for="child in comment.children" :key="child.comment_ID">
                  <div class="comment-card">
                    <single-comment :comment="child"></single-comment>
                  </div>
                </div>
                <div class="reply-form-holder">
                  <comments-form :post_id="post_id" :user_id="user_id" :parent_id="comment.comment_ID"></comments-form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </transition-group>
    <div v-show="loading">
      <div v-for="n in paged" :key="n">
        <div class="comment-card">
          <div class="loader-holder">
            <div class="loader-holder-inner">
              <div class="gravatar-placeholder main-bg avatar-radius"></div>
              <div class="flex-1 space-y-4 py-1">
                <div class="firstline main-bg"></div>
                <div class="space-y-2">
                  <div class="secondline main-bg"></div>
                  <div class="secondline main-bg"></div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="load-more rtc-submit-button-holder" v-show="!loading && showNext">
      <p @click="next" class="rtc-submit-button main-bg" v-text="translations.load_more"></p>
    </div>
  </div>
  <div class="relative w-full h-48 flex items-center justify-center" v-else>
    <p v-text="translations.no_comments"></p>
  </div>
</template>

<script>
import SingleComment from "./SingleComment.vue";
import commentsForm from "./commentsForm.vue";
import {CommentsRefresher} from "./CommentsRefresher.js"


export default {
  name: "comments",
  props: ['post_id', 'count', 'user_id', 'paged', 'app_key', 'load_via'],
  components: {
    commentsForm,
    SingleComment
  },
  data() {
    return {
      comments: [],
      replies: [],
      page: 1,
      loading: true,
      translations: translations,
      pusher: false,
      showReplies: 0
    }
  },
  mounted() {
    this.loadComments(this.page);

    var refresher = new CommentsRefresher('pusher', this.app_key, this);
    var loader = 'refreshVia' + this.load_via[0].toUpperCase() + this.load_via.substring(1);
    refresher[loader](this.post_id);

  },
  methods: {
    loadComments() {

      var url = '/rtc/v1/comments/?page=' + this.page + '&post=' + this.post_id + '&parent=0';
      this.$rest(url, {})
          .then((response) => {
            this.comments = this.comments.concat(response.data);
            this.loading = false;
          });

    },
    next() {
      this.loading = true;
      this.page++;
      this.loadComments();
    },

  },
  computed: {
    showNext() {
      return (this.page * this.paged) < this.count
    }
  }

}
</script>

<style scoped lang="scss">
.list-item {
}

.list-enter-active,
.list-leave-active {
  transition: all 1s ease;
}

.list-enter-from,
.list-leave-to {
  opacity: 0;
  transform: translateY(30px);
}
</style>