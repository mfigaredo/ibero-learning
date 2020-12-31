<div>
    <ul class="list-inline">
        {{-- <li class="list-inline-item">
            <i class="fa-2x fa fa-star{{ $rating >= 1 ? ' yellow' : '' }}"></i>
        </li>
        <li class="list-inline-item">
            <i class="fa-2x fa fa-star{{ $rating >= 2 ? ' yellow' : '' }}"></i>
        </li>
        <li class="list-inline-item">
            <i class="fa-2x fa fa-star{{ $rating >= 3 ? ' yellow' : '' }}"></i>
        </li>
        <li class="list-inline-item">
            <i class="fa-2x fa fa-star{{ $rating >= 4 ? ' yellow' : '' }}"></i>
        </li> --}}

        @foreach(range(1,5) as $st)
            <li class="list-inline-item">
                <i class="fa-2x fa fa-star{{ $rating >= $st ? ' yellow' : '' }}"></i>
            </li>
        @endforeach

        <!-- hide counter on reviews loop -->
        @if(!isset($hideCounter))
            <li class="list-inline-item">
                <h3>({{ $course->reviews->count() }})</h3>
            </li>
        @endif
    </ul>
</div>
