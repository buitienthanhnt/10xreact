@include('adminhtml.layouts.components.headElements.beJs')

{{-- import fontawesome js library --}}
<script src="/source/adminhtml/js/fontawesome.js"></script>
{{-- import sweetalert2 library: https://sweetalert2.github.io/#usage --}}
<script src="/source/adminhtml/js/sweetalert2@11.js"></script>
{{-- import jquery library --}}
<script src="/source/adminhtml/js/jquery-3.7.1.min.js"></script>
{{-- insert bootstrap support --}}
<script src="/source/adminhtml/js/popper.min.js"></script>
<script src="/source/adminhtml/js/bootstrap.min.js"></script>
<script src="/source/adminhtml/js/tinymce/tinymce.min.js" referrerpolicy="origin" crossorigin="anonymous"></script>
{{-- insert filemanager support --}}
<script src="/vendor/laravel-filemanager/js/filemanager.min.js"></script>
@include('adminhtml.layouts.components.headElements.afJs')

{{-- jquery ajax setup: https://laravel.com/docs/12.x/csrf#csrf-x-csrf-token --}}
<script type="text/javascript">
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    })
</script>
