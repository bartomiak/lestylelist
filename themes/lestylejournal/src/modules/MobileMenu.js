class MobileMenu {
  constructor() {
    this.menu = document.querySelector(".mobile-nav")
    this.closeButton = document.querySelector(".mobile-nav__close-btn")
    this.openButton = document.querySelector(".mobile-nav__open-btn")
    this.events()
  }

  events() {
    this.closeButton.addEventListener("click", () => this.closeMenu())
    this.openButton.addEventListener("click", () => this.openMenu())
  }

  closeMenu() {
    this.menu.classList.add("hidden")
  }

  openMenu() {
    this.menu.classList.remove("hidden")
  }
}

export default MobileMenu
