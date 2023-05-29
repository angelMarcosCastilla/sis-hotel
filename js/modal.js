class Modal {
    _open = false;
    _modalDom = null
  
    constructor(id) {
      this._open = false;
      this._modalDom = document.getElementById(id);
    }
    
    open() {
      this._open = true;
      this._modalDom.classList.add("open");
      document.documentElement.style.overflow = "hidden";
    }
  
    close() {
      this._open = false;
      this._modalDom.classList.remove("open");
      document.documentElement.style.overflow = "auto";
    }
}

export default Modal;