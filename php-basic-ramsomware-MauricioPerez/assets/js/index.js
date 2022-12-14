const dropArea = document.querySelector(".drag-area")
const dragText = dropArea.querySelector("h2")
const button = dropArea.querySelector("button")
//const input = dropArea.querySelector("#input-file")

const inputMultiple = document.getElementById("input-file")

let files;

button.addEventListener("click", e => {
    inputMultiple.click()
}, false)


inputMultiple.addEventListener('change', e => {
    files = this.files
    dropArea.classList.add("active")
    showFiles(files)
    dropArea.classList.remove("active")
})

dropArea.addEventListener("dragover", (e) => {
    e.preventDefault()
    dropArea.classList.add("active")
    dragText.textContent = "Suelta para subir los archivos"
})

dropArea.addEventListener("dragleave", (e) => {
    e.preventDefault()
    dropArea.classList.remove("active")
    dragText.textContent = "Arrastra y suelta tus archivos encriptados"
})

dropArea.addEventListener("drop", (e) => {
    e.preventDefault()
    files = e.dataTransfer.files
    showFiles(files)
    dropArea.classList.remove("active")
    dragText.textContent = "Arrastra y suelta tus archivos encriptados"
})





function showFiles(files) {
    if(files.length === undefined) {
        processFile(files)
    } else {
        for(const file of files) {
            processFile(file);
        }
    }
}


function processFile(file) {
    const docType = file.type
    
    const fileReader = new FileReader()
    const id = 	`file-${Math.random().toString(32).substring(7)}`
    
    fileReader.addEventListener("load", e=> {
        const fileUrl = fileReader.result
        const fileStatus = 
        `
        <div id="${id}" class="file-container">
            <div class="status">
                <span>${file.name}</span>
                <span class="status-text">
                    Loading...
                </span>
            </div>
        </div>
        `

        const html =  document.querySelector("#preview").innerHTML
        document.querySelector("#preview").innerHTML = fileStatus + html
    }, false)

    fileReader.readAsDataURL(file)
    //uploadFile(file, id)
}

/*function uploadFile(file, id){
    const formData =  new FormData()
    formData.append("file", file)

    try {
        const response = await fetch("http://localhost/upload", {
            method: "POST",
            body: formData,
        })
        
        const responseText = await response.text()
        console.log(responseText)

        document.querySelector(`#${id} .status-text`).innerHTML = `<span class ="success"> Archivo subido correctamente... </span>`;
    } catch(error) {
        document.querySelector(`#${id} .status-text`).innerHTML = `<span class ="success"> El archivo no pudo abrirse... </span>`;
    }
}*/