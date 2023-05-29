import {$, getCurrentLocation, getThemeLocalstorage, setThemeLocalstorage} from "./utils.js"

document.addEventListener("DOMContentLoaded", ()=>{
  const currentLocation = getCurrentLocation()
  const $itemActive =  $(`[data-url=${currentLocation}]`)
  const $toggletheme =  $(`#toggleTheme`)
  
  $itemActive.classList.add("active")
  const theme = getThemeLocalstorage()
  if(theme === "dark"){
    document.documentElement.classList.add(theme)
    $toggletheme.checked = true
  }

  $toggletheme.addEventListener("change", (e) => {
    document.documentElement.classList.toggle("dark")
    const theme = e.target.checked ? "dark" : "ligth" 
    setThemeLocalstorage(theme)
  })
})