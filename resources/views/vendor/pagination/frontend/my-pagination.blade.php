@if ($paginator->hasPages())




            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())

                <li class="page-item disabled">
                            <span class="page-link">
                                 <i class="fas fa-chevron-left"></i>
                                 <i class="fas fa-chevron-left"></i>
                            </span>
                </li>

                <li class="page-item disabled">
                            <span class="page-link">
                                 <i class="fas fa-chevron-left"></i>
                            </span>
                </li>

            @else


                <li class="page-item">
                    <a class="page-link" href="{{ $paginator->url(1) }}">
                        <i class="fas fa-chevron-left"></i>
                        <i class="fas fa-chevron-left"></i>
                    </a>
                </li>

                <li class="page-item">
                    <a class="page-link" href="{{ $paginator->previousPageUrl() }}">
                        <i class="fas fa-chevron-left"></i>
                    </a>
                </li>


            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li class="page-item disabled" aria-disabled="true"><span class="page-link">{{ $element }}</span></li>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <!--  Aktiv Link  -->
                            <li class="page-item active" aria-current="page">
                                <span class="page-link">{{ $page }}</span>
                            </li>
                        @else
                            <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                        @endif
                    @endforeach
                @endif
            @endforeach
            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())

                <li class="page-item">
                    <a class="page-link" href="{{ $paginator->nextPageUrl() }}">
                        <i class="fas fa-chevron-right"></i>
                    </a>
                </li>

                <li class="page-item">
                    <a class="page-link" href="{{ $paginator->url($page) }}">
                        <i class="fas fa-chevron-right"></i>
                        <i class="fas fa-chevron-right"></i>
                    </a>
                </li>

            @else

                <li class="page-item disabled">
                            <span class="page-link">
                                 <i class="fas fa-chevron-right"></i>
                            </span>
                </li>

                <li class="page-item disabled">
                            <span class="page-link">
                                 <i class="fas fa-chevron-right"></i>
                                 <i class="fas fa-chevron-right"></i>
                            </span>
                </li>

            @endif

@endif
