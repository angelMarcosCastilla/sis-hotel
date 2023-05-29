import {$} from "./utils.js"

document.addEventListener("DOMContentLoaded", () => {
  const $form = $("#formLogin")

  // ======== functions =============
  function login() {
    const data = new FormData($form)
    data.append("operacion", "iniciarSesion")

    const url = new URLSearchParams(data)

    fetch(`./controllers/user.controller.php?${url.toString()}`)
      .then(res => res.json())
      .then(data => {
        console.log(data)
        if (data.login) {
          location.href = "./views/estadisticas.php"
        }else{
          Toastify({
            text: data.mensaje,
            duration: 3000,
            close: true,
            gravity: "top",
            position: "center", 
            stopOnFocus: true, 
            style: {
              background: "linear-gradient(135deg, #F92501, #AE185A)",
            },
            onClick: function(){} // Callback after click
          }).showToast();
        }
      })
      .catch(err => {
        console.log(err)
      })

  }

  //============ eventos ===========
  $form.addEventListener("submit", (e) => {
    e.preventDefault();
    login();
  })
})