@if($experiences->isEmpty())
    <p class="text-muted fst-italic">{{ __('cv.no_experience') }}</p>
@else
    @foreach($experiences as $exp)
    <div class="mb-4 border-bottom pb-3 last-no-border">
        <div class="d-flex justify-content-between">
            <div>
                <h5 class="fw-bold mb-1">{{ $exp->position }}</h5>
                <div class="fw-bold mb-1">{{ $exp->company_name }}</div>
                <div class="text-secondary small mb-2">
                    <i class="fa fa-calendar-alt me-1"></i>
                    {{ $exp->start_date ? $exp->start_date->format('M Y') : __('cv.na') }} - 
                    {{ $exp->is_current ? __('cv.present') : ($exp->end_date ? $exp->end_date->format('M Y') : __('cv.na')) }}
                </div>
                <p class="mb-0 text-dark">{{ $exp->description }}</p>
            </div>
            <div class="d-flex gap-2 align-items-start">
                <i class="ti ti-pencil action-btn edit-btn fs-5" onclick='openModal("experienceModal", @json($exp))'></i>
                <i class="ti ti-trash action-btn delete-btn fs-5 text-danger" onclick="deleteItem('{{ route('profile.delete.experience', $exp->id) }}', '#container-experience')"></i>
            </div>
        </div>
    </div>
    @endforeach
@endif