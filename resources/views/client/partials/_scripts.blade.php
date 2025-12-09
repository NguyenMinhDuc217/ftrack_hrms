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

	// Define the Bootstrap-styled instance
	const BS_Swal = Swal.mixin({
		// title: 'Bootstrap 5 theme',
		// theme: 'bootstrap-5'
		theme: 'bootstrap-5-light' // light theme only
		// theme: 'bootstrap-5-dark' // dark theme only
	});
	window.Swal = BS_Swal;
	window.Toast = Toast;

	$(() => {
		$.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
	});
</script>