<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="../styles/base.css" />
  <link rel="stylesheet" href="../styles/main.css" />
  <link rel="stylesheet" href="../styles/alquiler.css">
</head>

<body>
  <?php include_once "../compents/sidebar.php" ?>
  <main>
    <?php include_once "../compents/haeader.php" ?>
    <div id="root">
      <div id="loading">
        loading
      </div>
      <div id="container-vue" style="display: none">
        <div class="filter-container">
          <div class="filter-items">
            <div class="filter-items">
              <label for="piso">Piso</label>
              <select v-model="habitacionFilters.numpiso">
                <option name="numpiso" value="">Todos</option>
                <option value="1">Primer piso</option>
                <option value="2">Segundo piso</option>
                <option value="3">Tercer piso</option>
                <option value="4">Cuarto piso</option>
              </select>
            </div>
            <div class="filter-items">
              <label for="tipo">Tipo</label>
              <select name="tipo" v-model="habitacionFilters.idtipohabitacion">
                <option value="">Todos</option>
                <option v-for="tipo in tiposHabitaciones" :key="tipo.idtipohabitacion" :value="tipo.idtipohabitacion">
                  {{tipo.nombre}}</option>
              </select>
            </div>
            <div class="filter-items">
              <label>Buscar</label>
              <input type="text" placeholder="numero habitación" v-model="habitacionFilters.numHabitacion">
            </div>
            <div>
              <button class="iconButton" @click="resetFilters">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                  stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                  class="feather feather-refresh-ccw">
                  <polyline points="1 4 1 10 7 10"></polyline>
                  <polyline points="23 20 23 14 17 14"></polyline>
                  <path d="M20.49 9A9 9 0 0 0 5.64 5.64L1 10m22 4l-4.64 4.36A9 9 0 0 1 3.51 15"></path>
                </svg></button>
            </div>
          </div>
        </div>
        <div>
          <span v-if="habitacionesFiltradas.length === 0">Habitaciones no encontradas</span>
          <div class="grid-habitaciones">
            <habitacion-card v-for="habitacion in habitacionesFiltradas" @click="openModal(habitacion)"
              :key="habitacion.num" :habitacion="habitacion">
              <habitacion-card>
          </div>
        </div>
        <!-- modal registro alquiler -->
        <div class="container-modal" id="modal">
          <div class="content-modal">
            <button class="iconButton" @click="closeModals">
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                class="feather feather-x">
                <line x1="18" y1="6" x2="6" y2="18"></line>
                <line x1="6" y1="6" x2="18" y2="18"></line>
              </svg>
            </button>
            <div>
              <div v-if="detalleHabitacion" class="detalleHabitacion">
                <div class="registrarHabitacion-left">
                  <habitacion-detalle :habitacion="detalleHabitacion"></habitacion-detalle>
                </div>
                <div class="registrarHabitacion-right">
                  <h2>Registro Alquiler</h2>
                  <form class="formRegister">
                    <div class="formContainerRegister">
                      <!-- datos clientes -->
                      <fieldset>
                        <legend>
                          <button type="button" class="iconButton  ">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                              fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                              stroke-linejoin="round" class="feather feather-user-plus">
                              <path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                              <circle cx="8.5" cy="7" r="4"></circle>
                              <line x1="20" y1="8" x2="20" y2="14"></line>
                              <line x1="23" y1="11" x2="17" y2="11"></line>
                            </svg>
                          </button>
                          <span>Datos clientes<span>
                        </legend>
                        <div class="group-input">
                          <div>
                            <label for="tipoComprobante">Tipo Comprobante</label>
                            <select name="tipoComprobante" v-model="alquiler.tipocomprobante">
                              <option value="B">Boleta</option>
                              <option value="F">Factura</option>
                            </select>
                          </div>
                          <div class="flex-group">
                            <div>
                              <label for="" >Numero Documento</label>
                              <input type="number" placeholder="🔎 Enter Para Buscar"  v-model="alquiler.numeroDocumento" @keyup.enter="findClient" />
                            </div>
                          </div>
                        </div>
                        <div>
                          <label for="nombre" >Nombre</label>
                          <input type="text" :value="alquiler.nombreCliente" disabled />
                        </div>
                        <div>
                          <label for="nombre" >Dirección</label>
                          <input type="text" :value="alquiler.direccioncliente" disabled />
                        </div>
                      </fieldset>
                      <!-- fin datos clientes -->
                      <!-- datos Alquiler -->
                      <fieldset>
                        <legend>Datos Reservas</legend>
                        <div class="group-input">
                          <div>
                            <label for="">Fecha Entrada</label>
                            <input type="date" :value="alquiler.registroEntrada" disabled />
                          </div>
                          <div>
                            <label for="">Precio</label>
                            <input type="text" :value="detalleHabitacion.precio" disabled />
                          </div>
                        </div>
                        <div class="group-input">
                          <div>
                            <label for="">Cantidad Dias</label>
                            <input type="text"  v-model="alquiler.cantidadDias"/>
                          </div>
                          <div>
                            <label for="">Total</label>
                            <input type="text" :value="alquiler.cantidadDias ? alquiler.cantidadDias * detalleHabitacion.precio:'' " />
                          </div>
                        </div>
                      </fieldset>
                      <!-- datos Alquiler -->

                      <!-- datos Huspedes -->
                      <fieldset>
                        <legend>
                          Registro Huéspedes
                        </legend>
                        <huespedes-registrar :cantmaxpersona="detalleHabitacion.cantmaxpersona" @add-huesped="addhuesped" />
                      </fieldset>
                    </div>
                    <button type="button" class="buttonRegister" @click="createAlquiler">
                      Registrar
                    </button>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- fin modal registro alquiler -->

        <!-- modal registro salida -->
        <div class="container-modal" id="modalRegistroSalida">
          <div class="content-modal modalRegistroSalida-content">
            <button class="iconButton" @click="closeModals">
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                class="feather feather-x">
                <line x1="18" y1="6" x2="6" y2="18"></line>
                <line x1="6" y1="6" x2="18" y2="18"></line>
              </svg>
            </button>
            <div>
            <div v-if="detalleHabitacion && detalleAlquiler" class="detalleHabitacion">
                <div class="registrarHabitacion-left">
                  <habitacion-detalle :habitacion="detalleHabitacion"></habitacion-detalle> 
                </div>
                <div class="registrarHabitacion-right">
                  <div class="container-modalRegistroSalida">
                  <article>
                    <h2>Cliente</h2>
                    <p>Nombres: {{detalleAlquiler.cliente.nombre}}</p>
                    <p>N° documento: {{detalleAlquiler.cliente.numerodocumento}}</p>
                  </article>
                  <article>
                    <h2>Alquiler</h2>
                    <p>Fecha Entrada: {{detalleAlquiler.alquiler.registroentrada.split(" ").shift()}}</p>
                    <p>Cantidad Dias: {{detalleAlquiler.alquiler.cantidaddias}}</p>
                    <p>Total: {{detalleAlquiler.alquiler.total}}</p>
                  </article>
                  <article>
                    <h2>huespedes</h2>
                    <ul>
                      <li v-for="huesped in detalleAlquiler.huespedes">
                        {{huesped.nombres}} {{huesped.numerodocumento}}
                      </li>
                    </ul>
                  </article>
                  <button style="margin-top:1rem" @click="registerExit">Registrar Salida</button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- fin modal registro salida -->
      </div>
  </main>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>
  <script src="../js/main.js" type="module"></script>
  <script src="../js/alquiler.js" type="module"></script>
</body>
</body>

</html>