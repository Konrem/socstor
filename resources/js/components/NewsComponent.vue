<template>
<div>
    <div class="search">
         <div class="alert alert-danger" v-if="errors">
            <h4 class="text-center pt-1">Заповніть хоча б одне поле!</h4>
        </div>
        <div class="text-center alert alert-danger" v-if="dateError">
            <h4 class="pt-2">Назад в майбутнє!</h4>
             <p>Перевірте дату пошуку</p>
        </div>
        <form action="/search " method="GET" role="search" >
            <div class="search-inputs">
                <div class="search-all-date">Пошук по даті:
                    <div class="search-date">
                        <div class="search-of">з <input name="searchOf" id="searchOf" type="date" :max="now" v-model="dataSearch.searchOf" ></div>
                        <div class="search-by"> по <input name="searchBy" id="searchBy" type="date" :max="now" v-model="dataSearch.searchBy" ></div>
                    </div>
                </div>
                <div class="mt-2 search-text">
                    Пошук за назвою:
                    <input type="text" name="search" id="search" v-model.trim="dataSearch.search" >
                </div>
            </div>
            <div class="action-btn">
                <input type="submit" value="" v-on:click="checkEmpty($event)" >
            </div>
        </form>
        <div></div>
    </div>
    <hr>
    <div v-for="post in posts" :key="post.id">
        <div class="news-item" >
            <div class="full-date">
                {{ post.fullDateMobile }}
            </div>
            <div class="date">
                <span class="month">
                    {{ post.month }}
                </span>
                <hr>
                <span class="day">
                    {{ post.day }}
                </span>
            </div>
            <div class="news-image">
                <img :src="post.img" alt="">
            </div>
            <div class="news-body">
                <div class="news-name">
                    {{ post.title }}
                </div>
                <div class="news-text">{{ post.description }}</div>
                <hr>
                <div class="show-next">
                    <a :href="post.slug">
                        Читати повністю
                        <img src="img/right-arrow(1).svg" alt="">
                    </a>
                </div>
            </div>
        </div>
    <hr>
    </div>
    <div class="more-news">
        <button class="more-news-btn" @click="loadmore" v-if="isLoadMore"> Показати ще </button>
         <p class="more-news-btn" v-else>Новин більше немає</p>
    </div>

</div>
</template>

<script>
    export default {
        name: 'news',
        data() {
            return {
                posts: null,
                countPublishedPosts: null,
                offset: 0,
                limit: 5,
                isLoadMore: true,
                dataSearch : {
                    searchOf: '',
                    searchBy: '',
                    search: '',
                },
                now: '',
                errors: false,
                dateError: false,
            };
        },
         created () {
             this.toDay();
        },
        mounted() {

            axios.get(`/loadMore/?offset=${this.offset}&limit=${this.limit}`)
                .then(response => (this.posts = response.data) )
                .catch(function (error) {
                    console.log(error);
                });
            axios.get(`/endList/`)
            .then(response => (this.countPublishedPosts = response.data) )
            .catch(function (error) {
                console.log(error);
            });
        },
        methods: {
            loadmore() {
                this.offset = this.offset + 5;
                this.limit = this.limit + 5;
                if (this.limit >= this.countPublishedPosts) {
                    this.isLoadMore = false;
                }

                axios.get(`/loadMore/?offset=${this.offset}&limit=${this.limit}`)
                    .then(response => (this.posts = this.posts.concat(response.data ) ) )
                    .catch(function (error) {
                        console.log(error);
                    });
            },
            
            checkEmpty(event) {
                const { searchOf, searchBy, search } = this.dataSearch;
                const searchOfDate = new Date(searchOf);
                const searchByDate = new Date(searchBy);
                
                if (searchOfDate > searchByDate) {
                    event.preventDefault();
                    this.dateError = true;
                }
                if (search === '' &&  searchOf === '' && searchBy === '') {
                    event.preventDefault();
                    this.errors = true;
                } 
            },
            toDay() {
                const today = new Date();
                const dd = today.getDate();
                const mm = today.getMonth() + 1;
                const yyyy = today.getFullYear();
                this.now = `${yyyy}-${mm}-${dd}`;
            },
        },
    }
</script>
<style>
    input:focus{
        outline: none;
    }
    #searchOf, #searchBy{
        min-width: 100px;
    }
    .search-text{
        display: flex;
    }
    #search{
        display: flex;
        flex: 1;
        margin-left: 6px;
    }
    .search-date{
        margin-left: 16px;
    }
    @media (max-width: 999px) {
        .news-name{
            margin-top: 10px;
        }
    }
    @media (max-width: 920px) {
        .search-text{
            display: block;
        }
        .search-date{
            display: -webkit-inline-box;
            margin-top: 15px;
        }
        .search-inputs{
            display: flex;
            flex-direction: column-reverse;
        }
        .search form{
            flex-direction: column;
            text-align: center;
            margin: 0;
        }
        #search{
            width: 100%;
            margin-top: 15px;
            display: block;
            margin-left: 0;
        }
        .action-btn{
            margin-top: 20px;
        }
        .search-inputs input {
            padding: 5px;
        }
        .search-by{
            margin-left: 10px;
        }
        #searchOf{
            margin-left: 5px;
        }
    }
    @media (max-width: 767px) {
        #search{
            width: 100%;
        }
    }
    @media (max-width: 600px) {
        .search-all-date{
            margin-top: 20px;
        }
    }
    @media (max-width: 450px) {
        .search-all-date{
            width: 70%;
            margin: 0 auto;
            text-align: center;
        }
        .search-inputs{
            margin: 0;
        }
        .search-date{
            display: block;
            margin: 15px 0 0 0;
        }
        .search-by{
            margin-left: 0px;
        }
        .search-of{
            margin-left: 9px;
        }
    }
</style>