<script>
console.log('Akoy isang pinoy');
    $(document).ready(function(){
        $("#myToast").toast('show');

        $('#sidebarCollapse').on('click', function () {
                $('#sidebar').toggleClass('active');
            });
    });

</script>