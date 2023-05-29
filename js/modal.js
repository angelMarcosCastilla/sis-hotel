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
    }
  
    close() {
      this._open = false;
      this._modalDom.classList.remove("open");
    }
}

export default Modal;