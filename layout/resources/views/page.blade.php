@if ($paginator->hasPages())
    <nav role="navigation" aria-label="{{ __('Pagination Navigation') }}" class="flex items-center justify-between my-5">
        {{-- <div class="flex justify-between flex-1 sm:hidden">
            @if ($paginator->onFirstPage())
                <span class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 cursor-default leading-5 rounded-md">
                    {!! __('pagination.previous') !!}
                </span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}" class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 leading-5 rounded-md hover:text-gray-500 focus:outline-none focus:ring ring-gray-300 focus:border-blue-300 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150">
                    {!! __('pagination.previous') !!}
                </a>
            @endif

            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}" class="relative inline-flex items-center px-4 py-2 ml-3 text-sm font-medium text-gray-700 bg-white border border-gray-300 leading-5 rounded-md hover:text-gray-500 focus:outline-none focus:ring ring-gray-300 focus:border-blue-300 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150">
                    {!! __('pagination.next') !!}
                </a>
            @else
                <span class="relative inline-flex items-center px-4 py-2 ml-3 text-sm font-medium text-gray-500 bg-white border border-gray-300 cursor-default leading-5 rounded-md">
                    {!! __('pagination.next') !!}
                </span>
            @endif
        </div> --}}

        <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
            <div>
                <p class="text-sm text-gray-700 leading-5">
                    {{ $paginator->firstItem() }} ~ {{ $paginator->lastItem() }}/{{ $paginator->total() }}件中
                    {{-- {!! __('sample') !!}
                    @if ($paginator->firstItem())
                        <span class="font-medium">{{ $paginator->firstItem() }}</span>
                        {!! __('to') !!}
                        <span class="font-medium">{{ $paginator->lastItem() }}</span>
                    @else
                        {{ $paginator->count() }}
                    @endif
                    {!! __('of') !!}
                    <span class="font-medium">{{ $paginator->total() }}</span>
                    {!! __('results') !!} --}}
                </p>
            </div>

            <div>
                <span class="relative z-0 inline-flex shadow-sm rounded-md">
                    {{-- 最初のページ --}}
                    <a href="{{ $paginator->url(1) }}">
                        <div class="w-10 text-center page-item items-center px-2 py-2 text-sm font-medium text-gray-500 bg-white border-gray-300 border cursor-default rounded-l-md leading-5" style="font-size:1.75rem;">
                            &laquo;
                        </div>
                    </a>
                    {{-- 前のページ --}}
                    <a  href="{{ $paginator->previousPageUrl() }}">
                        <div class="w-10 text-center page-item items-center px-2 py-2 text-sm font-medium text-gray-500 bg-white border-gray-300 border-t border-b cursor-default leading-5" style="font-size: 1.75rem;">
                            &lsaquo;
                        </div>
                    </a>
                    {{-- 各ページ --}}
                    @php
                        if ($paginator->lastPage() > __('common.paginateLink')) {
                            if ($paginator->currentPage() <= floor(__('common.paginateLink') / 2)) {
                                $start_page = 1;
                                $end_page = __('common.paginateLink');
                            } elseif ($paginator->currentPage() > $paginator->lastPage() - floor(__('common.paginateLink') / 2)) {
                                $start_page = $paginator->lastPage() - (__('common.paginateLink') - 1);;
                                $end_page = $paginator->lastPage();
                            } else {
                                $start_page = $paginator->currentPage() - (floor((__('common.paginateLink') % 2 == 0 ? __('common.paginateLink') - 1 : __('common.paginateLink'))  / 2));
                                $end_page = $paginator->currentPage() + floor(__('common.paginateLink') / 2);
                            }
                        } else {
                            $start_page = 1;
                            $end_page = $paginator->lastPage();
                        }
                    @endphp
                    @for ($i = $start_page; $i <= $end_page; $i++)
                        @if ($i == $paginator->currentPage())
                            <div class="bg-slate-300 page-item relative inline-flex items-center px-4 py-2 -ml-px text-sm font-medium text-gray-700 bg-white border border-gray-300 cursor-default leading-5"><span class="page-link">{{ $i }}</span></div>
                        @else
                            <a class="page-link" href="{{ $paginator->url($i) }}"><div class="page-item relative inline-flex items-center px-4 py-2 -ml-px text-sm font-medium text-gray-700 bg-white border border-gray-300 cursor-default leading-5">{{ $i }}</div></a>
                        @endif
                    @endfor
                    {{-- 次のページ --}}
                    <a href="{{ $paginator->nextPageUrl() }}">
                        <div class="w-10 text-center page-item items-center px-2 py-2 -ml-px text-sm font-medium text-gray-500 bg-white border border-gray-300 cursor-default leading-5" style="font-size:1.75rem;">
                            &rsaquo;
                        </div>
                    </a>
                    {{-- 最後のページ --}}
                    <a href="{{ $paginator->url($paginator->lastPage()) }}">
                        <div class="w-10 text-center page-item items-center px-2 py-2 -ml-px text-sm font-medium text-gray-500 bg-white border border-gray-300 cursor-default rounded-r-md leading-5" style="font-size:1.75rem;">
                            &raquo;
                        </div>
                    </a>
                </span>
            </div>
        </div>
    </nav>
@endif
