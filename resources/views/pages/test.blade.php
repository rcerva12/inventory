@extends('layout.app')
@section('content')
    <div class="container"style="max-width: 700px;">

        <div class="text-center" style="margin: 20px 0px 20px 0px;">
            <a href="https://shouts.dev/" target="_blank"><img src="https://i.imgur.com/hHZjfUq.png"></a><br>
            <span class="text-secondary">Add or Remove Input Fields Dynamically using jQuery</span>
        </div>

        <form method="post" action="">
            <div class="row">
                <div class="col-lg-12">
                    <div id="inputFormRow">
                        <div class="input-group mb-3">
                            <input type="hidden" id="holder" value=1>
                            <input type="text" name="title0" class="form-control m-input" placeholder="Enter title" autocomplete="off">
                            <div class="input-group-append">                
                                <button id="removeRow" type="button" class="btn btn-danger">Remove</button>
                            </div>
                        </div>
                    </div>

                    <div id="newRow"></div>
                    <button id="addRow" type="button" class="btn btn-info">Add Row</button>
                </div>
            </div>
        </form>
    </div>

    
@endsection