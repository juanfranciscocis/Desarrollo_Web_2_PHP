
const urlAPI = "http://localhost/Desarrollo_Web_2_PHP/api/get.php";

const tabla = document.getElementById("tablaDatos");

const getData = async (url) => {
    const response = await fetch(url);
    const data = await response.json();
    console.log(data.message)
    cargarDatos(data.message);
}



const cargarDatos = (posts) => {
    //ELIMINAR TABLA
    console.log(posts);
    posts.forEach((post) => {
        const {id_publicacion, titulo,contenido,autor,fecha_creacion} = post;
        const contenedorFila = document.createElement('tr');
        contenedorFila.innerHTML = `
            <td><a href="detalle.html?id=${id_publicacion}">${id_publicacion}</a></td>
            <td>${titulo}</td>
            <td>${contenido}</td>
            <td>${autor}</td>
            <td>${fecha_creacion}</td>
            <td><a href="editar.html?id=${id_publicacion}"> 📝</a></td>
            <td><a href="eliminar.html?id=${id_publicacion}"> 🗑️</a></td>
        `;
        console.log(contenedorFila);
        tabla.appendChild(contenedorFila);
    });
}

getData(urlAPI);