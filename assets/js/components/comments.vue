<template>
  <div class="relative w-full p-3">
    <transition-group name="list" tag="div">
      <div v-for="comment in comments" class="list-item" :key="comment.id">
        <div class="border-b border-gray-300 shadow p-4 w-full">
          <single-comment :comment="comment"></single-comment>
          <div class="flex mt-3">
            <div class="w-20 p-1"></div>
            <div class="text-gray-700 text-sm w-full">
              <span v-text="translations.reply_now" class="underline uppercase font-bold text-gray-600 cursor-pointer" @click="showReplies = comment.id"></span>
              |
              <span v-text="translations.replies"></span> <span v-text="comment.children.length"></span>
              <span v-if="comment.children.length && showReplies != comment.id" v-text="translations.show_replies" class="underline cursor-pointer" @click="showReplies = comment.id"></span>
              <span v-if="comment.children.length && showReplies == comment.id" v-text="translations.close_replies" class="underline cursor-pointer" @click="showReplies = false"></span>
              <div v-show="showReplies == comment.id" class="mt-3">
                <div v-for="child in comment.children" :key="child.id">
                  <div class="border-b border-gray-300 shadow p-4 w-full">
                    <single-comment :comment="child"></single-comment>
                  </div>
                </div>
                <div class="p-3 bg-gray-300">
                  <comments-form :post_id="post_id" :user_id="user_id" :parent_id="comment.id"></comments-form>
                </div>
              </div>
            </div>

          </div>
        </div>
      </div>
    </transition-group>


    <div v-show="loading">
      <div v-for="n in 3" :key="n">
        <div class="border-b border-gray-300 shadow p-4 w-full">
          <div class="animate-pulse flex space-x-4">
            <div class="rounded-full bg-gray-400 h-12 w-12"></div>
            <div class="flex-1 space-y-4 py-1">
              <div class="h-4 bg-gray-400 rounded w-3/4"></div>
              <div class="space-y-2">
                <div class="h-4 bg-gray-400 rounded"></div>
                <div class="h-4 bg-gray-400 rounded w-5/6"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="flex justify-center p-3" v-show="!loading && showNext">
      <p @click="next" class="cursor-pointer" v-text="translations.load_more"></p>
    </div>

  </div>
</template>

<script>
import SingleComment from "./SingleComment.vue";
import commentsForm from "./commentsForm.vue";
import Pusher from 'pusher-js';


export default {
  name: "comments",
  props: ['post_id', 'count', 'user_id'],
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

    const pusher = new Pusher('33200611800c555398d6', {
      cluster: 'eu'
    });

    var channel = pusher.subscribe(this.post_id.toString());
    channel.bind('new-comment', (data) => {

      if (data.post == this.post_id) {
        if (data.parent == 0) {
          this.comments.unshift(data)
        } else {
          this.comments.forEach(comment => {

            if (comment.id == data.parent) {
              comment.children.unshift(data)
            }

          });
        }
      }
    });


  },
  methods: {
    loadComments(page) {
      var url = '/wp/v2/comments?post=' + this.post_id + '&page=' + page + '&parent=0'
      this.$rest(url, {})
          .then((response) => {
            response.data.forEach((comment) => {
              this.loadReplies(comment);
            })
            if (!response.data.length) this.loading = false;
          })
    },
    loadReplies(parent) {

      var url = '/wp/v2/comments?post=' + this.post_id + '&parent=' + parent.id
      this.$rest(url, {})
          .then((response) => {
            parent.children = response.data;
            this.comments.push(parent);
          })
          .catch(() => {
          })
          .then(() => {
            this.loading = false;
          });
    },
    next() {
      this.loading = true;
      this.page++;
      this.loadComments(this.page);
    },

  },
  computed: {
    showNext() {
      return (this.page * 10) < this.count
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