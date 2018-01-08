$(document).ready(function() {
  $(".field").on("keyup", "input", function() {
    var input = $(this).val();
    alert(input);
  });
});
