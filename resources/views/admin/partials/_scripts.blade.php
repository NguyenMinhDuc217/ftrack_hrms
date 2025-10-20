<!-- [Page Specific JS] start -->
<!-- <script src="{{ asset('admin/assets/js/plugins/apexcharts.min.js') }}"></script> -->
<!-- <script src="{{ asset('admin/assets/js/pages/dashboard-default.js') }}"></script> -->
<!-- [Page Specific JS] end -->
<!-- Required Js -->
<script src="{{ asset('admin/assets/js/plugins/popper.min.js') }}"></script>
<script src="{{ asset('admin/assets/js/plugins/simplebar.min.js') }}"></script>
<script src="{{ asset('admin/assets/js/plugins/bootstrap.min.js') }}"></script>
<script src="{{ asset('admin/assets/js/fonts/custom-font.js') }}"></script>
<script src="{{ asset('admin/assets/js/pcoded.js') }}"></script>
<script src="{{ asset('admin/assets/js/plugins/feather.min.js') }}"></script>
<script src="{{ asset('admin/assets/js/jquery.min.js') }}"></script>
<script src="{{ asset('admin/assets/js/plugins/sweetalert2.all.min.js') }}"></script>
<script src="{{ asset('admin/assets/js/plugins/sweetalert2.js') }}"></script>

<script>layout_change('light');</script>
<script>change_box_container('false');</script>
<script>layout_rtl_change('false');</script>
<script>preset_change("preset-1");</script>
<script>font_change("Public-Sans");</script>

<script>
    const Toast = Swal.mixin({
        toast: true,
        position: "top-end",
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
        toast.onmouseenter = Swal.stopTimer;
        toast.onmouseleave = Swal.resumeTimer;
        }
    });
</script>