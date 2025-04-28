$(document).ready(function () {
  $("#date").change(function () {
    var selectedDate = $(this).val();

    if (selectedDate) {
      $.ajax({
        url: "../php/get_available_times.php",
        method: "GET",
        data: { date: selectedDate },
        success: function (response) {
          var availableSlots = JSON.parse(response);

          $("#time").empty();
          $("#time").append('<option value="">Select a time slot</option>');

          if (availableSlots.length > 0) {
            availableSlots.forEach(function (slot) {
              $("#time").append(
                '<option value="' + slot + '">' + slot + "</option>"
              );
            });
          } else {
            $("#time").append('<option value="">No available slots</option>');
          }
        },
        error: function () {
          alert("An error occurred while fetching available slots.");
        },
      });
    } else {
      $("#time").empty();
      $("#time").append('<option value="">Select a time slot</option>');
    }
  });
});
