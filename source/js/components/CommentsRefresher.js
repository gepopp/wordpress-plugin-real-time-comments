import Pusher from "pusher-js";


export class CommentsRefresher {

    constructor(via = 'pusher', app_key, comments) {
        this.app_key = app_key;
        this.via = via;
        this.comments = comments;
    }


    refreshViaAjax(post_id){

        var interval = window.setInterval(() => {

            var exclude = [];

            this.comments.comments.forEach((comment) => {
                exclude.push(comment.comment_ID);
                comment.children.forEach((child) => exclude.push(child.comment_ID));
            });

            var url = '/rtc/v1/comments/?post='  + post_id + '&exclude=' + exclude;

            if(this.comments.comments.length){
                url += '&after=' + this.comments.comments[0].comment_date;
            }

            this.comments.$rest(url, {})
                .then((response) => {
                    response.data.forEach((comment) =>{
                        if(comment.comment_parent == 0){
                            this.comments.comments.unshift(comment);
                        }else {
                            this.comments.comments.forEach((existing_comment) => {
                                if(comment.comment_parent == existing_comment.comment_ID){
                                    existing_comment.children.push(comment);
                                }
                            })
                        }
                    })
                })

        }, 3000);

    }


    refreshViaPusher(post_id){
        var rdata;

        const pusher = new Pusher(this.app_key, {
            cluster: 'eu'
        });

        var channel = pusher.subscribe(post_id.toString());

        channel.bind('new-comment', (data) => {
            console.log(data);
            if (data.comment_parent == "0") {
                this.comments.comments.unshift(data);
            } else {
                this.comments.comments.forEach(comment => {
                    if (comment.comment_ID == data.comment_parent) {
                        comment.children.push(data);
                    }
                })
            }
        });

        return rdata;
    }
}