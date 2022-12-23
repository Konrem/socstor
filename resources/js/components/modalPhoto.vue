
<template>
    <div>
        <div class="page-title">
            <span>{{ header }}</span>
        </div>
        <div v-if="images.length == 0" class="text-center">
            <h2>Фотоальбом порожній</h2>
        </div>
        <div id="photo-modal" class="photos">
            <div class="photo" v-for="(image, index) in images" :key="index">
                <img :src="image" alt="index" @click="() => showModal(index)">
            </div>
            <modal v-show="isModalVisible" @close="closeModal" :images="images" :currImg="currImg" :defaultIndex="index" />
        </div>
        <!-- <Modal /> -->
    </div>
</template>
<script>
    import modal from './Modal';
    export default {
        components: {
            modal
        },
        props: ['album', 'header'],
        data: () => ({
            isModalVisible: false,
            images: [],
            index: 0,
            currImg: ''
        }),
        methods: {
            showModal(index) {
                this.isModalVisible = true;
                this.index = index+1;
                this.currImg = this.images[this.index];

            },
            closeModal() {
                this.isModalVisible = false;
            }
        },
        // get data
        mounted() {
            axios.get(`/albumsVue/?id=${this.album}`)
                .then( response => {
                    this.images = response.data;
                })
                .catch(function (error) {
                    console.log(error);
                });
        },
    };
</script>

<style scoped>
    #photo-modal {
        font-family: Helvetica, Arial, sans-serif;
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;
        text-align: center;
        color: #2c3e50;
        margin: 2vw 4vw;
    }
    .btn {
        padding: 8px 16px;
        border-radius: 3px;
        font-size: 14px;
        cursor: pointer;
    }

    .modal-backdrop {
        position: fixed;
        top: 0;
        bottom: 0;
        left: 0;
        right: 0;
        background-color: rgba(0, 0, 0, 0.3);
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .modal-window {
        background: #ffffff;
        box-shadow: 2px 2px 20px 1px;
        overflow-x: auto;
        display: flex;
        flex-direction: column;
        position:relative;
        width: auto;
        height: auto;
    }


    .modal-body {
        position: relative;
        padding: 20px 10px;
    }

    .btn-close {
        border: none;
        font-size: 30px;
        cursor: pointer;
        font-weight: bold;
        color: #35A0CC;
        background: transparent;
        position:absolute;
        right:0;
        top:0;
    }

    .btn {
        color: white;
        background: #4aae9b;
        border: 1px solid #4aae9b;
        border-radius: 2px;
    }

    .modal-fade-enter,
    .modal-fade-leave-active {
        opacity: 0;
    }

    .modal-fade-enter-active,
    .modal-fade-leave-active {
        transition: opacity 0.5s ease;
    }
    .photo img{
        width: 450px;
        border-radius: 10px;
    }
    .photos{
      display: grid;
      grid-template-columns: 1fr 1fr 1fr;
      grid-gap: 2vw 4vw;
      justify-content: center;
      align-items: center;
    }
    .photo :hover{
        cursor: pointer;
    }
 @media (max-width: 1640px) {
    .photos{
        grid-gap: 2vw;
    }
 }
 @media (max-width: 1600px) {
    .photo img{
        width: 100%;
    }
 }

@media (max-width: 1200px) {
    .photos {
        grid-template-columns: 1fr 1fr;
    }
}
@media (max-width: 999px) {
    .photos {
        grid-template-columns: 1fr 1fr;
    }
    .photo img {
        width: 100%;
    }
    .description {
        font-size: 20px;
    }
}
@media (max-width: 767px) {
    .photos {
        grid-template-columns: 1fr;
    }

    .description {
        font-size: 18px;
    }
}
@media (max-width: 576px) {
    .description {
        font-size: 16px;
    }
}
</style>