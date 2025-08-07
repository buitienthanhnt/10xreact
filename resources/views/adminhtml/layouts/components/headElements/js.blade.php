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
{{-- support ckeditor library text-area, file-manager form --}}
<script src="/source/adminhtml/js/ckeditor/ckeditor.js"></script>

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
