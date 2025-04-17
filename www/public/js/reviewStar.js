const stars = document.querySelectorAll("#star-rating .star");
const ratingInput = document.getElementById("rating");

stars.forEach((star) => {
  star.addEventListener("mouseover", () => {
    const value = parseInt(star.dataset.value);
    highlightStars(value);
  });

  star.addEventListener("mouseout", () => {
    const selected = parseInt(ratingInput.value) || 0;
    highlightStars(selected);
  });

  star.addEventListener("click", () => {
    const value = parseInt(star.dataset.value);
    ratingInput.value = value;
    highlightStars(value);
  });
});

function highlightStars(value) {
  stars.forEach((s) => {
    const v = parseInt(s.dataset.value);
    s.classList.toggle("selected", v <= value);
    s.classList.toggle("hover", v <= value);
  });
}
