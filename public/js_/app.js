// $(document).ready(function() {
//     table = $('.table-maintenance').DataTable({
//         columnDefs: [{
//             targets: [0, 1],
//             orderable: false
//         }],
//         dom: "<'row'<'col-12'tr>><'row'<'col-12 col-md-6 col-lg-3'l><'col-12 col-md-6 col-lg-5'i><'col-12 col-md-6 col-lg-4 right-align'p>>",
//         initComplete: function(settings, json) {
//             $('#loading').hide();
//             $('select.custom-select').hide();
//         },
//         order: [[2, 'asc']],
//         orderMulti: true,
//         stateSave: true
//     });
//     $('#search').keyup(function() {
//         table.search($(this).val()).draw();
//     })
// });