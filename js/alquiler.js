import { $, ESTADOS_HABITACION } from "../js/utils.js";
import Modal from "./modal.js";

const { createApp } = Vue;

const App = createApp({
  data() {
    return {
      habitaciones: [],
      pisos: [],
      tiposHabitaciones: [],
      modalRegisterAlquiler: null,
      modalRegistroSalida: null,
      habitacionFilters: {
        numpiso: "",
        idtipohabitacion: "",
        numHabitacion: "",
      },
      detalleHabitacion: null,
      alquiler: {
        tipocomprobante: "B",
        numeroDocumento: "",
        idEmpresa: "",
        idpersona: "",
        nombreCliente: "",
        direccioncliente: "",
        registroEntrada: new Date().toISOString().split("T").shift(),
        cantidadDias: "",
        detalleshuesped: "",
      },
      detalleAlquiler: null,
    };
  },
  methods: {
    addhuesped(huespedes) {
      console.log(huespedes);
      const idsHuspedes = huespedes
        .map((huesped) => huesped.idpersona)
        .join(",");
      this.alquiler.detalleshuesped = idsHuspedes;
    },

    openModal(detalleHabitacion) {
      this.detalleHabitacion = detalleHabitacion;
      if (detalleHabitacion.estadohabitacion === "D") {
        this.modalRegisterAlquiler.open();
      } else if (detalleHabitacion.estadohabitacion === "O") {
        this.modalRegistroSalida.open();
        this.getDetailsAlquiler(detalleHabitacion.idhabitacion).then((res) => {
          this.detalleAlquiler = res;
        });
      } else {
        Swal.fire({
          title: "¿Deseas Actualizar el estado de la habitación ",
          icon: "warning",
          showCancelButton: true,
          confirmButtonText: "Si, continuar",
        }).then((result) => {
          if (result.isConfirmed) {
            fetch("../controllers/alquiler.controller.php", {
              method: "POST",
              body: new URLSearchParams({
                operacion: "actualizarHabitacionADisponible",
                idHabitacion: detalleHabitacion.idhabitacion,
              }),
            })
              .then((res) => res.json())
              .then((data) => {
                if (data.success) {
                  Swal.fire("Actualizado!", data.message, "success").then(
                    () => {
                      this.getHabitaciones();
                    }
                  );
                } else {
                  alert("Error ");
                }
              });
          }
        });
      }
    },

    closeModals() {
      this.modalRegisterAlquiler.close();
      this.modalRegistroSalida.close();
      this.detalleHabitacion = null;
      this.resetDatosAlquiler();
    },

    resetDatosAlquiler() {
      this.alquiler.tipocomprobante = "B";
      this.alquiler.numeroDocumento = "";
      this.alquiler.idEmpresa = "";
      this.alquiler.idpersona = "";
      this.alquiler.nombreCliente = "";
      this.alquiler.direccioncliente = "";
      this.alquiler.registroEntrada = "";
      (this.alquiler.cantidadDias = ""), (this.alquiler.detalleshuesped = "");
    },

    resetFilters() {
      this.habitacionFilters = {
        numpiso: "",
        idtipohabitacion: "",
        numHabitacion: "",
      };
    },

    async getDetailsAlquiler(idHabitacion) {
      const formData = new URLSearchParams();
      formData.append("operacion", "ObteberDetalleAlquiler");
      formData.append("idHabitacion", idHabitacion);
      const res = await fetch("../controllers/alquiler.controller.php", {
        method: "POST",
        body: formData,
      });
      const { data } = await res.json();
      return data;
    },

    async findClient() {
      if (String(this.alquiler.numeroDocumento).length < 12) {
        const formData = new URLSearchParams();
        formData.append("operacion", "buscarCliente");
        formData.append("tipoComprobante", this.alquiler.tipocomprobante);
        formData.append("numeroDocumento", this.alquiler.numeroDocumento);
        fetch("../controllers/alquiler.controller.php", {
          method: "POST",
          body: formData,
        })
          .then((res) => res.json())
          .then(({ data }) => {
            this.alquiler.nombreCliente = data.nombre;
            this.alquiler.direccioncliente = data.direccion;
            if (this.alquiler.tipocomprobante === "B") {
              this.alquiler.idpersona = data.id;
            } else {
              this.alquiler.idEmpresa = data.id;
            }
          });
      } else {
        alert("error me muero", "buscarCliente");
      }
    },

    async createAlquiler() {
      const formData = new FormData();
      formData.append("operacion", "alquilar");
      formData.append("idPersona", this.alquiler.idpersona);
      formData.append("idEmpresa", this.alquiler.idEmpresa);
      formData.append("idHabitacion", this.detalleHabitacion.idhabitacion);
      formData.append("registroEntrada", this.alquiler.registroEntrada);
      formData.append("cantidadDias", this.alquiler.cantidadDias);
      formData.append("precio", this.detalleHabitacion.precio);
      formData.append("tipoComprobante", this.alquiler.tipocomprobante);
      formData.append("huespedes", this.alquiler.detalleshuesped);

      fetch("../controllers/alquiler.controller.php", {
        method: "POST",
        body: formData,
      })
        .then((res) => res.json())
        .then((data) => {
          if (data.success) {
            Swal.fire("Creado!", data.message, "success").then(() => {
              this.getHabitaciones();
              this.closeModals();
            });
          } else {
            alert("Error PAPIIIIIIIII!");
          }
        });
    },

    async getHabitaciones() {
      const body = new URLSearchParams();
      body.append("operacion", "listar");
      const res = await fetch("../controllers/habitaciones.controller.php", {
        method: "POST",
        body: body,
      });
      const { data } = await res.json();
      this.habitaciones = data;
    },

    async getTiposHabitaciones() {
      const response = await fetch(
        "../controllers/listado.controller.php?operacion=listarTipoHabitaciones"
      );
      const { data } = await response.json();
      this.tiposHabitaciones = data;
    },

    async registerExit() {
      const body = new URLSearchParams({
        operacion: "registrarSalida",
        idHabitacion: this.detalleHabitacion.idhabitacion,
        idAlquiler: this.detalleAlquiler.alquiler.idalquiler,
      });
      try {
        const res = await fetch("../controllers/alquiler.controller.php", {
          method: "POST",
          body,
        });
        const { success, message } = await res.json();
        if (success) {
          Swal.fire("Correcto!", message, "success").then(() => {
            this.getHabitaciones();
            this.closeModals();
          });
        } else {
          Swal.fire("Error!", message, "error").then(() => {
            this.getHabitaciones();
            this.closeModals();
          });
        }
      } catch (error) {
        console.log(error);
      }
    },
  },

  async mounted() {
    Promise.all([this.getHabitaciones(), this.getTiposHabitaciones()]).then(
      (res) => {
        $("#loading").style.display = "none";
        $("#container-vue").style.display = "block";
        this.modalRegisterAlquiler = new Modal("modal");
        this.modalRegistroSalida = new Modal("modalRegistroSalida");
      }
    );
  },

  computed: {
    habitacionesFiltradas() {
      const isEmptyFileters = Object.values(this.habitacionFilters).every(
        (filter) => filter === ""
      );
      if (isEmptyFileters) return this.habitaciones;

      const filteredValues = Object.entries(this.habitacionFilters).filter(
        ([_, value]) => value !== ""
      );

      return this.habitaciones.filter((habitacion) => {
        return filteredValues.every(([key, value]) => habitacion[key] == value);
      });
    },
  },
});

