{{-- LARAVEL ERROR --}}
@if(session('message'))
    <script>M.toast({html: "{{ session('message') }}", classes: 'rounded'})</script>
    {{ session()->forget('message') }}
@endif
