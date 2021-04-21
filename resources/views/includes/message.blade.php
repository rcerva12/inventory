{{-- LARAVEL ERROR --}}
{{-- @if(session('message'))
    <script>M.toast({html: "{{ session('message') }}", classes: 'rounded'})</script>
    {{ session()->forget('message') }}
@endif --}}

{{-- BOOTSTRAP ERROR --}}
@if(session('message'))
    <div class="toast" id="myToast" role="alert" aria-live="assertive" aria-atomic="true" data-delay="2000" style="position: absolute; top: 1rem; right: 1rem;">
        <div class="toast-header">
            <strong class="mr-auto"><i class="fa fa-grav"></i> Notification!</strong>
            <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                <span aria-hidden="true">&times;</span>
        </div>
        
        <div class="toast-body">
            <div>{{ session('message') }}</div>
        </div>
    </div>
    {{ session()->forget('message') }}
@endif