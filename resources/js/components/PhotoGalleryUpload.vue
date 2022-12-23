<template>
    <div>
        <h1 class="text-center">Файли Галереї</h1>
        <div class="progress" style="height: 40px;">
            <div class="progress-bar" role="progressbar" :style="{ width: fileProgress + '%'}">
                {{ fileCurrent }}
            </div>
        </div>
        <br>
        <input id="file-input" type="file" name="image" multiple @change="fileInputChange" accept="image/*" />

        <div class="row">
            <div class="col-sm-6">
                <h3 class="text-center">Файли у черзі ({{ filesOrder.length }}) </h3>
                <ul class="list-group">
                    <li v-bind:class="{ 'danger' : file.size >= uploadMaxFilesize,  'saccsses' : file.size < uploadMaxFilesize}"
                        class="list-group-item" v-for="(file, index) in filesOrder" :key="index">
                        {{ file.size >= uploadMaxFilesize ? 'Файл більше 10MB видаліть його з черги' : ''}}
                        <p>{{ file.name}}

                            <span aria-hidden="true"
                                class="float-right close"
                                aria-label="Close" @click="removeFile(index, 'order')">&times;
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
                                title="Видалити"
                                @click="removeUploadImg(img, index)"
                            >
                                &times;
                            </span>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
        <br>
        <button type="submit" class="btn btn-primary btn-block" :disabled="disable">Зберегти</button>
        <br>
    </div>
</template>

<script>
import { finished } from 'stream';
    export default {
        props:['gallery_id', 'upload_photos'],
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
                uploadMaxFilesize: 10485760,
                // Файлы которие больше допустимого
                errors: [],
                // Статус кнопки submit
                disable: true,
                galleryId: this.gallery_id || null,
            }
        },
        mounted() {
            this.displayUploadImages();
            const formAlbums = $('#form-gallery');

            formAlbums.on('submit', e => {
                e.preventDefault();

                const currPage = window.location.href;
                const form = $(e.target);
                const formData = new FormData(form[0]);

                const url = currPage.includes('edit') ? `/user/photo-gallery/${this.galleryId}` : '/user/photo-gallery';

                const headers =  {
                    'content-type': 'multipart/form-data;',
                };
                axios.post(url, formData, headers)
                    .then( res => {
                        if(res.data) {

                            this.galleryId = res.data;
                        }
                        this.uploadImages()
                            .then( () => {
                                window.location.href = '/user/photo-gallery/';
                            })
                            .catch( err => {
                                console.error(`Error occurs during saving image: ${err}`)
                            });
                    })
                    .catch( ( err ) => {
                        const validationErrorStatusCode = 422;
                        const allErrorContainers = [
                            'preview',
                            'title',
                        ];

                        if(err.response.status === validationErrorStatusCode) {
                            // to do: make validation
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
                // Отбираю файлы которые больше допустимого
                files.forEach ( ( file ) => {
                    if (file.size > this.uploadMaxFilesize) {
                        this.errors.push(file);
                        this.disable = true;
                    }
                });
                // все файлы в очередь
                this.filesOrder = [...this.filesOrder, ...files];
                
                $('#file-input').val('');
                if(this.filesOrder.length >= 0 && this.errors.length === 0) {
                    this.disable = false;
                }
            },

            async uploadImages() {
                for (let item of this.filesOrder) {
                    await this.uploadFile(item);
                }

                this.filesOrder = [];
            },
            async uploadFile(item) {
                
                let form = new FormData();
                const uploadUrl = `/user/photo-gallery/image/upload-photo`;

                form.append('image', item);
                form.append('galleryId',  this.galleryId );

                await axios.post(uploadUrl, form, {
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
                .catch( ( error ) => {
                    console.error(error);
                })
            
            },
            removeFile(index, scope) {
                const filesKey = scope === 'order' ? 'filesOrder' : 'filesFinish';
                const files = [...this[filesKey]];
                // Ищу большие файлы в массиве и удаляю
                this.errors.forEach( ( element, indexFile ) => {
                    
                    if (files[index].size === element.size && files[index].name === element.name) {
                        this.errors.splice(indexFile, 1);
                    }
                });
                // Если больших файлов не осталось, то включаем кнопку
                if (this.errors.length === 0) {
                    this.disable = false;
                }

                files.splice(index, 1);
                this[filesKey] = files;
                // Если файлов в очереди нет, то отключаю кнопку 
                if(this.filesOrder.length === 0) {
                    this.disable = true;
                }
                
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
                const url = '/user/photo-gallery/image/destroy-photo';
                const data = {img};

                axios.post(url, data)
                .then( (res) => {
                    this.removeFile(index, 'finish');
                })
                .catch( (err) => {
                    console.error(err);
                });
            },
            getImgPrefix( img_src = 'img/load-photo.gif') {
                const host = window.location.origin;
	            let store;
                if (img_src === 'img/load-photo.gif') {
                    store = `${host}/`;
                } else {
                	store = `${host}/storage/`;
                }
                return `${store}${img_src}`;
            }
        }
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
        height: auto;
    }
    .danger {
        border: solid 2px red;
        margin-bottom: 5px;
    }
    .saccsses {
        margin-bottom: 5px;
        border: solid 2px greenyellow;
        /*background-color: #00cc66;*/
        /*color: white;*/
    }
</style>
