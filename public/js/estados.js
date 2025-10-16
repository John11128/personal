//estados Asignado de los lotes
document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll(".estado-asignado-lote").forEach(function (cell) {
        let estado = cell.textContent.trim();

        switch (estado) {
            case "Disponible":
                cell.style.backgroundColor = "#d4edda"; // verde claro
                cell.style.color = "#155724"; // verde oscuro
                break;
            case "Asignado":
                cell.style.backgroundColor = "#fff3cd"; // amarillo claro
                cell.style.color = "#856404";
                break;
            case "Pagado":
                cell.style.backgroundColor = "#cce5ff"; // azul claro
                cell.style.color = "#004085";
                break;
            case "Inactivo":
                cell.style.backgroundColor = "#f8d7da"; // rojo claro
                cell.style.color = "#721c24";
                break;
            default:
                cell.style.backgroundColor = "white";
        }

        cell.style.fontWeight = "bold";
        cell.style.textAlign = "center";
    });
});

//Estado lotes
document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll(".estado-lote").forEach(function (cell) {
        let estado = cell.textContent.trim();

        switch (estado) {
            case "Habitado":
                cell.style.backgroundColor = "#d4edda"; // verde claro
                cell.style.color = "#155724"; // verde oscuro
                break;
            case "No Habitado":
                cell.style.backgroundColor = "#fff3cd"; // amarillo claro
                cell.style.color = "#856404";
                break;
            case "En Construcción":
                cell.style.backgroundColor = "#cce5ff"; // azul claro
                cell.style.color = "#004085";
                break;
            default:
                cell.style.backgroundColor = "white";
        }

        cell.style.fontWeight = "bold";
        cell.style.textAlign = "center";
    });
});

//estado de los reportes

document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll(".estado-reportes").forEach(function (cell) {
        let estado = cell.textContent.trim();

        switch (estado) {
            case "Al dia":
                cell.style.backgroundColor = "#d4edda"; // verde claro
                cell.style.color = "#155724"; // verde oscuro
                break;
            case "Atrasado":
                cell.style.backgroundColor = "#fff3cd"; // amarillo claro
                cell.style.color = "#856404";
                break;
            case "Debe":
                cell.style.backgroundColor = "#cce5ff"; // azul claro
                cell.style.color = "#004085";
                break;
            case "Desactivado":
                cell.style.backgroundColor = "#f8d7da"; // rojo claro
                cell.style.color = "#721c24";
                break;
            case "Pagado":
                cell.style.backgroundColor = "#FFD700"; // dorado
                cell.style.color = "#228B22"; // verde
                break;
            default:
                cell.style.backgroundColor = "white";
        }

        cell.style.fontWeight = "bold";
        cell.style.textAlign = "center";
    });
});