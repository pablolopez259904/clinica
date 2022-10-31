const compra = new Carrito();
const listaCompra = document.querySelector("#lista-compra tbody");
const carrito = document.getElementById('carrito');
const procesarCompraBtn = document.getElementById('procesar-compra');
const cliente = document.getElementById('cliente');
const correo = document.getElementById('correo');


cargarEventos();

function cargarEventos() {
    document.addEventListener('DOMContentLoaded', compra.leerLocalStorageCompra());

    //Eliminar productos del carrito
    carrito.addEventListener('click', (e) => { compra.eliminarProducto(e) });

    compra.calcularTotal();

    //cuando se selecciona procesar Compra
    procesarCompraBtn.addEventListener('click', procesarCompra);

    carrito.addEventListener('change', (e) => { compra.obtenerEvento(e) });
    carrito.addEventListener('keyup', (e) => { compra.obtenerEvento(e) });

}

function procesarCompra() {
    // e.preventDefault();
    if (compra.obtenerProductosLocalStorage().length === 0) {
        Swal.fire({
            type: 'error',
            title: 'Oops...',
            text: 'No hay productos, selecciona alguno',
            showConfirmButton: false,
            timer: 2000
        }).then(function () {
            window.location = "index.php";
        })
    }
    else if (cliente.value === '' || correo.value === '') {
        Swal.fire({
            type: 'error',
            title: 'Oops...',
            text: 'Ingrese todos los campos requeridos',
            showConfirmButton: false,
            timer: 2000
        })
    }
    else {

        //aqui se coloca el user id generado en el emailJS --> Email Templates --> Settings --> Playground --> ABAJO:  emailjs.init('XXXXXXXXXXX')
        (function () {
            emailjs.init('user_GqwFWw2m0yY4yyUwhnjo4')
        })();

        //El campo {{detalleCompra}} es el que se añadió en la plantilla de emailjs 
        /* 
        Hola {{destinatario}},
        Hemos recibido tu pedido, se está preparando...
        El monto total es de {{monto}}.
        {{detalleCompra}}

        --Desarrollo web - Proyecto Clinica--
        */

        /* AGREGAR DATOS DE FORMA RAPIDA A UN TEXT AREA */
        let cadena = "";
        productosLS = compra.obtenerProductosLocalStorage();
        productosLS.forEach(function (producto) {
            cadena += `
                 Producto : ${producto.titulo}
                 Precio : ${producto.precio}
                 Cantidad: ${producto.cantidad}
                 
                `;
        });
        document.getElementById('detalleCompra').innerHTML = cadena;
        /* ------------------------- */

        var myform = $("form#procesar-pago");

        myform.submit((event) => {
            event.preventDefault();

            // Cambiar el Service_ID o bien dejar el default_service
            var service_id = "default_service"; //service_gwji72b --> Se consigue en: Email Services --> Click en un servicio de Gmail
            var template_id = "template_9sefdsn"; //Se consigue en: --> Email Templates --> Settings --> Templeta ID

            const cargandoGif = document.querySelector('#cargando');
            cargandoGif.style.display = 'block';

            const enviado = document.createElement('img');
            enviado.src = 'img/mail.gif';
            enviado.style.display = 'block';
            enviado.width = '150';

            emailjs.sendForm(service_id, template_id, myform[0])
                .then(() => {
                    cargandoGif.style.display = 'none';
                    document.querySelector('#loaders').appendChild(enviado);

                    setTimeout(() => {
                        compra.vaciarLocalStorage();
                        enviado.remove();
                        window.location = "index.php";
                    }, 2000);


                }, (err) => {
                    alert("Error al enviar el email\r\n Response:\n " + JSON.stringify(err));
                });

            return false;

        });

    }
}

