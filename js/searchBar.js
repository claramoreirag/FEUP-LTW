
console.log('hey')
let searchButton = document.querySelector('.search__button');

searchButton.onclick = function(){
    let text = document.getElementById('search__text').value

    console.log(text);
}