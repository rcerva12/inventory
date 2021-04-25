<script>
console.log('Akoy isang pinoy');
    

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

        // USER SEARCH
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

        // ========================
        //     USER MANAGEMENT
        // ========================

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
                $('#modelHeading').html("Edit User");
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
                    $('#saveBtn').html('Save Changes');
                }
            });
        });

        
    });

</script>