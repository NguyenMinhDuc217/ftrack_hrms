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

<script src="{{ asset('admin/assets/js/plugins/ckeditor/classic/ckeditor.js') }}"></script>

<!-- file-upload Js -->
<script src="{{ asset('admin/assets/js/plugins/dropzone-amd-module.min.js') }}"></script>

<!-- quill -->
 <script src="{{ asset('admin/assets/js/plugins/quill.js') }}"></script>
<script src="{{ asset('admin/assets/js/plugins/resize.js') }}"></script>



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

$(() => {
	$.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
});

// using swal2 to show confirmation dialog and ajax to delete entity
// url is the delete url
// entity_name is the name of the entity to be deleted (for display purpose)
function ajaxDelete(url, entity_name) {
    const delete_confirm = `{!! __('default.delete_confirm_title') !!}`;
    const delete_confirm_text = `{!! __('default.delete_confirm_text') !!}`;
	Swal.fire({
		title: delete_confirm,
		text: delete_confirm_text,
		icon: "warning",
		showCancelButton: true,
		confirmButtonColor: "#d33",
		cancelButtonColor: "#3085d6",
		confirmButtonText: `{!! __('default.button_confirm') !!}`,
		cancelButtonText: `{!! __('default.button_cancel') !!}`,
		showLoaderOnConfirm: true, // 
		reverseButtons: true,
	}).then((result) => {
		// reload page if deleted
		if (result.isConfirmed) {
			$.ajax({
				url: url,
				type: "POST",
				data: {},
				success: function (response) {
					Swal.fire(
						"Deleted!",
						`{!! __('default.delete_success_text') !!}`,
						"success"
					).then(() => {
						location.reload();
					});
				},
				error: function (xhr) {
					Swal.fire(
						"Error!",
						`{!! __('default.delete_error_text') !!}`,
						"error"
					);
				},
			});
		}
	});
}

</script>