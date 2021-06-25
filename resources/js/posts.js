const { default: Axios } = require("axios");

var App = new Vue({
    el: '#root',
    data: {
        title: 'Lista post (VueJs)',
        posts: [

        ]
    },
    mounted() {
        axios.get('http://127.0.0.1:8000/api/posts')
        .then(result=> {
            console.log(result);
            this.posts= result.data.posts;
            console.log(this.posts);
        });
    }
});