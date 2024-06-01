const poster = document.getElementById('poster');
const height = poster.clientHeight;
const width = poster.clientWidth;
poster.addEventListener("mousemove", (evt)=>{
    const {layerX, layerY} = evt;
    const rotacionY = (
        (layerX - width / 2) / width
    ) * 20;
    const rotacionX = (
        (layerY - height / 2) / height
    ) * 20;
    const perspectivaPoster = 
        `perspective(1000em)
        scale(1.01)
        rotateX(${rotacionX /2}deg)
        rotateY(${rotacionY / 2}deg)`;
    poster.style.transform = perspectivaPoster;
});
poster.addEventListener("mouseout", ()=>{
    poster.style.transform = `
        perspective(1000em)
        scale(1)
        rotateX(0)
        rotateY(0)`;
});

/*Buscador*/

document.getElementById('searchForm').addEventListener('submit', function(event) {
    event.preventDefault();
    const query = document.getElementById('searchInput').value.trim().toLowerCase();
    if (query) {
        searchInDOM(query);
    } else {
        alert('Por favor, ingrese un término de búsqueda.');
    }
});

function searchInDOM(query) {
    const highlightedElements = document.querySelectorAll('.highlight');
    highlightedElements.forEach(el => {
        const parent = el.parentNode;
        parent.replaceChild(document.createTextNode(el.textContent), el);
        parent.normalize();
    });

    const bodyText = document.body.innerHTML;
    const regex = new RegExp(`(${query})`, 'gi');
    document.body.innerHTML = bodyText.replace(regex, '<span class="highlight">$1</span>');
}

const deporteBoton = document.getElementById("deporteBoton");
deporteBoton.addEventListener("click", ()=>{
    window.open("deportes/deporte.html", "_self");
});
const culturaBoton = document.getElementById("culturaBoton");
culturaBoton.addEventListener("click", ()=>{
    window.open("cultura/cultura.html", "_self");
});