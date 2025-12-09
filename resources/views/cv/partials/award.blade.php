<ul class="list-unstyled">
@foreach($awards as $award)
    <li class="mb-2 d-flex justify-content-between">
        <div>
            <strong>{{ $award->name }}</strong> ({{ $award->organization }})
            <div class="small text-muted">{{ $award->year ?? '' }} - {{ $award->description }}</div>
        </div>
        <div class="d-flex gap-2">
            <i class="ti ti-pencil action-btn edit-btn fs-5" onclick='openModal("awardModal", @json($award))'></i>
            <i class="ti ti-trash action-btn delete-btn fs-5 text-danger" onclick="deleteItem('{{ route('profile.delete.award', $award->id) }}', '#container-award')"></i>
        </div>
    </li>
@endforeach
</ul>