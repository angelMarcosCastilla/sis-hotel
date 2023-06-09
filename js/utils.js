export const $ = selector => document.querySelector(selector)

export const deleteExtension = (data) => {
  const newData = data.split(".").slice(0, -1)
  return newData.join("")
}

export const getCurrentLocation = () => {
  const { pathname } = location
  const currentLocation = pathname.split("/").pop()
  
  return deleteExtension(currentLocation)
}

export const setThemeLocalstorage = (theme) =>{
  localStorage.setItem("theme", theme )
}

export const getThemeLocalstorage = () => {
  try {
    const theme = localStorage.getItem("theme")
    return theme
  } catch (error) {
    return "ligth"
  }
}

export const ESTADOS_HABITACION = {
  D: {
    text: "Disponible",
    color:"var(--green-200)"
  },
  O: {
    text: "Ocupado",
    color:"var(--red-200)"
  },
  M:{
    text: "Mantenimiento",
    color:"var(--yellow-200)"
  }
}

export const getCurrentDate = () => {
  const date = new Date()
  const year = date.getFullYear()
  const month = String(date.getMonth() + 1).padStart(2, "0")
  const day = String(date.getDate()).padStart(2, "0")            
  return `${year}-${month}-${day}`
}
