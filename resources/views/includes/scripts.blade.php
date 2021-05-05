<script>
console.log("Ako'y isang pinoy, may pusong cheese cake sa puso ko walang iba kung mamon");
    

    $(document).ready(function(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.toastDefaults.position = 'top-right';
        $.toastDefaults.dismissible = true;
        $.toastDefaults.stackable = true;
        $.toastDefaults.pauseDelayOnHover = true;

        // TOAST
        $("#myToast").toast('show');

        // SIDEBAR HIDE AND SHOW
        $('#sidebarCollapse').on('click', function () {
                $('#sidebar').toggleClass('active');
            });

// ===================================================================================================
//                                      USER MANAGEMENT
// ===================================================================================================

        // USER TABLE
        $(function () {

            var table = $('.yajra-datatable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('users.index') }}",
            columns: [
                {data: 'id', name: 'id'},
                {data: 'f_name', name: 'f_name'},
                {data: 'l_name', name: 'l_name'},
                {data: 'username', name: 'username'},
                {data: 'roles', name: 'roles'},
                {data: 'status', name: 'status'},
                {
                    data: 'action', 
                    name: 'action', 
                    orderable: true, 
                    searchable: true
                },
                ]
            });
        
        });

            // CREATE USER
        $('#createNewUser').click(function () {
            $('#saveBtn').val("create-User");
            $('#User_id').val('');
            $('#UserForm').trigger("reset");
            $('#modelHeading').html("Create New User");
            $('#formModal').modal('show');
        });
    
            // UPDATE USER
        $('body').on('click', '.editUser', function () {
            var User_id = $(this).data('id');
            $.get("{{ route('users.index') }}" +'/' + User_id +'/edit', function (data) {
                $('#modelHeading').html("Update User");
                $('#saveBtn').val("edit-User");
                $('#formModal').modal('show');
                $('#User_id').val(data.id);
                $('#f_name').val(data.f_name);
                $('#l_name').val(data.l_name);
                $('#username').val(data.username);
            })
            // console.log(User_id);
        });
    
            // SAVING CREATE AND UPDATE
        $('#saveBtn').click(function (e) {
            e.preventDefault();
            $(this).html('Saving..');
        
            $.ajax({
                data: $('#UserForm').serialize(),
                url: "{{ route('users.store') }}",
                type: "POST",
                dataType: 'json',
                success: function (data) {
            
                    $('#UserForm').trigger("reset");
                    $('#formModal').modal('hide');
                    $('#user_table').DataTable().ajax.reload();
                    $("#toast").toast('show');
                    console.log(data);
                    
                },
                error: function (data) {
                    console.log('Error:', data);
                    $('#saveBtn').html('Save Changes');
                }
            });
        });
    
            // DELETE
        $('body').on('click', '.deleteUser', function () {
        
            var User_id = $(this).data("id");
            $.get("{{ route('users.index') }}" +'/' + User_id +'/edit', function (data) {
                $('#deleteHeading').html("Remove User");
                $('#deleteBtn').val("delete-User");
                $('#deleteModal').modal('show');
                $('#User_remove_id').val(data.id);
            })


            // confirm("Are You sure want to delete !");
        
            // $.ajax({
            //     type: "DELETE",
            //     url: "{{ route('users.store') }}"+'/'+User_id,
            //     success: function (data) {
            //         table.draw();
            //     },
            //     error: function (data) {
            //         console.log('Error:', data);
            //     }
            // });
        });

        $('#deleteBtn').click(function (e) {
            e.preventDefault();
            $(this).html('Saving..');

            $.ajax({
                data: $('#deleteForm').serialize(),
                url: "{{ route('users_delete') }}",
                type: "POST",
                dataType: 'json',
                success: function (data) {
            
                    $('#deleteForm').trigger("reset");
                    $('#deleteModal').modal('hide');
                    $('#user_table').DataTable().ajax.reload();
                    console.log(data);
                },
                error: function (data) {
                    console.log('Error:', data);
                    $('#deleteBtn').html('Save Changes');
                }
            });
        });

// ===================================================================================================
//                                      ROLES MANAGEMENT
// ===================================================================================================

            // ROLE TABLE
        var table = $('.role-datatable').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('roles.index') }}",
        columns: [
            {data: 'id', name: 'id'},
            {data: 'role_name', name: 'role_name'},
            {data: 'users', name: 'users'},
            {data: 'permission', name: 'permission'},
            {data: 'status', name: 'status'},
            {
                data: 'action', 
                name: 'action', 
                orderable: true, 
                searchable: true
            },
            ]
        });

            // CREATE ROLE
        $('#createNewRoles').click(function () {
            $('#roleBtn').val("create-Role");
            $('#role_id').val('');
            $('#roleForm').trigger("reset");
            $('#modelHeading').html("Create New Role");
            $('#roleModal').modal('show');
        });

            // UPDATE ROLE
        $('body').on('click', '.editRole', function () {
            var role_id = $(this).data('id');
            $.get("{{ route('roles.index') }}" +'/' + role_id +'/edit', function (data) {
                $('#modelHeading').html("Update Role");
                $('#roleBtn').val("edit-Role");
                $('#roleModal').modal('show');
                $('#role_id').val(data.id);
                $('#role_name').val(data.role_name);
                $('#premission').val(data.permission);
            })
            // console.log(User_id);
        });

            // SAVING CREATE AND UPDATE
        $('#roleBtn').click(function (e) {
            e.preventDefault();
            $(this).html('Saving..');
        
            $.ajax({
                data: $('#roleForm').serialize(),
                url: "{{ route('roles.store') }}",
                type: "POST",
                dataType: 'json',
                success: function (data) {
            
                    $('#roleForm').trigger("reset");
                    $('#roleModal').modal('hide');
                    $('#role_table').DataTable().ajax.reload();
                    $("#toast").toast('show');
                    // console.log(data.permission);
                    
                },
                error: function (data) {
                    console.log('Error:', data);
                    $('#roleBtn').html('Changes Not Saved');
                }
            });
        });

            // DELETE
        $('body').on('click', '.deleteRole', function () {
        
        var role_id = $(this).data("id");
        $.get("{{ route('roles.index') }}" +'/' + role_id +'/edit', function (data) {
            $('#deleteRoleHeading').html("Remove Role");
            $('#deleteRoleBtn').val("delete-Role");
            $('#deleteRoleModal').modal('show');
            $('#role_remove_id').val(data.id);
        })


        // confirm("Are You sure want to delete !");
    
        // $.ajax({
        //     type: "DELETE",
        //     url: "{{ route('users.store') }}"+'/'+User_id,
        //     success: function (data) {
        //         table.draw();
        //     },
        //     error: function (data) {
        //         console.log('Error:', data);
        //     }
        // });
        });

        $('#deleteRoleBtn').click(function (e) {
            e.preventDefault();
            $(this).html('Saving..');

            $.ajax({
                data: $('#deleteRoleForm').serialize(),
                url: "{{ route('roles_delete') }}",
                type: "POST",
                dataType: 'json',
                success: function (data) {
            
                    $('#deleteRoleForm').trigger("reset");
                    $('#deleteRoleModal').modal('hide');
                    $('#role_table').DataTable().ajax.reload();
                    console.log(data);
                },
                error: function (data) {
                    console.log('Error:', data);
                    $('#deleteRoleBtn').html('Save Changes');
                }
            });
        });

// ===================================================================================================
//                                         
// ===================================================================================================












        // ==================
        //     TEST AREA
        // ==================

            // add row
            var holder = $('#holder').val();
            $("#addRow").click(function () {
                
                var html = '';
                html += '<div id="inputFormRow">';
                html += '<div class="input-group mb-3">';
                html += '<input type="text" name="title' + holder + '" id="title' + holder + '" class="form-control m-input" placeholder="Enter title" autocomplete="off" value="' +holder+ '">';
                html += '<div class="input-group-append">';
                html += '<button id="removeRow" type="button" class="btn btn-danger">Remove</button>';
                html += '</div>';
                html += '</div>';

                $('#newRow').append(html);
                console.log($("#title"+holder+"").val());
                holder++;
            });

            // remove row
            $(document).on('click', '#removeRow', function () {
                $(this).closest('#inputFormRow').remove();
            });
    });

</script>