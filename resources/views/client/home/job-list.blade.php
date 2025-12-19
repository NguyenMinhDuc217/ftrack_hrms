<section class="py-6 bg-gray-50">
    <div class="container mx-auto px-4">

        <!-- Filters -->
        <div class="flex flex-col md:flex-row justify-between items-center mb-8 gap-4">
            <div class="w-1/5 flex items-center space-x-2 px-4 py-1.5 bg-white rounded-full border border-gray-200 text-sm text-gray-600 w-full md:w-auto">
                <span class="whitespace-nowrap font-medium text-gray-900">{{ __('job.txt_filter_by') }}:</span>
                <select class="border-none bg-transparent font-semibold text-gray-900 focus:ring-0 cursor-pointer outline-none">
                    @foreach($filters as $key => $value)
                        <option value="{{ $key }}" onchange="changeFilter('{{ $key }}')">{{ $value }}</option>
                    @endforeach
                </select>
            </div>
            <!-- Location Tabs -->
             <div class="w-3/5">
                <x-client.filter 
                    :type="$type"
                    :val="isset($val) ? $val : ''"
                    id="filter" />
             </div>
        </div>

        <!-- Job Grid -->
        <div id="job-grid" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-3">

            @foreach($jobs as $job)
            <a href="{{ route('client.job.detail', $job->job_id) }}" class="job-card bg-white rounded-xl shadow-sm border border-gray-100 p-4 hover:shadow-lg transition-shadow duration-300 group cursor-pointer h-full flex flex-col" id="job-{{ $job->id }}">
                <div class="flex items-start gap-4 flex-1">
                    <img src="https://picsum.photos/id/101/64/64" alt="Company Logo" class="w-16 h-16 object-contain rounded-lg flex-shrink-0" />

                    <div class="flex flex-col flex-1 min-w-0">
                        <h3 class="text-base font-bold text-gray-900 group-hover:text-primary transition-colors line-clamp-2 h-[3rem]">
                            {{ $job->name }}
                        </h3>

                        <div class="text-base text-black tracking-wide font-medium my-2 leading-6 line-clamp-3 h-[10vh]">
                            {{ Str::limit(strip_tags($job->description_md), 120, '...') }}
                        </div>

                        @if($job->job_area->count() > 0)
                        <div class="flex flex-wrap items-center gap-1 text-sm text-gray-600 my-2">
                            <i class="bi bi-geo-alt-fill w-4 h-4 text-[var(--accent-color)]"></i>
                            <span class="px-2 py-1 bg-gray-100 rounded-md text-xs">
                                {{ $job->job_area->first()->province->name ?? '' }} {{ $job->job_area->count() > 1 ? 'và ' . ($job->job_area->count() - 1) . ' nơi khác' : '' }}
                            </span>
                        </div>
                        @endif
                    </div>
                </div>

                <!-- Phần lương + thời gian luôn nằm sát đáy -->
                <div class=" border-t border-gray-100 grid grid-cols-5 text-sm font-medium">
                    <div class="col-span-3 text-green-600">
                        <i class="bi bi-coin mr-2"></i>
                        {{ number_format($job->min_salary / 1000000, 1) }} - {{ number_format($job->max_salary / 1000000, 1) }} triệu
                    </div>
                    <div class="col-span-2 text-gray-500 text-right">
                        {{ $job->created_at?->diffForHumans() }}
                    </div>
                </div>
            </a>
            @endforeach
        </div>

        <!-- Pagination -->
        {{ $jobs->links('vendor.pagination.custom') }}

        <!-- <div class="flex justify-center mt-12">
            <div class="flex items-center space-x-2">
                <button class="w-8 h-8 flex items-center justify-center rounded-md border border-gray-200 text-gray-500 hover:bg-gray-50 text-sm">
                    <i data-lucide="chevron-left" class="w-4 h-4"></i>
                </button>
                <button class="w-8 h-8 flex items-center justify-center rounded-md bg-primary text-white text-sm font-bold shadow-md">1</button>
                <button class="w-8 h-8 flex items-center justify-center rounded-md border border-gray-200 text-gray-600 hover:bg-gray-50 text-sm">2</button>
                <button class="w-8 h-8 flex items-center justify-center rounded-md border border-gray-200 text-gray-600 hover:bg-gray-50 text-sm">3</button>
                <span class="text-gray-400">...</span>
                <button class="w-8 h-8 flex items-center justify-center rounded-md border border-gray-200 text-gray-600 hover:bg-gray-50 text-sm">7</button>
                <button class="w-8 h-8 flex items-center justify-center rounded-md border border-gray-200 text-gray-500 hover:bg-gray-50 text-sm">
                    <i data-lucide="chevron-right" class="w-4 h-4"></i>
                </button>
            </div>
        </div> -->
    </div>
    <script>
        function changeFilter($key) {
            $('#filter').attr('key', $key);
        }
    </script>
</section>