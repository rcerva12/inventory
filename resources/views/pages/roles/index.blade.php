@extends('layout.apps')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-head">
                    <h2 class="mb-4">Roles List</h2>
                </div>
                <div class="panel-body">
                    <div class="col-md-12">
                          <a class="btn btn-success" href="javascript:void(0)" id="createNewRoles"> Add new Role</a>
                    </div>

                    <div class="panel-sub-body">
                        <table class="table table-bordered role-datatable" id="role_table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Role</th>
                                    <th>Users</th>
                                    <th>Permission</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        {{-- CREATE & UPDATE --}}
        <div class="modal fade" id="roleModal" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="modelHeading"></h4>
                    </div>
                    <div class="modal-body">
                        <form id="roleForm" name="roleForm" class="form-horizontal">
                            @csrf
                           <input type="hidden" name="role_id" id="role_id">
                           <div class="form-group">
                                <label class="control-label col-md-4">Role name : </label>
                                <div class="col-md-8 ">
                                    <input id="role_name" name="role_name" type="text"style="text-transform: capitalize;" class="form-control" @error('role_name') class="invalid" @enderror value="{{ old('role_name') ?: '' }}"/>
                                </div>
                            </div>
                            <div class="dropdown-divider"></div>
                            <div class="form-group">
                                <label class="control-label col-md-4">Permission </label>
                                <div class="container">
                                    <div class="row">
                                        <div class="form-check form-switch col">
                                            <input class="form-check-input" type="checkbox" id="view_user" name="role[]" value="View user">
                                            <label class="form-check-label" for="view_user">View user</label>
                                        </div>
                                        <div class="form-check form-switch col">
                                            <input class="form-check-input" type="checkbox" id="create_user" name="role[]" value="Create user">
                                            <label class="form-check-label" for="create_user">Create user</label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-check form-switch col">
                                            <input class="form-check-input" type="checkbox" id="update_user" name="role[]" value="Update user">
                                            <label class="form-check-label" for="update_user">Update user</label>
                                        </div>
                                        <div class="form-check form-switch col">
                                            <input class="form-check-input" type="checkbox" id="remove_user" name="role[]" value="Remove user">
                                            <label class="form-check-label" for="remove_user">Remove user</label>
                                        </div>
                                    </div>
                                </div>
                                
                                
                            </div>
                            <div class="col-sm-offset-2 text-center col-sm-10">
                                <button type="submit" class="btn btn-success" style="" id="roleBtn"  value="create">Save
                             </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>


         {{-- DELETE --}}
         <div class="modal fade" id="deleteRoleModal" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="deleteRoleHeading"></h4>
                    </div>
                    <div class="modal-body">
                        <form id="deleteRoleForm" name="deleteRoleForm" class="form-horizontal">
                            @csrf
                           <input type="hidden" name="role_remove_id" id="role_remove_id">
                           <div class="form-group">
                                <label class="control-label col-md-4">Are you sure, you want to remove?</label>
                            </div>
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" class="btn btn-danger"  id="deleteRoleBtn"  value="delete">Remove</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
         </div>

    </div>
</div>
@endsection
