import { $, ESTADOS_HABITACION } from "../js/utils.js";
import Modal from "./modal.js"

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
    };
  },
  methods: {
    openModal(detalleHabitacion) {
      this.detalleHabitacion = detalleHabitacion;

      if(detalleHabitacion.estadohabitacion === "D"){

        this.modalRegisterAlquiler.open();

      }else if(detalleHabitacion.estadohabitacion === "O"){
        this.modalRegistroSalida.open();

      }else {
        Swal.fire({
          title: 'Are you sure?',
          text: "You won't be able to revert this!",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonText: 'Si, continuar',
        }).then((result) => {
          if (result.isConfirmed) {
            Swal.fire(
              'Deleted!',
              'Your file has been deleted.',
              'success'
            )
          }
        })
      }
    },

    closeModals() {
      this.modalRegisterAlquiler.close();
      this.modalRegistroSalida.close();
      this.detalleHabitacion = null;
    },

    resetFilters() {
      this.habitacionFilters = {
        numpiso: "",
        idtipohabitacion: "",
        numHabitacion: "",
      };
    },

    async createAlquiler(){
       /*  const res = await fetch("../controllers/alquiler.controller.php") */
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
  },

  async mounted() {
    Promise.all([
      this.getHabitaciones(),
      this.getTiposHabitaciones(),
    ]).then((res) => {
      $("#loading").style.display = "none";
      $("#container-vue").style.display = "block";
      this.modalRegisterAlquiler = new Modal("modal");
      this.modalRegistroSalida = new Modal("modalRegistroSalida");
    });
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
        return filteredValues.every(
          ([key, value]) => habitacion[key] == value
        );
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
      if(estadohabitacion === "D") return "card-estado badge success";
      if(estadohabitacion === "M") return "card-estado badge warning";
      if(estadohabitacion === "O") return "card-estado badge danger";
      return "card-estado badge "
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

App.component("huespedes-registrar",{
  props:["cantmaxpersona"],
  data(){
    return{
      numeroDocumento:"",
      huespedes:[],
    }
  },
  methods:{
    addHusped(){
      if(this.huespedes.length >= this.cantmaxpersona) return;
      const huesped = {
        dni:"asadasdas",
        nombres:"asdasdasd",
        apellido:"asdasdas"
      }
      this.huespedes.push(huesped);
      this.numeroDocumento = "";
    },

    deleteHusped(dni){
      const newHusped = this.huespedes.filter(huesped => huesped !== dni)
      console.log(newHusped)
      this.huespedes = newHusped
    }
  },
  template:`
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
            <td class="table__body-cell">{{huesped.dni}}</td>
            <td class="table__body-cell">{{huesped.nombres}}</td>
            <td class="table__body-cell">{{huesped.apellido}}</td>
            <td class="table__body-cell">
              <button type="button" class="iconButton" @click="deleteHusped(huesped.dni)">x</button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
  `,
})

App.mount("#root");
