function volumeToggle(button) {
  var muted = $(".previewVideo").prop("muted");
  $(".previewVideo").prop("muted", !muted);

  $(button).find("i").toggleClass("fa-volume-xmark");
  $(button).find("i").toggleClass("fa-volume-high");
}

function previewEnded() {
    // toggle is used to toggle either hidden or show values of the element
    // if the element is on hidden, it will be toggled to show
    // and if it is on show then it will be toggled to hidden
    $(".previewVideo").toggle();
    $(".previewImage").toggle();
}
