// Call the dataTables jQuery plugin
$(document).ready(function () {

  const save_state = {
    stateSave: true,
    stateDuration: 60 * 5
  }

  $('.dataTable').DataTable({
    ...save_state
  });
  $('.dataTable-desc').DataTable({
    order: [[0, "desc"]],
    ...save_state
  });
  $('.dataTable-asc').DataTable({
    order: [[0, "asc"]],
    ...save_state
  });
});
