<template>
    <div class="container">

        <div class="progress" style="height: 40px;">
            <div class="progress-bar" role="progressbar" :style="{ width: fileProgress + '%'}">
                {{ fileCurrent }}
            </div>
        </div>

        <hr>
        <input id="file-input" type="file" name="image" accept="image/*" multiple @change="fileInputChange" />

        <hr>

        <div class="row">
            <div class="col-sm-6">
                <h3 class="text-center">Файли у черзі ({{ filesOrder.length }}) </h3>
                <ul class="list-group">
                    <li v-bind:class="{ 'danger' : file.size >= uploadMaxFilesize,  'saccsses' : file.size < uploadMaxFilesize}" 
                        class="list-group-item" v-for="(file, index) in filesOrder" :key="index">
                        {{ file.size >= uploadMaxFilesize ? 'Файл більше 10MB видаліть його з черги' : ''}}
                        <p>{{ file.name}} : {{ file.type }}
                            <span
                                aria-hidden="true"
                                class="float-right close"
                                aria-label="Close"
                                @click="removeFile(index, 'order')"
                                >&times;
                                </span>
                        </p>
                    </li>
                </ul>
            </div>
            <div class="col-sm-6">
                <h3 class="text-center">Завантажені файли ({{ filesFinish.length }})</h3>
                <ul class="list-group">
                    <li class="list-group-item" v-for="(img, index) in filesFinish" :key="index">
                        <div class="upload-image-container">
                            <img :src="getImgPrefix(img.src)" />

                            <span
                                aria-hidden="true"
                                class="float-right close"
                                aria-label="Close"
                                @click="removeUploadImg(img, index)"
                            >
                                &times;
                            </span>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</template>

<script>
import { finished } from 'stream';
    export default {
        props: ['news_id', 'upload_photos'],
        // to do: for editing get base data from props. change file to {file, isChange: bool}
        data() {
            return  {
                // Список файлов для загрузки
                filesOrder: [],
                // Список загружених файлов
                filesFinish: [],
                // Процент загрузки файла на сервер
                fileProgress: 0,
                // Подпись файла когорый загружается
                fileCurrent: '',
                // макс размер файла 
                uploadMaxFilesize: 10485760,
                errors: [],
                // disable: true,
                newsId: this.news_id || null,
            }
        },
        mounted() {
            // disable turn back
            
            // $('#home-tab').addClass('disabled');
            // $('#home-tab').removeClass('disabled');
            
            this.displayUploadImages();
            const formNews = $('#form-news');

            formNews.on('submit', e => {
                
                e.preventDefault();
                $('#loader').removeClass('dis');
                const currPage = window.location.href;
                const form = $(e.target);
                const formData = new FormData(form[0]);
                const editorContent = CKEDITOR.instances.ckeditor.getData();
                formData.set('text', editorContent);

                const url = currPage.includes('edit') ? `/user/news/${this.newsId}` : '/user/news';
                const headers =  {
                    'content-type': 'multipart/form-data;',
                };

                axios.post(url, formData, headers)
                    .then( res => {
                        if(res.data) {
                            this.newsId = res.data;
                            document.getElementById('loader').classList.remove('dis');
                        }

                        this.uploadImages()
                            .then( () => {
                                window.location.href = '/user/news/';
                            })
                            .catch( err => {
                                console.log(`Error occurs during saving image: ${err}`)
                            });
                    })
                    .catch( err => {
                        $('#loader').addClass('dis');
                        const validationErrorStatusCode = 422;

                        const allErrorContainers = [
                            'title',
                            'text',
                            'photo',
                            'meta_keywords',
                            'meta_description'
                        ];
                        if(err.response.status === validationErrorStatusCode) {
                            const errors = err.response.data.errors;
                            const errorKeys = Object.keys(errors);

                            allErrorContainers.forEach( (errorContainer) => {
                                const className = `.${errorContainer}_error`;

                                if(errorKeys.includes(errorContainer)) {
                                    const errorText = errors[errorContainer];

                                    $(className).text(errorText);

                                    $(className).removeClass('d-none');
                                }
                                else {
                                    $(className).addClass('d-none');
                                }
                            })
                        }
                    })
            });
        },
        methods: {
            fileInputChange() {
                let files = Array.from(event.target.files);
                this.filesOrder = [...this.filesOrder, ...files]
                
                files.forEach ( ( file ) => {
                    if (file.size > this.uploadMaxFilesize) {
                        // this.errors = [ ...this.errors, ...files];
                        this.errors.push(file);
                        this.tabOff(true);
                    }
                });

                $('#file-input').val('');
            },
            async uploadImages() {
                for (let item of this.filesOrder) {
                    await this.uploadFile(item);
                }

                this.filesOrder = [];
            },
            async uploadFile(item) {
                let form = new FormData();
                form.append('image', item);
                form.append('newsid',  this.newsId );
                await axios.post('/user/news/image/upload', form, {
                    onUploadProgress: (itemUpload) => {
                        this.fileProgress = Math.round( (itemUpload.loaded / itemUpload.total) * 100 );
                        this.fileCurrent = item.name + ' ' + this.fileProgress;
                    }
                }
                )
                .then( (response) => {
                    let finishedFiles = [...this.filesFinish],
                        filesInOrderChanged = [...this.filesOrder];

                    filesInOrderChanged.splice(0, 1);
                    finishedFiles.push(item);

                    this.fileProgress = 0;
                    this.fileCurrent = '';
                    this.filesFinish = finishedFiles;
                    this.filesOrder = filesInOrderChanged;
                })
                .catch( error => {
                    console.log(error);
                })
            },
            removeFile(index, scope) {
                const filesKey = scope === 'order' ? 'filesOrder' : 'filesFinish'
                const files = [...this[filesKey]];

                 this.errors.forEach( ( element, indexFile ) => {
                    
                    if (files[index].size === element.size && files[index].name === element.name) {
                        this.errors.splice(indexFile, 1);
                    }
                });

                if (this.errors.length === 0) {
                    this.tabOff(false);
                }

                files.splice(index, 1);

                this[filesKey] = files;
            },
            displayUploadImages() {
                if(this.upload_photos) {
                    const images = JSON.parse(this.upload_photos);
                    if(images) {
                        this.filesFinish = images.map( (image) => ({id: image.id, src: image.photo}));
                    }
                }
            },
            removeUploadImg(img, index) {
                const url = '/user/news/image/destroy';
                const data = {img};

                axios.post(url, data)
                .then( (res) => {
                    this.removeFile(index, 'finish');
                })
                .catch( (err) => {
                    console.log(err);
                });
            },
            getImgPrefix(img_src = 'img/load-photo.gif') {
	            const host = window.location.origin;
	            let store;
	            if (img_src === 'img/load-photo.gif') {
		            store = `${host}/`;
	            } else {
		            store = `${host}/storage/`;
	            }
	            return `${store}${img_src}`;
            },
            tabOff(active) {
                if (active) {
                   $('#home-tab').addClass('disabled');
                } else {
                     $('#home-tab').removeClass('disabled');
                }
                
            },
            
        },
    }
</script>

<style>
    .close {
        cursor: pointer;
    }
    .upload-image-container {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    .upload-image-container img {
        width: 200px;
        height: 200px;
    }
    .danger {
        border: solid 2px red;
        margin-bottom: 5px;
    }
    .saccsses {
        margin-bottom: 5px;
        border: solid 2px greenyellow;
    }
</style>
