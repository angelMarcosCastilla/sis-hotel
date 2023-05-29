class Drawer {
  _open = false;
  _drawerDom = null

  constructor(id) {
    this._open = false;
    this._drawerDom = document.getElementById(id);
  }

  open() {
    this._open = true;
    this._drawerDom.classList.add("open");
    document.documentElement.style.overflow = "hidden";
  }

  close() {
    this._open = false;
    this._drawerDom.classList.remove("open");
    document.documentElement.style.overflow = "auto";
  }
}

export default Drawer;