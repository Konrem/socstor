<template>
	<transition name="modal-fade" >
	    <div class="modal-backdrop" role="dialog" >
          <div class="modal-close" @click="close"> </div>
  	        <div class="modal-window" ref="modal" v-touch:swipe.right="prevImage" v-touch:swipe.left="nextImage">
  	            <button type="button" class="btn-close btn-right" @click="close" aria-label="Close modal">
  	                &#10006;
  	            </button>
  	            <img class="foto" :src="currImg" alt="">
  	            <div class="managment-btn">
  	                <div class="round">
  	                    <button class="scroll-btn scroll-btn-left" @click="prevImage">&#9658;</button>
  	                </div>
  	                <div class="round">
  	                    <button class="scroll-btn scroll-btn-right" @click="nextImage">&#9658;</button>
  	                </div>
  	            </div>
            </div>
	       
	    </div>

	</transition>
</template>


<script>
  import Vue from 'vue'
  import Vue2TouchEvents from 'vue2-touch-events'
 
  Vue.use(Vue2TouchEvents)
	export default {
		
		props: {
			images: Array,
			defaultCurrImg: String,
			defaultIndex: Number
		},
		data() {
			const {images, defaultCurrImg, defaultIndex} = this;
			
      return {
				index: defaultIndex - 1,
				currImg: images[defaultIndex]
			};
		},
		methods: {
      consol(event){
        console.log("btn");
      },
            close(event) {
                this.$emit('close');
            },
            nextImage() {
            	// const {currImg, index} = this;
                if (this.images.length-1 > this.index){
                    this.index++;
                } else {
                  this.index = 0;
                }

                this.currImg = this.images[this.index];
            },
            prevImage() {
            	// const {currImg, index} = this;
                if (this.index>0){
                    this.index--;
                } else {
                  this.index = this.images.length-1;
                }

                this.currImg = this.images[this.index];
            }
        },
         watch:  {
            defaultIndex:function() {
              this.index=this.defaultIndex - 1;
              this.currImg= this.images[this.defaultIndex - 1];
            }
        }
	}
</script>


<style scoped>
.foto{
  max-width: 90vw;
  height: 80vh;
  width: auto;
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
  border-radius:20px;
  z-index: 99;
}
.modal-window img{
  min-height:16vw;
  max-height:50vw;
  max-width:70vw;
}
.btn-close {
  border: none;
  font-size: 22px;
  cursor: pointer;
  font-weight: bold;
  z-index:99;
  color: black;
  background: white;
  position: absolute;
  right: 20px;
  top: 13px;
  border-radius: 50%;
  width: 35px;
  height: 35px;
  text-align: center;

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
.scroll-btn{
  width: 35px;
  height: 35px;
  border-radius: 20px;
  font-size:23px;
  border: none;
  background: white;
  color: #000;
}
.round{
  border-radius: 20px;
  opacity: 1;
  width: 30px;
  height: 30px;
}
.managment-btn{
  display: flex;
  flex-direction: row;
  justify-content: space-between;
  width:94%;
  position:absolute;
  bottom:3%;
  left:3%;
}
.scroll-btn-left{
  transform: rotateY(180deg);
}
.round button{
  padding:0 8px;
}
.modal-close{
  width: 100vw;
  height: 100vh;
  position: absolute;
  z-index: -10;
}
 @media (max-width: 1000px) {
    .modal-window img{
      min-height:25vw;
      min-width:15vw;
    }
  }
  @media (max-width: 767px) {
    .modal-window img{
      max-height:100vh;
      max-width: 100vw;
      height:auto;
      width:100vw;
    }
    .managment-btn , .btn-close{
      display: none;  
    }
    .modal-backdrop{
        background-color: rgba(0, 0, 0, 1) !important;
    }
  }
</style>