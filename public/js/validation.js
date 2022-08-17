function letters(e) {
    key = e.keyCode || e.which;
    tecla = String.fromCharCode(key).toString();
    letras =
        " áéíóúabcdefghijklmnñopqrstuvwxyzÁÉÍÓÚABCDEFGHIJKLMNÑOPQRSTUVWXYZ"; //Se define todo el abecedario que se quiere que se muestre.
    especiales = [8, 37, 39, 46, 6]; //Es la validación del KeyCodes, que teclas recibe el campo de texto.

    tecla_especial = false;
    for (var i in especiales) {
        if (key == especiales[i]) {
            tecla_especial = true;
            break;
        }
    }
    if (letras.indexOf(tecla) == -1 && !tecla_especial) {
        return false;
    }
}

function numbers(e) {
    var keynum = window.event ? window.event.keyCode : e.which;
    if (keynum == 8 || keynum == 46) return true;
    return /\d/.test(String.fromCharCode(keynum));
}
