@extends('layout.apps')
@section('content')
    <div class="dashboard">
        <h1>Dashboard</h1>
        {{-- <p>{{session('Loggedin')}}</p>
        <a href="/logout">Logout</a> --}}

        <div class="row" style="margin-top:45px">
            <div class="col-md-6 col-md-offset-3">
                <table class="table table-hover">
                    <thead>
                        <th>ID</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ $LoggedUserInfo->id }}</td>
                            <td>{{ $LoggedUserInfo->f_name }}</td>
                            <td>{{ $LoggedUserInfo->l_name }}</td>
                            <td><a href="logout">Logout</a></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection