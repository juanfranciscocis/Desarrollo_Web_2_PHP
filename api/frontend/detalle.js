const queryString =  window.location.search;
const urlParams = new URLSearchParams(queryString);
const id = urlParams.get('id');

const urlAPI = `http://localhost/Desarrollo_Web_2_PHP/api/get.php?id=${id}`;

const main = document.getElementById("main");

const getPost = async (url) => {
    const response = await fetch(url);
    const data = await response.json();
    console.log(data);
    return data.message;
}

const cargarDatos = (post) => {
    console.log(post);
    //limpiar main
    main.innerHTML = "";
    const contenedorPost = document.createElement('div');
    const {id_publicacion, titulo,contenido,autor,fecha_creacion} = post;
    contenedorPost.innerHTML = `
        <p>${id_publicacion}</p>
        <h2>${titulo}</h2>
        <p>${contenido}</p>
        <p>${autor}</p>
        <p>${fecha_creacion}</p>
    `;
    main.appendChild(contenedorPost);
}

const data = getPost(urlAPI);
data.then((post) => {
    cargarDatos(post);
});
