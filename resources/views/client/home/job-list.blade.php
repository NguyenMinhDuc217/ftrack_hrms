<section class="py-12 bg-gray-50">
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
            <!-- Job 1 -->
            <div class=" job-card bg-white rounded-xl shadow-sm border border-gray-100 p-3 hover:shadow-lg transition-shadow duration-300 group cursor-pointer" data-location="TP. Hồ Chí Minh">
                <div class="flex items-start gap-4">
                    <img src="https://picsum.photos/id/101/64/64" alt="Company Logo" class="w-16 h-16 object-contain rounded-lg" />
                    <div class="flex-1 min-w-0">
                        <h3 class="text-base font-bold text-gray-900 leading-snug mb-1 group-hover:text-primary transition-colors line-clamp-2">{{ $job->title }}</h3>
                        <div class="text-base text-black tracking-wide font-medium my-1 leading-6">{{ Str::limit(strip_tags($job->description_md), 50, '...') }}</div>

                         <div class="space-y-2">
                            <div class="flex items-center text-sm text-gray-600">
                                <i class="bi bi-geo w-4 h-4 mr-2 text-gray-400"></i>
                                @if($job->area_application)
                                @foreach($job->area_application as $area)
                                <span class="truncate border border-gray-200 p-1 rounded-md">{{ $area->province->name ?? '' }}</span> &nbsp;
                                @endforeach
                                @endif
                            </div>
                            <div class="grid grid-cols-3 text-sm text-green-600 font-medium">
                                <div class="col-span-2">
                                    <i class="bi bi-coin w-4 h-4 mr-2"></i>
                                    <span>{{ round($job->min_salary / 1000000,1) }} - {{ round($job->max_salary / 1000000,1) }} triệu</span>
                                </div>
                                <div class="col-span-1 text-gray-500">{{ !empty( $job->created_at) ? $job->created_at->diffForHumans() : '' }}</div>
                            </div>
                        </div>
                    </div>
                </div>
               
            </div>
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