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
        <div class="card h-100 m-5 customCard">
            <div class="card-header w-100">
                <h1>${titulo}</h1>
                <h3>ID: ${id}</h3>
            </div>
            <div class="card-body">
                <h3>Autor: ${autor}</h3>
            </div>
            <div class="card-body">
                <p>${contenido}</p>
            </div>
             <div class="card-footer">
                <p>${fecha_creacion}</p>
             </div>
           
            </div>
        </div>

    `;
    main.appendChild(contenedorPost);
}

const data = getPost(urlAPI);
data.then((post) => {
    cargarDatos(post);
});
