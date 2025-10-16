document.addEventListener('DOMContentLoaded', function() {
    const cedulaInput = document.querySelector('input[name="cedula_p"], input[name="cedula_b"]');
    if (cedulaInput) {
        cedulaInput.addEventListener('input', function(e) {
            let value = cedulaInput.value.replace(/[^0-9a-zA-Z]/g, '').toUpperCase();
            let formatted = '';
            if (value.length > 0) formatted += value.substring(0, 3);
            if (value.length > 3) formatted += '-' + value.substring(3, 9);
            if (value.length > 9) formatted += '-' + value.substring(9, 13);
            if (value.length > 13) formatted += value.substring(13, 14);
            cedulaInput.value = formatted;
        });
    }
});

// contactos
document.addEventListener('DOMContentLoaded', function() {
    // Contactos
    const contactoInput = document.getElementById('contacto-input');
    const contactosList = document.getElementById('contactos-list');
    const addContactoBtn = document.getElementById('add-contacto');

    addContactoBtn.addEventListener('click', function() {
        if (contactoInput.value.trim() !== '') {
            const tag = document.createElement('span');
            tag.className = 'label label-info';
            tag.style.marginRight = '5px';
            tag.textContent = contactoInput.value;
            // Hidden input for form submission
            const hidden = document.createElement('input');
            hidden.type = 'hidden';
            hidden.name = 'contactos[]';
            hidden.value = contactoInput.value;
            tag.appendChild(hidden);
            // Remove button
            const remove = document.createElement('span');
            remove.textContent = ' ×';
            remove.style.cursor = 'pointer';
            remove.onclick = function() { tag.remove(); };
            tag.appendChild(remove);
            contactosList.appendChild(tag);
            contactoInput.value = '';
        }
    });

    // Emails
    const emailInput = document.getElementById('email-input');
    const emailsList = document.getElementById('emails-list');
    const addEmailBtn = document.getElementById('add-email');

    addEmailBtn.addEventListener('click', function() {
        if (emailInput.value.trim() !== '') {
            const tag = document.createElement('span');
            tag.className = 'label label-primary';
            tag.style.marginRight = '5px';
            tag.textContent = emailInput.value;
            // Hidden input for form submission
            const hidden = document.createElement('input');
            hidden.type = 'hidden';
            hidden.name = 'emails[]';
            hidden.value = emailInput.value;
            tag.appendChild(hidden);
            // Remove button
            const remove = document.createElement('span');
            remove.textContent = ' ×';
            remove.style.cursor = 'pointer';
            remove.onclick = function() { tag.remove(); };
            tag.appendChild(remove);
            emailsList.appendChild(tag);
            emailInput.value = '';
        }
    });
});

// Cordobas formato (C$).
document.addEventListener("DOMContentLoaded", function () {
    var input = document.getElementById("ingreso_economico_p");
    var maxDigits = 9; // máximo dígitos antes del punto

    input.addEventListener("input", function () {
        // Valor crudo: solo números y punto
        var raw = this.value.replace(/[^0-9.]/g, "");

        // Separar parte entera y decimales
        var parts = raw.split(".");

        // Evitar más de un punto
        if (parts.length > 2) {
            parts = [parts[0], parts[1]];
        }

        // Limitar dígitos enteros
        if (parts[0].length > maxDigits) {
            parts[0] = parts[0].substring(0, maxDigits);
        }

        // Limitar decimales a 2
        if (parts[1]) {
            parts[1] = parts[1].substring(0, 2);
        }

        // Formatear solo la parte entera
        let number = parts[0] ? parseInt(parts[0], 10) : 0;
        let formatted = number
            ? new Intl.NumberFormat("es-NI").format(number)
            : "";

        // Reconstruir con decimales si existen
        if (parts.length > 1) {
            formatted += "." + (parts[1] ?? "");
        }

        // Agregar prefijo de córdobas
        this.value = formatted ? "C$ " + formatted : "";
    });

    // Antes de enviar → limpiar el valor
    input.form.addEventListener("submit", function () {
        var cleanValue = input.value.replace(/[^0-9.]/g, "");
        input.value = cleanValue;
    });
});



//Mapeo de datos según lo seleccionado en id_lote.
document.addEventListener("DOMContentLoaded", function () {
    const select = document.getElementById("lote_id");
    const contenedor = document.getElementById("datos-lote");
    const direccion = document.getElementById("direccion_l");
    const protagonista = document.getElementById("protagonista_id");

    select.addEventListener("change", function () {
        const option = this.options[this.selectedIndex];

        if (option.value) {
            direccion.value = option.dataset.direccion || "";
            protagonista.value = option.dataset.protagonista || "";

            // mostrar con animación
            contenedor.classList.add("show");
        } else {
            // ocultar si no hay selección
            contenedor.classList.remove("show");
        }
    });
});



