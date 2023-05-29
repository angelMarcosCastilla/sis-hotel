<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="../styles/base.css" />
  <link rel="stylesheet" href="../styles/main.css" />
  <link rel="stylesheet" href="../styles/library.css" />
</head>

<body>
  <?php include_once "../compents/sidebar.php" ?>
  <main>
    <?php include_once "../compents/haeader.php" ?>
  <!-- tenplet vue -->
    <div id="root">
      <div id="loading">
        loading
      </div>
      <div id="container-vue" style="display: none">
        <div class="filter-container">
          <div class="filter-items">
            <div class="filter-items">
              <label for="piso">Piso</label>
              <select name="piso" v-model="habitacionFilters.idpiso">
                <option value="">Todos</option>
                <option v-for="piso in pisos" :key="piso.idpiso" :value="piso.idpiso">{{piso.piso}}</option>
              </select>
            </div>
            <div class="filter-items">
              <label for="tipo">Tipo</label>
              <select name="tipo" v-model="habitacionFilters.idtipohabitacion">
                <option value="">Todos</option>
                <option v-for="tipo in tiposHabitaciones" :key="tipo.idtipohabitacion" :value="tipo.idtipohabitacion">{{tipo.nombre}}</option>
              </select>
            </div>
            <div class="filter-items">
            <label>Buscar</label>
            <input type="text" placeholder="numero habitación" v-model="habitacionFilters.numHabitacion">
          </div>
            <div>
              <button class="iconButton" @click="resetFilters">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-refresh-ccw"><polyline points="1 4 1 10 7 10"></polyline><polyline points="23 20 23 14 17 14"></polyline><path d="M20.49 9A9 9 0 0 0 5.64 5.64L1 10m22 4l-4.64 4.36A9 9 0 0 1 3.51 15"></path></svg></button>
            </div>
          </div>
          <div class="filter-items">
            <button class="iconButton primary" @click="openDrawer">
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg></button>
          </div>
        </div>
        <div class="table-container">
          <table class="table">
            <thead class="table-head">
              <tr>
                <th class="table__head-cell">Numero</th>
                <th class="table__head-cell">Piso</th>
                <th class="table__head-cell">Tipo</th>
                <th class="table__head-cell">precio</th>
                <th class="table__head-cell">Estado</th>
                <th class="table__head-cell">Acciones</th>
              </tr>
            </thead>
            <tbody>
              <tr class="table__body-row text-center"  v-if="habitacionesFiltradas.length === 0">
                <td class="table__body-cell" colspan="6"  >No hay habitaciones</td>
              </tr>
              <tr class="table__body-row" v-for="habitacion in habitacionesFiltradas" :key="habitacion.num">
                <td class="table__body-cell">{{habitacion.numHabitacion}}</td>
                <td class="table__body-cell">{{habitacion.piso}}</td>
                <td class="table__body-cell">{{habitacion.tipohabitacion}}</td>
                <td class="table__body-cell">{{habitacion.precio}}</td>
                <td class="table__body-cell">{{habitacion.estadohabitacion}}</td>
                <td class="table__body-cell">
                  <div class="flex">
                  <button class="iconButton delete" @click="deleteHabitacion(habitacion.idhabitacion)">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>
                  </button>
                  <button class="iconButton warning" @click="editHandler(habitacion)">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-3"><path d="M12 20h9"></path><path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"></path></svg>
                  </button>
                  </div>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
        <div class="drawer-container" id="drawer">
          <div class="drawer-container-block">
            <div class="drawer">
              <button class="iconButton" @click="closeDrawer">  
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
              </button>
              <div>
                <h3 style="margin:1.5rem 0" class="text-center">
                  {{habitacionEditar ? 'Editar habitación' : 'Registrar habitación'}}
                </h3>
                <form  @submit.prevent="registerOrEditHabitacion">
                  <div class="mb-3">
                    <label for="numHabitacion">Numero de habitación</label>
                    <input type="number" name="numHabitacion" :value="habitacionEditar ? habitacionEditar.idhabitacion : ''" >
                  </div>
                  <div class="flex mb-3">
                  <div style="flex:1">
                    <label for="piso">Piso</label>
                    <select name="piso" :value="habitacionEditar ? habitacionEditar.idpiso : pisos[0]?.idpiso">
                      <option v-for="piso in pisos" :key="piso.idpiso" :value="piso.idpiso">{{piso.piso}}</option>
                    </select>
                  </div>
                  <div style="flex:1">
                    <label for="">Tipo</label>
                    <select name="tipoHabitacion" :value="habitacionEditar ? habitacionEditar.idtipohabitacion : tiposHabitaciones[0]?.idtipohabitacion">
                      <option v-for="tipo in tiposHabitaciones" :key="tipo.idtipohabitacion" :value="tipo.idtipohabitacion">{{tipo.nombre}}</option>
                    </select>
                  </div>
                  </div>
                  <div  class="mb-3">
                    <label for="precio">Precio</label>
                    <input type="number" name="precio" :value="habitacionEditar ? habitacionEditar.precio : ''">
                  </div>
                  <div  class="mb-3">
                    <label>Detalles</label>
                    <textarea  name="detalles" id="" cols="30" rows="3" :value="habitacionEditar ? habitacionEditar.detalles : ''"></textarea>
                  </div>
                  <button>
                    {{habitacionEditar ? 'Editar' : 'Registrar'}}
                  </button>
                </form>
              </div>
            </div>
          <div>
        </div>
      </div>
    </div>
  </main>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>
  <script src="../js/main.js" type="module"></script>
  <script src="../js/habitaciones.js" type="module"></script>
</body>
</body>

</html>