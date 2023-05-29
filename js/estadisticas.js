import { $ } from "./utils.js";

document.addEventListener("DOMContentLoaded", () => {
  const $grafico1 = $("#grafico1");
  const $grafico2 = $("#grafico2");
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
});
