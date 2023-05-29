import Drawer from "./drawer.js";
import { $ } from "../js/utils.js"
const { createApp } = Vue;

const App = createApp({
  data() {
    return {
      habitaciones: [],
      tiposHabitaciones: [],
      drawer: null,
      habitacionEditar: null,
      habitacionFilters: {
        numpiso: "",
        idtipohabitacion: "",
        numHabitacion: "",
      },
    };
  },
  methods: {
    openDrawer() {
      this.drawer.open();
    },

    closeDrawer() {
      this.drawer.close();
      this.habitacionEditar = null;
    },

    resetFilters() {
      this.habitacionFilters = {
        numpiso: "",
        idtipohabitacion: "",
        numHabitacion: "",
      };
    },

    editHandler(habitacion) {
      this.habitacionEditar = habitacion;
      this.openDrawer();
    },

    deleteHabitacion(idhabitacion) {
      Swal.fire({
        title: "Estas Seguro de eliminar?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Si, Eliminar!",
      }).then((result) => {
        if (result.isConfirmed) {
          const data = new FormData();
          data.append("operacion", "eliminar");
          data.append("idHabitacion", idhabitacion);
          fetch("../controllers/habitaciones.controller.php", {
            method: "POST",
            body: data,
          })
            .then((res) => res.json())
            .then((data) => {
              if (data.success) {
                Swal.fire(
                  "Deleted!",
                  "el registro se elimino correctamente",
                  "success"
                ).then(() => {
                  this.getHabitaciones();
                });
              }
            })
            .catch((err) => {
              Swal.fire("Error!", "Error Al Eliminar Habitacion!", "error");
            });
        }
      });
    },

    registerOrEditHabitacion(e) {
      const data = new FormData(e.target);
      
      if(this.habitacionEditar){
        data.append("operacion", "editar");
        data.append("idHabitacion", this.habitacionEditar.idhabitacion);
      }else{
        data.append("operacion", "registrar");
        console.log(Object.fromEntries(data.entries()))
      }

      fetch("../controllers/habitaciones.controller.php", {
        method: "POST",
        body: data,
      })
        .then((res) => res.json())
        .then((data) => {
          if (data.success) {
            Swal.fire("Correcto !!", data.message, "success").then(
              () => {
                this.getHabitaciones();
                this.closeDrawer();
                e.target.reset();
              }
            );
          }else{
            Swal.fire("Error!", data.message, "error");
          }
        })
        .catch((err) => {
          Swal.fire("Error!", "Hay un error al realizar la operacion", "error");
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
  },

  async mounted() {
    Promise.all([
      this.getHabitaciones(),
      this.getTiposHabitaciones(),
    ]).then((res) => {
      this.drawer = new Drawer("drawer");
      $("#loading").style.display = "none";
      $("#container-vue").style.display = "block";
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

App.mount("#root");