App.component("habitacion-card", {
  props: ["habitacion"],
  computed: {
    styleCard() {
      const { estadohabitacion } = this.habitacion;
      const color = ESTADOS_HABITACION[estadohabitacion].color;
      return {
        borderLeft: `4px solid ${color}`,
      };
    },
    textEstadoHabitacion() {
      const { estadohabitacion } = this.habitacion;
      return ESTADOS_HABITACION[estadohabitacion].text;
    },
    badgeColor() {
      const { estadohabitacion } = this.habitacion;
      if (estadohabitacion === "D") return "card-estado badge success";
      if (estadohabitacion === "M") return "card-estado badge warning";
      if (estadohabitacion === "O") return "card-estado badge danger";
      return "card-estado badge ";
    },
  },
  template: `
    <article class="card" :style="styleCard" >
      <h2 class="card-title">
        <span>
          NRO: {{habitacion.numHabitacion}}
        </span>
        <span class="card-tipo">  {{habitacion.tipohabitacion}}</span>
      </h2>
      <span class="card-subtitle"> {{habitacion.numpiso}}</span>
      <span :class="badgeColor">
        {{textEstadoHabitacion}}</span>
      <span class="card-subtitle">
        <span> {{habitacion.precio}}</span>
      </span>
    </article>
  `,
});

