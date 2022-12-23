const input = document.querySelector('#cover');
const preview = document.querySelector('.preview');
//const old = document.querySelector('#oldCover');

const updateImageDisplay = () => {
    const curFiles = input.files;
    const image = document.createElement('img');
    image.src = window.URL.createObjectURL(curFiles[0]);
    image.setAttribute('class', 'img-thumbnail');
    image.setAttribute('id', 'preview');
    image.setAttribute('width', '300');
    
    let oldimage = document.querySelector('#preview');

    if (oldimage !== null){
        oldimage.parentNode.removeChild(oldimage);
    }
    preview.appendChild(image);
}

input.addEventListener('change', updateImageDisplay);
