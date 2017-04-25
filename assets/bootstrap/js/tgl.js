$( function() {
    $( "#datepicker" ).datepicker();
    $( ".selector" ).datepicker({
  currentText: "Now",
  dateFormat: "dd-MM-yy"
});
} );