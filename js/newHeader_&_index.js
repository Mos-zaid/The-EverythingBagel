// 1. Selector
// let hamburger = document.querySelector(".site-header__hamburger");
let hamburger = document.querySelector(".hamburger-script");
let mobileMenu = document.querySelector(".mobile-menu");
let isHamburgerShowing = true;


// 2. Events
hamburger.addEventListener("click", toggleTheMenu);

// 3. Actions
function toggleTheMenu() {
    mobileMenu.classList.toggle("mobile-menu--is-active");
    if (isHamburgerShowing){
        hamburger.innerHTML = '<img src="./images/Icon/close.png" alt="" class="hamburger-style" >'
        isHamburgerShowing = false;
    }else{
        hamburger.innerHTML = '<img src="./images/Icon/Hamburger.png" alt="" class="hamburger-style" >'
        isHamburgerShowing = true;
    }
}