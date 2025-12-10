<ul class="list-unstyled">
@foreach($certificates as $cert)
    <li class="mb-2 d-flex justify-content-between align-items-center">
        <div>
            <strong>{{ $cert->name }}</strong> - {{ $cert->organization }}
            <div class="small text-muted">{{ __('cv.issued') }} {{ $cert->issue_date ? $cert->issue_date->format('M Y') : __('cv.na') }}</div>
        </div>
        <div class="d-flex gap-2">
            <i class="ti ti-pencil action-btn edit-btn fs-5" onclick='openModal("certificateModal", @json($cert))'></i>
            <i class="ti ti-trash action-btn delete-btn fs-5 text-danger" onclick="deleteItem('{{ route('profile.delete.certificate', $cert->id) }}', '#container-certificate')"></i>
        </div>
    </li>
@endforeach
</ul>