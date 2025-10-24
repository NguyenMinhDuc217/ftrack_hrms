@props(['role', 'allPermissions', 'assignedPermissions'])

<div class="col-12">

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">
            {{ __('role.permission_assignment') }} ({{ $role->name }})
        </h6>
    </div>
    <div class="card-body">
        <div class="permission-form-messages"></div>

        <form id="permission-assign-form" method="POST" 
            action="{{ route('admin.role.permissions.update', $role) }}">
            @csrf
            @method('PUT')

            <div class="row">
                <?php
                    // Group permissions by the second segment (e.g., 'admin.users.index' -> 'users')
                    $groupedPermissionsArray = $allPermissions->reduce(function ($carry, $permissionName) {
                        $parts = explode('.', $permissionName);
                        // Use the part after the first segment (e.g., 'users' from 'admin.users.index')
                        $groupKey = count($parts) > 1 ? $parts[1] : 'other'; 
                        
                        if (!isset($carry[$groupKey])) {
                            $carry[$groupKey] = [];
                        }
                        $carry[$groupKey][] = $permissionName;
                        return $carry;
                    }, []); // <-- Changed from collect() to []
                    
                    $groupedPermissions = collect($groupedPermissionsArray);
                ?>

                @foreach($groupedPermissions as $group => $permissions)
                    <div class="col-md-4 mb-3">
                        <div class="p-2 border border-2 rounded h-100">
                            <div class="d-flex justify-content-between align-items-center pb-1">
                                <h5 class="mb-2 text-capitalize">{{ $group }}</h5>
                                <button type="button" 
                                    class="btn btn-sm btn-outline-primary toggle-all-group"
                                    data-group="{{ $group }}"
                                    onclick="toggleGroupPermissions(this)"
                                >
                                        {{ __('default.toggle_all') }}
                                </button>
                            </div>
                            <hr class="mt-0">
                            @foreach($permissions as $permission)
                                @php
                                    $isChecked = in_array($permission, $assignedPermissions);
                                @endphp
                                <div class="form-check">
                                    <input class="form-check-input permission-checkbox" 
                                           type="checkbox" 
                                           value="{{ $permission }}" 
                                           id="perm-{{ $permission }}" 
                                           {{ $isChecked ? 'checked' : '' }}>
                                    <label class="form-check-label" for="perm-{{ $permission }}">
                                        {{ $permission }}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>

            <button type="submit" class="btn btn-success mt-4">
                {{ __('role.save_permissions') }}
            </button>
        </form>
        <div class="permission-form-messages"></div>
    </div>
</div>
</div>

{{-- JavaScript for AJAX submission --}}
<script>
    /**
     * Toggles the checked state of all checkboxes within a specific group.
     * @param {HTMLElement} button - The button element that was clicked.
     */
    function toggleGroupPermissions(button) {
        const groupKey = button.getAttribute('data-group');
        const checkboxes = button.parentElement.parentElement.querySelectorAll('input[type="checkbox"]');
        
        if (checkboxes.length === 0) return;

        // Check the current state of the first checkbox in the group.
        // If it's checked, we want to UNCHECK ALL.
        // If it's unchecked, we want to CHECK ALL.
        const shouldCheck = !checkboxes[0].checked; 

        checkboxes.forEach(checkbox => {
            checkbox.checked = shouldCheck;
        });
        
        // Optional: Update button text (requires some translation keys or data attributes)
        // For simplicity, we'll leave it as a fixed text 'Toggle All' for now.
    }

    document.getElementById('permission-assign-form').addEventListener('submit', function(e) {
        e.preventDefault();

        const form = e.target;
        const url = form.getAttribute('action');
        const token = form.querySelector('input[name="_token"]').value;
        const method = form.querySelector('input[name="_method"]').value;
        const submitButton = form.querySelector('button[type="submit"]');
        const messageDiv = document.querySelectorAll('.permission-form-messages');

        // 1. Collect all checked permissions
        const checkedPermissions = Array.from(form.querySelectorAll('.permission-checkbox:checked'))
            .map(cb => cb.value);

        // 2. Disable button and show loading state
        submitButton.disabled = true;
        submitButton.innerHTML = 'Saving...';
        messageDiv.forEach((e, l) => {
            e.innerHTML = '';
        });

        // 3. Send AJAX request
        fetch(url, {
            method: 'POST', // Fetch sends the real method in the request (PUT)
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': token,
                'X-HTTP-Method-Override': method // Laravel recognizes _method via this header or form field
            },
            body: JSON.stringify({ permissions: checkedPermissions })
        })
        .then(response => {
            // Re-enable button
            submitButton.disabled = false;
            submitButton.innerHTML = '{{ __('role.save_permissions') }}';

            if (!response.ok) {
                // Handle HTTP errors
                throw new Error('Network response was not ok.');
            }
            return response.json();
        })
        .then(data => {
            // Success response
            messageDiv.forEach((e,k) => e.innerHTML = `<div class="alert alert-success">${data.message}</div>`)
        })
        .catch(error => {
            // Error handling
            console.error('Error:', error);
            messageDiv.forEach((e,k) => e.innerHTML = `<div class="alert alert-danger">{{ __('role.permissions_update_failed') }}</div>`)
        });
    });
</script>