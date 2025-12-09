<div class="row">
    @foreach($languages as $lang)
    <div class="col-md-6 mb-2">
        <div class="p-2 border rounded d-flex justify-content-between align-items-center">
            <div>
                <strong>{{ $lang->language }}</strong> 
                <span class="text-muted small">({{ $lang->level }})</span>
            </div>
            <div class="d-flex gap-2">
                <i class="ti ti-pencil action-btn fs-5 edit-btn text-primary" onclick='openModal("languageModal", @json($lang))'></i>
                <i class="ti ti-trash action-btn fs-5 text-danger delete-btn" onclick="deleteItem('{{ route('profile.delete.language', $lang->id) }}', '#container-language')"></i>
            </div>
        </div>
    </div>
    @endforeach
</div>