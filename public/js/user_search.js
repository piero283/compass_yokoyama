$(function () {
  $('.search_conditions').click(function () {
    $('.search_conditions_inner').slideToggle();
  });

  $('.subject_edit_btn').click(function () {
    $('.subject_inner').slideToggle();
  });
});


document.addEventListener("DOMContentLoaded", () => {
  const toggleButton = document.querySelector(".subject_edit_btn");
  const arrow = toggleButton.querySelector(".arrow-icon");
  const content = document.querySelector(".subject_inner");

  

  toggleButton.addEventListener("click", () => {
    content.classList.toggle("d-none");

    if (content.classList.contains("d-none")) {
      arrow.classList.remove("dli-chevron-up");
      arrow.classList.add("dli-chevron-down");
    } else {
      arrow.classList.remove("dli-chevron-down");
      arrow.classList.add("dli-chevron-up");
    }
  });
});
