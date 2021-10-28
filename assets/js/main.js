import '../scss/styles.scss';

window.realTimeComment = (comments) => {
    return {
        comments : comments,
        newComment : '',
        saveComment(){

            console.log(this.newComment);


            this.newComment = '';
        }
    }
}