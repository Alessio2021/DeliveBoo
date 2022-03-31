const uploadInputFirst = document.getElementById('-1');
const uploadImageBox = document.getElementById('show-images');
const uploadInputBox = document.getElementById('show-input-image-upload');
let index = 1;

function readURL() {
    if (this.files && this.files[0]) {
        const reader = new FileReader();
        this.className = "d-none";
        const imgBox = document.createElement('div');
        imgBox.classList = "col-3 d-flex align-items-center position-relative";

        const img = document.createElement('img');
        img.classList = "w-100";
        imgBox.appendChild(img);
        imgBox.id = index;
        index++;

        const i = document.createElement('i');
        i.classList = "fs-2 me-4 mt-1 text-danger fas fa-times position-absolute top-0 end-0";
        imgBox.appendChild(i);
        
        i.addEventListener('click', deleteImage);

        uploadImageBox.appendChild(imgBox);

        reader.onload = function (e) {
            img.src = e.target.result;
        };

        reader.readAsDataURL(this.files[0]);
        
        if (uploadImageBox.childElementCount < 4) {           
            const input = document.createElement('input');
            input.id = -1 * index;
            input.type = "file";
            input.value = "";
            input.className = 'form-control mt-2';
            input.name = "image[]";
            input.autocomplete = "image";
            input.addEventListener('change', readURL);
            uploadInputBox.appendChild(input);    
        }
    }
}


function deleteImage() {
    document.getElementById(-1 * this.parentNode.id).remove();
    this.parentNode.remove();
    console.log(uploadInputBox.querySelectorAll('input.d-none').length);
        if (uploadImageBox.childElementCount < 4 && uploadInputBox.querySelectorAll('input:not(.d-none)').length == 0) {           
        const input = document.createElement('input');
        input.id = -1 * index;
        input.type = "file";
        input.value = "";
        input.className = 'form-control mt-2';
        input.name = "image[]";
        input.autocomplete = "image";
        input.addEventListener('change', readURL);
        uploadInputBox.appendChild(input);    
    }
}


uploadInputFirst.addEventListener('change', readURL);
