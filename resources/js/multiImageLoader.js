const uploadBox = document.getElementById('uploadBox');
let uploadInputs = uploadBox.querySelectorAll('input');

console.log(uploadInputs[0]);
setInterval(function () {
    // console.log(uploadBox.querySelectorAll('input'));
    // console.log(uploadInputs[uploadInputs.length - 1].value);
    if (uploadInputs[uploadInputs.length - 1].value != "" && uploadInputs.length < 5) {
        let input = document.createElement('input');
        input.type = "file";
        input.value = "";
        input.className = 'form-control mt-2';
        input.name = "image[]";
        input.autocomplete = "image";
        uploadBox.appendChild(input);
        uploadInputs = uploadBox.querySelectorAll('input');

    }
}, 100);
