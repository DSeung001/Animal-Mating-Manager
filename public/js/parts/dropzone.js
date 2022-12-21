const dropZone = document.querySelector('#drop-zone');
const dropZoneInputElement = dropZone.querySelector('input');
const dropZoneImage = dropZone.querySelector('.target-image');
const dropZoneXButton = document.querySelector('.x-button');
const fileReader = new FileReader();
let dropZoneP = dropZone.querySelector('p')

dropZoneInputElement.addEventListener('change', function (e) {
    const clickFile = this.files[0];
    if (clickFile) {
        dropZoneImage.style = "display:block;";
        dropZoneXButton.style = "display:block;";
        dropZoneP.style = 'display: none';
        const reader = new FileReader();
        reader.readAsDataURL(clickFile);
        reader.onloadend = function () {
            let src = this.result;
            dropZoneImage.src = src;
            dropZoneImage.alt = clickFile.name
        }
    }
})
dropZone.addEventListener('click', () => {
        dropZoneInputElement.click()
});
dropZone.addEventListener('dragover', (e) => {
    e.preventDefault();
});
dropZone.addEventListener('drop', (e) => {
    e.preventDefault();
    dropZoneImage.style = "display:block;";
    dropZoneXButton.style = "display:block;";
    let file = e.dataTransfer.files[0];

    fileReader.readAsDataURL(file);
    fileReader.onloadend = function () {
        e.preventDefault()
        dropZoneP.style = 'display: none;';
        let src = this.result;
        dropZoneImage.src = src;
        dropZoneImage.alt = file.name
    }
});
dropZoneXButton.addEventListener('click', (e)=>{
    console.log("hi")
    dropZoneImage.src = '';
    dropZoneImage.alt = '';
    dropZoneImage.style = "display:none;";
    dropZoneXButton.style = "display:none";
});
