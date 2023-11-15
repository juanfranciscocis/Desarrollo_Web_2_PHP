const queryString = window.location.search;
const urlParams = new URLSearchParams(queryString);
const id = urlParams.get('id');

const urlAPI = `http://localhost/Desarrollo_Web_2_PHP/api/delete.php?id=${id}`;


const main = document.getElementById("main");

const confirmar = (id) => {
    main.innerHTML = `
        <div class="card h-100 m-5 customCard">
            <div class="card-header w-100">
                <h1>¿Estás seguro de eliminar este post?</h1>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <button class="btn btn-success btn-block" onclick="eliminarPost(${id})">Confirmar</button>
                    </div>
                    <div class="col">
                        <a href="index.html" class="btn btn-danger btn-block">Cancelar</a>
                    </div>
                </div>
                
            </div>
        </div>
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