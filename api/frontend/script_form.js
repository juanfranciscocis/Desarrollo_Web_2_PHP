
const form = document.getElementById("form");
const titulo = document.getElementById("titulo");
const contenido = document.getElementById("contenido");
const autor = document.getElementById("autor");

const urlAPI = "http://localhost/Desarrollo_Web_2_PHP/api/post.php";


const publicar = async (url, data) => {
    try {
        const response = await fetch(url, {
            method: 'POST',
            headers: {
              "Content-Type": "application/json"
            },
            body: JSON.stringify(data), // body data type must match "Content-Type" header
        });

        const res = await response.json();
        console.log(res);

        //reset form (no value)
        form.reset();
    }catch (error) {
        console.error(error);
    }
}

form.addEventListener("submit", (e) => {
    e.preventDefault(); //no cargar formulario en blanco
    const data = {
        titulo: titulo.value.trim(),
        contenido: contenido.value.trim(),
        autor: autor.value.trim()
    }
    console.log(data);
    publicar(urlAPI, data);
});
