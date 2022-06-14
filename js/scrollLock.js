// When the user scrolls the page, execute lockUnlock
window.onscroll = function() {lockUnlock()};

// Get the Header
let header = document.getElementById('header');

// Get the offset position of the navbar
var offSet = header.offsetTop;
// Add the fixed__scroll to the header when the user reachs its scroll position.
// Remove fixed__scroll when you leave the scroll position

function lockUnlock() {
    if(window.pageYOffset > offSet){
        header.classList.add("fixed__scroll");
    }
    else{
        header.classList.remove("fixed__scroll");
    }
}