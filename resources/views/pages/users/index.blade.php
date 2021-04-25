@extends('layout.apps')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-head">
                    <h2 class="mb-4">Users List</h2>
                </div>
                <div class="panel-body">
                    {{-- <button type="button" class="btn btn-primary" id="adduser" data-toggle="modal" data-target="#addUser"  title="Add a new record" data-tooltip>
                        Add
                    </button> --}}
                    {{-- <button type="button" name="adduser" id="addUser" class="btn btn-primary btn-sm">
                        Add
                    </button> --}}
                    <div class="col-md-12">
                          <a class="btn btn-success" href="javascript:void(0)" id="createNewUser"> Add new User</a>
                    </div>
                    {{-- <div class="col-md-12">
                          <a class="btn btn-warning" href="javascript:void(0)" id="sample"> WTF</a>
                    </div> --}}

                    <div class="panel-sub-body">
                        <table class="table table-bordered yajra-datatable" id="user_table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Username</th>
                                    <th>Role</th>
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
        
        <!-- Modal -->
        {{-- <div class="modal fade" id="addUser" tabindex="-1" role="dialog" aria-labelledby="addUser" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <h1></h1>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="hidden_id" id="hidden_id" />
                        <button type="button" class="btn btn-primary">Save changes</button>
                    </div>
                </div>
            </div>
        </div> --}}

        {{-- <div id="formModal" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Create new user</h4>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('users.store') }}" method="post">
                            @csrf
                            <div class="form-group">
                                <label class="control-label col-md-4">First name : </label>
                                <div class="col-md-8 ">
                                    <input id="f_name" name="f_name" type="text"style="text-transform: capitalize;" class="form-control" @error('f_name') class="invalid" @enderror value="{{ old('f_name') ?: '' }}"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-4">Last Name : </label>
                                <div class="col-md-8">
                                    <input id="l_name" name="l_name" type="text"style="text-transform: capitalize;" class="form-control" @error('l_name') class="invalid" @enderror value="{{ old('l_name') ?: '' }}"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-4">Username : </label>
                                <div class="col-md-8">
                                    <input id="username" name="username" type="text" class="form-control" @error('username') class="invalid" @enderror value="{{ old('username') ?: '' }}"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-4">Password : </label>
                                <div class="col-md-8">
                                    <input id="password" name="password" type="password" class="form-control" @error('password') class="invalid" @enderror value="{{ old('password') ?: '' }}"/>
                                </div>
                            </div>
                                <div class="col-6 text-right">
                                    <input type="hidden" name="hidden_id" id="hidden_id" />
                                    <button class="btn btn-warning" type="submit"><i class="fas fa-lock"></i> Submit</button>
                                </div>
                        </form>
                    </div>
                </div>
            </div>

        </div> --}}

        {{-- CREATE & UPDATE --}}
        <div class="modal fade" id="formModal" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="modelHeading"></h4>
                    </div>
                    <div class="modal-body">
                        <form id="UserForm" name="userForm" class="form-horizontal">
                            @csrf
                           <input type="hidden" name="User_id" id="User_id">
                           <div class="form-group">
                            <label class="control-label col-md-4">First name : </label>
                            <div class="col-md-8 ">
                                <input id="f_name" name="f_name" type="text"style="text-transform: capitalize;" class="form-control" @error('f_name') class="invalid" @enderror value="{{ old('f_name') ?: '' }}"/>
                            </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-4">Last Name : </label>
                                <div class="col-md-8">
                                    <input id="l_name" name="l_name" type="text"style="text-transform: capitalize;" class="form-control" @error('l_name') class="invalid" @enderror value="{{ old('l_name') ?: '' }}"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-4">Username : </label>
                                <div class="col-md-8">
                                    <input id="username" name="username" type="text" class="form-control" @error('username') class="invalid" @enderror value="{{ old('username') ?: '' }}"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-4">Password : </label>
                                <div class="col-md-8">
                                    <input id="password" name="password" type="password" class="form-control" @error('password') class="invalid" @enderror value="{{ old('password') ?: '' }}"/>
                                </div>
                            </div>
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" class="btn btn-primary"  id="saveBtn"  value="create">Save
                             </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
         </div>


         {{-- DELETE --}}
         <div class="modal fade" id="deleteModal" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="deleteHeading"></h4>
                    </div>
                    <div class="modal-body">
                        <form id="deleteForm" name="deleteForm" class="form-horizontal">
                            @csrf
                           <input type="hidden" name="User_remove_id" id="User_remove_id">
                           <div class="form-group">
                                <label class="control-label col-md-4">Are you sure you want to delete?</label>
                            </div>
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" class="btn btn-danger"  id="deleteBtn"  value="delete">Delete</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
         </div>

    </div>
</div>
@endsection
