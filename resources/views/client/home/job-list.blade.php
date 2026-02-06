<section class="py-6 bg-background">
    <div class="container px-0">

        <!-- Filters -->
        <div class="flex flex-col md:flex-row justify-between items-center mb-6 gap-4">
            <div class="sm:w-1/5 w-max flex items-center space-x-2 px-4 py-1.5 bg-white rounded-lg border border-gray-200 text-sm text-gray-600 w-full md:w-auto">
                <span class="whitespace-nowrap font-medium text-gray-900">{{ __('job.txt_filter_by') }}:</span>
                <select class="border-none bg-transparent font-semibold text-gray-900 focus:ring-0 cursor-pointer outline-none">
                    @foreach($filters as $key => $value)
                    <option value="{{ $key }}" onchange="changeFilter('{{ $key }}')">{{ $value }}</option>
                    @endforeach
                </select>
            </div>
            <!-- Location Tabs -->
            <div class="sm:w-3/5 w-80">
                <x-client.filter
                    :type="$type"
                    :val="isset($val) ? $val : ''"
                    id="filter" />

            </div>
        </div>
        <div class="bg-white p-3 border-2 border-dotted mb-6 rounded-lg flex flex-col gap-2 {{ empty($list_filter_profession) ? 'hidden' : '' }}" id="list-tags">
            <div class="flex justify-between pb-2">
                <span>Active Filter (<span id="count_tags">{{ !empty($list_filter_profession) ? count($list_filter_profession) : 0 }}</span>)</span>
                <button onclick="clearFilter()" class="flex items-center gap-1 hover:text-[var(--blue-color)]"><i class="ti ti-x"></i> Clear</button>
            </div>
            <div id="list-filter-profession" class="flex flex-wrap gap-2 ">
                @if(!empty($list_filter_profession))
                @foreach($list_filter_profession as $profession)
                <span class="badge rounded-sm bg-[var(--blue-color)] d-flex flex-row align-items-center gap-1 p-2" id="profession_tag_{{ $profession->slug }}">
                    <span class="text-white">{{ $profession->profession_name }}</span>
                    <button onclick="removeProfession('{{ $profession->slug }}')" class="btn btn-sm p-0 text-white rounded-full hover:bg-blue-300 transition flex items-center justify-center">
                        <i class="ti ti-x"></i>
                    </button>
                </span>
                @endforeach
                @endif
            </div>
        </div>

        <!-- Job Grid -->
        <div id="job-grid" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-3">

            @foreach($jobs as $job)
            <div class="bg-white rounded-lg shadow-sm border border-gray-100 hover:shadow-lg transition-shadow duration-300 group cursor-pointer h-full flex flex-col">
                <a href="{{ route('client.job.detail', $job->slug) }}" class="job-card p-4 pb-2" id="job-{{ $job->id }}">
                    <div class="flex items-start gap-4 flex-1">
                        <img src="{{ $job->organization->image->url ?? asset('images/profile/blank-profile.svg') }}" alt="Company Logo" class="w-16 h-16 object-contain rounded-lg flex-shrink-0" />

                        <div class="flex flex-col flex-1 min-w-0">
                            <h3 class="text-base font-bold text-gray-900 group-hover:text-primary transition-colors line-clamp-2 h-[3rem] alumni-font mb-2">
                                {{ $job->name ?? 'N/A' }}
                            </h3>

                            @if($job->organization)
                            <div class="text-gray-500">
                                <i class="ti ti-building-community mr-2"></i>
                                {{ $job->organization->name }}
                            </div>
                            @endif

                            <div class="text-gray-500">
                                <i class="bi bi-coin mr-2"></i>
                                {{ __('job.txt_salary_rank', ['min' => number_format($job->min_salary / 1000000, 1), 'max' => number_format($job->max_salary / 1000000, 1)]) }}
                            </div>


                        </div>
                    </div>

                </a>
                <!-- Phần lương + thời gian luôn nằm sát đáy -->
                <div class="p-2 border-t border-gray-100 text-sm font-medium flex items-center justify-between">
                    <div class="text-green-600">
                        @if($job->job_area->count() > 0)
                        <div class="text-sm text-gray-600">
                            <span class="px-2 py-1 bg-gray-100 rounded-md text-xs">
                                <i class="bi bi-geo-alt-fill w-4 h-4 text-[var(--blue-color)]"></i>
                                {{ $job->job_area->first()->province->localized_name ?? '' }} {{ $job->job_area->count() > 1 ? ' ' . __('job.txt_and') . ' ' . ($job->job_area->count() - 1) . ' ' . __('job.txt_otherwhere') : '' }}
                            </span>
                        </div>
                        @endif
                    </div>
                    <div class=" text-gray-500 text-right">
                        {{ $job->created_at?->diffForHumans() }}
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Pagination -->
        {{ $jobs->links('vendor.pagination.custom') }}
    </div>
    <script>
        function chooseProfession(type, slug, name) {
            if ($('#profession_tag_' + slug).length > 0) {
                return;
            }

            var bagde = `<span class="badge rounded-sm bg-[var(--blue-color)] flex flex-row items-center gap-1 p-2" id="profession_tag_${slug}">
            <span class="text-white">${name}</span>
                        <button onclick="removeProfession('${slug}')" class="btn btn-sm p-0 text-white rounded-full hover:bg-blue-300 transition flex items-center justify-center">
                            <i class="ti ti-x"></i>
                        </button>
                    </span>`
            $('#list-filter-profession').append(bagde)
            $('#count_tags').text($('#list-filter-profession').children().length)
            $('#list-tags').removeClass('hidden')
        }

        function removeProfession(slug) {
            $('#profession_tag_' + slug).remove()
            $('#count_tags').text($('#list-filter-profession').children().length)
            if ($('#list-filter-profession').children().length == 0) {
                $('#list-tags').addClass('hidden')
            }
        }

        function clearFilter() {
            $('#list-filter-profession').empty()
            $('#list-tags').addClass('hidden')
        }

        function changeFilter($key) {
            $('#filter').attr('key', $key);
        }
    </script>
</section>