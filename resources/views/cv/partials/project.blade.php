@foreach($projects as $proj)
<div class="mb-3 border-bottom pb-2">
    <div class="d-flex justify-content-between">
        <div>
            <h6 class="fw-bold mb-0">
                {{ $proj->name }}
                @if($proj->url) <a href="{{ $proj->url }}" target="_blank" class="small ms-2"><i class="ti ti-external-link"></i></a> @endif
            </h6>
            <div class="small text-muted">{{ $proj->start_date ? $proj->start_date->format('M Y') : '' }} - {{ $proj->end_date ? $proj->end_date->format('M Y') : '' }}</div>
            <p class="small mt-1">{{ $proj->description }}</p>
        </div>
        <div class="d-flex gap-2">
            <i class="ti ti-pencil action-btn edit-btn fs-5" onclick='openModal("projectModal", @json($proj))'></i>
            <i class="ti ti-trash action-btn delete-btn fs-5 text-danger" onclick="deleteItem('{{ route('profile.delete.project', $proj->id) }}', '#container-project')"></i>
        </div>
    </div>
</div>
@endforeach