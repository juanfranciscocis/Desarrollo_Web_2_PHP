const queryString = window.location.search;
const urlParams = new URLSearchParams(queryString);
const id = urlParams.get('id');

const urlAPI = `http://localhost/Desarrollo_Web_2_PHP/api/get.php?id=${id}`;
const urlEdit = `http://localhost/Desarrollo_Web_2_PHP/api/put.php`;



const form = document.getElementById("form");
const titulo = document.getElementById("titulo");
const contenido = document.getElementById("contenido");
const autor = document.getElementById("autor");


const getPost = async (url) => {
    const response = await fetch(url);
    const data = await response.json();
    console.log(data);
    return data.message;
}

const cargarDatos = (post) => {
    const {id_publicacion, titulo,contenido,autor,fecha_creacion} = post;
    this.titulo.value = titulo;
    this.contenido.value = contenido;
    this.autor.value = autor;
}

const data = getPost(urlAPI);
data.then((post) => {
    cargarDatos(post);
});



//ACTUALIZAR
const actualizar = async (url, data) => {
    try {
        const response = await fetch(url, {
            method: 'PUT',
            headers: {
              "Content-Type": "application/json"
            },
            body: JSON.stringify(data), // body data type must match "Content-Type" header
        });

        const res = await response.json();
        console.log(res);
    }catch (error) {
        console.error(error);
    }
}

form.addEventListener("submit", (e) => {
    e.preventDefault(); //no cargar formulario en blanco
    const data = {
        id: id,
        titulo: titulo.value.trim(),
        contenido: contenido.value.trim(),
        autor: autor.value.trim()
    }
    console.log(data);
    return actualizar(urlEdit, data);
});











