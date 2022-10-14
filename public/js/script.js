(function () {

    var tabla = document.getElementById('tablaProducto');

    if(tabla) {
        tabla.addEventListener('click', clickTable);
    }

    function clickTable(event) {
        var target = event.target;
        if(target.tagName === 'A' && target.getAttribute('class') === 'borrar') {
            confirmDelete(event);
        }
    }

    function confirmDelete(event) {
        if(!confirm('¿De verdad?')) {
            event.preventDefault();
        }
    }

})();