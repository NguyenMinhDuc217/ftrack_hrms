@if($educations->isEmpty())
    <p class="text-muted fst-italic">No education added.</p>
@else
    @foreach($educations as $edu)
    <div class="mb-4 border-bottom pb-3">
        <div class="d-flex justify-content-between">
            <div>
                <h5 class="fw-bold mb-1">{{ $edu->school }}</h5>
                <div class="text-muted mb-1">{{ $edu->degree }} - {{ $edu->major }}</div>
                <div class="text-secondary small">
                    {{ $edu->start_date ? $edu->start_date->format('Y') : '' }} - {{ $edu->end_date ? $edu->end_date->format('Y') : 'Present' }}
                </div>
                <p class="mt-2">{{ $edu->description }}</p>
            </div>
            <div class="d-flex gap-2 align-items-start">
                <i class="ti ti-pencil action-btn edit-btn fs-5" onclick='openModal("educationModal", @json($edu))'></i>
                <i class="ti ti-trash action-btn delete-btn fs-5 text-danger" onclick="deleteItem('{{ route('profile.delete.education', $edu->id) }}', '#container-education')"></i>
            </div>
        </div>
    </div>
    @endforeach
@endif