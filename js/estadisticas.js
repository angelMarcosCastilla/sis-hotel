import { $, ESTADOS_HABITACION } from "./utils.js";

document.addEventListener("DOMContentLoaded", () => {
  const $grafico1 = $("#grafico1");
  const $grafico2 = $("#grafico2");

  function obtenerTotalEstadosHabitacion(){
    return fetch("../controllers/estadistica.controller.php?operacion=obtenerTotalEstadosHabitacion")
    .then(res => res.json())
    .then(data => data.data)
  }

  function obtenerTotalAlquileresHoy(){
    return fetch("../controllers/estadistica.controller.php?operacion=obtenerAlquileresHoy")
    .then(res => res.json())
    .then(data => data.data)
  }

  function obtenerDetallesCard(){
    Promise.all([obtenerTotalEstadosHabitacion(),obtenerTotalAlquileresHoy()])
    .then(([estadosDetalles, alquilerHoy]) =>{
      const $cardDetalle = $("#cardDetalles")
      estadosDetalles.forEach(estado => {
        $cardDetalle.innerHTML += 
        `<article data-detalle="${estado.estadohabitacion}">
         <span> ${ESTADOS_HABITACION[estado.estadohabitacion].text}</span>
          ${estado.total}
        <article/>
        `
      })

      $cardDetalle.innerHTML +=`<article>
        <span>Alquiladas Hoy</span>
        ${alquilerHoy.totalAlquiler}
      <article/>
    `
    })
  }

  const graficoBarras = new Chart($grafico1, {
    type: "pie",
    data: {
      labels: ["Ingeniería en Sistemas", "Ingeniería en Alimentos"],
      datasets: [
        {
          backgroundColor: ["#2E86C1", "#1D8348"],
          label: "Postulantes",
          data: [12, 19],
        },
      ],
    },
  });

  const graficoBarras2 = new Chart($grafico2, {
    type: "pie",
    data: {
      labels: ["Ingeniería en Sistemas", "Ingeniería en Alimentos"],
      datasets: [
        {
          backgroundColor: ["#2E86C1", "#1D8348"],
          label: "Postulantes",
          data: [12, 19],
        },
      ],
    },
  });

  obtenerDetallesCard();

});
