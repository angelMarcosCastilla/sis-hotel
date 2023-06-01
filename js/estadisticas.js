import { $, ESTADOS_HABITACION } from "./utils.js";

document.addEventListener("DOMContentLoaded", () => {
  const $grafico1 = $("#grafico1");
  const $grafico2 = $("#grafico2");

  function obtenerTotalEstadosHabitacion() {
    return fetch(
      "../controllers/estadistica.controller.php?operacion=obtenerTotalEstadosHabitacion"
    )
      .then((res) => res.json())
      .then((data) => data.data);
  }

  function obtenerTotalAlquileresHoy() {
    return fetch(
      "../controllers/estadistica.controller.php?operacion=obtenerAlquileresHoy"
    )
      .then((res) => res.json())
      .then((data) => data.data);
  }

  function obtenerAlquiladasUltimaSemana() {
    return fetch(
      "../controllers/estadistica.controller.php?operacion=obtenerAlquiladasEnlaUltimaSemana"
    )
      .then((res) => res.json())
      .then((data) => data.data);
  }

  function obtenerTipoHabitacionesMasAlquiladas() {
    return fetch(
      "../controllers/estadistica.controller.php?operacion=tipoHabitacionMasAlquiladas"
    )
      .then((res) => res.json())
      .then((data) => data.data);
  }

  function obtenerDetallesCard() {
    Promise.all([
      obtenerTotalEstadosHabitacion(),
      obtenerTotalAlquileresHoy(),
      obtenerAlquiladasUltimaSemana(),
      obtenerTipoHabitacionesMasAlquiladas(),
    ]).then((res) => {
      const [
        estadosDetalles,
        alquilerHoy,
        alquiladasUltimaSemana,
        tiposHabitacionesMasAlquiladas,
      ] = res;

      // pintar cuadro de detalles
      const $cardDetalle = $("#cardDetalles");
      estadosDetalles.forEach((estado) => {
        $cardDetalle.innerHTML += `<article data-detalle="${
          estado.estadohabitacion
        }">
          <span> ${ESTADOS_HABITACION[estado.estadohabitacion].text}</span>
          ${estado.total}
        <article/>
        `;
      });

      $cardDetalle.innerHTML += `<article>
        <span>Alquiladas Hoy</span>
        ${alquilerHoy.totalAlquiler}
      <article/>
    `;

      // Pintar grafica de barras ultimos 7 dias
      const labels = alquiladasUltimaSemana.map((item) => item.fecha);
      const data = alquiladasUltimaSemana.map((item) => item.total);

      const graficoBarras = new Chart($grafico1, {
        type: "line",
        options: {
          responsive: true,
          plugins: {
            legend: {
              position: "top",
            },
            title: {
              display: true,
              text: "Total de habitaciones alquiladas en la última semana",
            },
          },
          scales: {
            y: {
              suggestedMin: 0,
              stepSize: 1,
              ticks: {
                stepSize: 1,
              },
            },
          },
        },
        data: {
          labels: labels,
          datasets: [
            {
              backgroundColor: ["#2E86C1", "#1D8348"],
              label: "Total",
              data,
            },
          ],
        },
      });

      // pintar tipo de habitaciones mas alquiladas
      const labelTipoHabitacion = tiposHabitacionesMasAlquiladas.map(
        (el) => el.nombre
      );
      const dataTipoHabitacion = tiposHabitacionesMasAlquiladas.map(
        (el) => el.total
      );

      const graficoBarras2 = new Chart($grafico2, {
        type: "pie",
        options: {
          plugins: {
            legend: {
              position: "top",
            },
            title: {
              display: true,
              text: "Tipo de habitaciones mas alquiladas",
            },
          },
        },
        data: {
          labels: labelTipoHabitacion,
          datasets: [
            {
              backgroundColor: ["#2E86C1", "#34d399", "#facc15", "#dc2626", "#8211A8"],
              label: "Tipos de habitaciones mas alquiladas",
              data: dataTipoHabitacion,
            },
          ],
        },
      });
    });
  }

  obtenerDetallesCard();
});
