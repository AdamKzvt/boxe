const buttons = document.querySelectorAll("[data-carousel-button]")

buttons.forEach(button => {
  button.addEventListener("click", () => {
    const offset = button.dataset.carouselButton === "next" ? 1 : -1
    const slides = button
      .closest("[data-carousel]")
      .querySelector("[data-slides]")

    const activeSlide = slides.querySelector("[data-active]")
    let newIndex = [...slides.children].indexOf(activeSlide) + offset
    if (newIndex < 0) newIndex = slides.children.length - 1
    if (newIndex >= slides.children.length) newIndex = 0

    slides.children[newIndex].dataset.active = true
    delete activeSlide.dataset.active
  })
})



let textElement = document.getElementById("text");
let containerElement = document.getElementById("container");

let text = "Les inscriptions au club débutent en septembre, mais ne sont pas acceptées en fin de saison.";

// Ajoute le texte à la balise <marquee>
textElement.innerText = text;

// Fonction pour calculer la vitesse de défilement en fonction de la longueur du texte et de la largeur du conteneur
function calculateScrollSpeed() {
  let scrollDuration = textElement.offsetWidth / 80; // Ajustez ce nombre pour changer la vitesse de défilement
  return scrollDuration;
}

// Fonction pour définir la vitesse de défilement du texte
function setScrollSpeed() {
  var scrollDuration = calculateScrollSpeed();
  textElement.setAttribute("scrollamount", scrollDuration);
}

// Appelle la fonction pour définir la vitesse de défilement initiale
setScrollSpeed();

// Redimensionne automatiquement la vitesse de défilement lorsque la fenêtre est redimensionnée
window.addEventListener("resize", setScrollSpeed);
