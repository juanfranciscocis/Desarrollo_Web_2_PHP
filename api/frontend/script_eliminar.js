const queryString = window.location.search;
const urlParams = new URLSearchParams(queryString);
const id = urlParams.get('id');

const urlAPI = `http://localhost/Desarrollo_Web_2_PHP/api/delete.php?id=${id}`;


const main = document.getElementById("main");

const confirmar = (id) => {
    main.innerHTML = `
        <h2>¿Estás seguro de eliminar el registro ${id}?</h2>
        <h3><a href="#" onclick="eliminarPost(${id})">Sí</a></h3>
        <h3><a href="index.html">No</a></h3>
    `;
}

const eliminarPost = async (id) => {
    try {
        const response = await fetch(urlAPI, {
            method: 'DELETE',
            headers: {
              "Content-Type": "application/json"
            },
            body: JSON.stringify({id: id}), // body data type must match "Content-Type" header
        });
        const res = await response.json();
        console.log(res);
        window.location.href = "index.html";
    }catch (error) {
        console.error(error);
    }
}

confirmar(id);