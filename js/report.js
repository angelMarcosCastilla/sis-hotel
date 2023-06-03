import { $ } from "./utils.js";
document.addEventListener('DOMContentLoaded', function() {
  const $formAlquilerReport = $("#formReportAlquiler");
  const $tableReportAlquiler = $("#tableReportAlquiler");
  const $tableAlquierBody = $("#tableReportAlquiler tbody");
  const $btnExportarPdf = $("#btnExportarPdf");
  let urlSearchParams = null

  $formAlquilerReport.addEventListener("submit", function(e) {
    e.preventDefault();
    const formData = new FormData($formAlquilerReport);
    formData.append("operacion", "obtenerAlquilerEntreDosFechas");
    urlSearchParams = new URLSearchParams(formData);

    fetch(`../controllers/reportes.controller.php?${urlSearchParams}`)
      .then((res) => res.json())
      .then((data) => {
        $tableAlquierBody.innerHTML = "";
        if(data.length > 0) {
          data.forEach(alquiler => {
            $tableAlquierBody.innerHTML += `
              <tr>
                <td class="table__body-cell">${alquiler.numHabitacion}</td>
                <td class="table__body-cell">${alquiler.nombre}</td>
                <td class="table__body-cell">${alquiler.registroentrada}</td>
                <td class="table__body-cell">${alquiler.registrosalida}</td>
                <td class="table__body-cell">${alquiler.tipocomprobante}</td>
                <td class="table__body-cell">${alquiler.cliente}</td>
                <td class="table__body-cell">${alquiler.total}</td>
              </tr>
            `
          })
        }else {
          $tableAlquierBody.innerHTML = `
            <tr>
              <td colspan="8" class="text-center">No hay datos</td>
            </tr>
          `
        }
      });

  });

  $btnExportarPdf.addEventListener("click", function() {
    if(urlSearchParams !== null) {
      window.open(`../reports/alquileres/alquiler.report.php?${urlSearchParams}`, "_blank");
    }else{
      alert("No hay datos para exportar");
    }
  });
});