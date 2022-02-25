// 1. Selector
// let hamburger = document.querySelector(".site-header__hamburger");
let hamburger = document.queryCommandValue(".hamburger-script");
let isHamburgerShowing = true;

// 2. Events
hamburger.addEventListener("click", alert("Hello") );

// 3. Actions
// function toggleTheMenu() {
//     mobileMenu.classList.toggle("site-header__nav-links__is-active");
//     if (isHamburgerShowing){
//         hamburger.innerHTML = '<img src="./images/icon-close.svg" alt="">'
//         isHamburgerShowing = false;
//     }else{
//         hamburger.innerHTML = '<img src="./images/icon-hamburger.svg" alt="">'
//         isHamburgerShowing = true;
//     }
// }