App.component("habitacion-detalle", {
  props: ["habitacion"],
  template: `
    <div>
      <h2 style="text-align:center; ">Detalles</h2>
      <div style="text-align:center;  margin-bottom:2rem">
        <svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" viewBox="0 0 24 24" style="fill: currentColor ;transform: ;msFilter:;"><path d="M20 9.557V3h-2v2H6V3H4v6.557C2.81 10.25 2 11.525 2 13v4a1 1 0 0 0 1 1h1v4h2v-4h12v4h2v-4h1a1 1 0 0 0 1-1v-4c0-1.475-.811-2.75-2-3.443zM18 7v2h-5V7h5zM6 7h5v2H6V7zm14 9H4v-3c0-1.103.897-2 2-2h12c1.103 0 2 .897 2 2v3z"></path></svg>
        <p>Num°: {{habitacion.numHabitacion}}<p/>
        <p> {{habitacion.detalles}}</p>
      </div>
      <div style="padding-left:1rem">
        <p>Tipo: {{habitacion.tipohabitacion}}</p>
        <p>Piso: {{habitacion.numpiso}}</p>
        <p>Precio: {{habitacion.precio}}</p>
        <p>Personas: {{habitacion.cantmaxpersona}}</p>
      </div>
    </div>
  `,
});

App.component("huespedes-registrar", {
  props: ["cantmaxpersona"],
  data() {
    return {
      numeroDocumento: "",
      huespedes: [],
    };
  },
  methods: {
    addHusped() {
      if (this.huespedes.length >= this.cantmaxpersona) return;
      const formData = new FormData();
      formData.append("operacion", "buscarHuesped");
      formData.append("numeroDocumento", this.numeroDocumento);
      fetch("../controllers/alquiler.controller.php", {
        method: "POST",
        body: formData,
      })
        .then((res) => res.json())
        .then(({ data }) => {
          this.huespedes.push(data);
          this.$emit("add-huesped", this.huespedes);
          this.numeroDocumento = "";
        });
    },

    deleteHusped(dni) {
      const newHusped = this.huespedes.filter(
        (huesped) => huesped.numerodocumento !== dni
      );
      console.log(newHusped);
      this.huespedes = newHusped;
    },
  },
  template: `
  <div>
    <div class="agregarHuesped">
      <input type="text" v-model="numeroDocumento" placeholder="N° Documento" />
      <button type="button" @click="addHusped">Buscar</button>
    </div>
    <div class="table-container">
      <table class="table">
        <thead class="table-head">
          <tr>
            <th class="table__head-cell">N° Documento</th>
            <th class="table__head-cell">Nombres</th>
            <th class="table__head-cell">Apellidos</th>
            <th class="table__head-cell"></th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="(huesped,index) in huespedes" :key="index">
            <td class="table__body-cell">{{huesped.numerodocumento}}</td>
            <td class="table__body-cell">{{huesped.nombres}}</td>
            <td class="table__body-cell">{{huesped.apellidos}}</td>
            <td class="table__body-cell">
              <button type="button" class="iconButton" @click="deleteHusped(huesped.numerodocumento)">x</button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
  `,
});

App.mount("#root");
