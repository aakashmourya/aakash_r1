// Call the dataTables jQuery plugin
$(document).ready(function() {
  $('.dataTable').DataTable({
    "order": [[ 0, "desc" ]],
      stateSave: true,
      "stateDuration": 60*5
  });
});
