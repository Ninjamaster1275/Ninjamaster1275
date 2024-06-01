document.addEventListener("DOMContentLoaded", ()=>{
    const elementosCarousel = document.querySelectorAll(".carousel");
    setTimeout(()=>{
        M.Carousel.init(elementosCarousel, {
            duration: 150,
            dist: -60,
            shift: 5,
            padding: 5,
            numVisible: 9,
            indicators: true,
            //noWrap: true
            
        });
        console.info("Materialize initialized");
    }, 100);
});