<!-- course -->
<div class="mix col-lg-3 col-md-4 col-sm-6 @foreach($course->categories as $category) {{ $category->name }} @endforeach">
    <div class="course-item">
        <div class="course-thumb set-bg" data-setbg="{{ $course->imagePath() }}">
            <div class="price">{{ __("Precio :price €", ["price" => $course->price]) }} </div>
        </div>

        

        <div class="course-info">

            @auth
                
                <div class="wish-heart">
                    @if($course->wishedForUser())
                        <i class="fa fa-2x fa-heart text-danger toggle-wish" data-route="{{ route('student.wishlist.toggle', ['course' => $course]) }}"></i>
                    @else
                        <i class="fa fa-2x fa-heart-o toggle-wish" data-route="{{ route('student.wishlist.toggle', ['course' => $course]) }}"></i>
                    @endif
                </div>
                
            @endauth

            <div class="course-text">
                <h5><a href="{{ route('courses.show',['course' => $course]) }}">{{ $course->title }}</a></h5>
                <div class="students">{{ __(":count Estudiantes", ['count' => $course->students_count]) }}</div>
                
            </div>
            <div class="course-author">
                <div class="ca-pic set-bg" data-setbg="img/authors/1.jpg"></div>
                <p>{{ $course->teacher->name }}</p>
            </div>
        </div>
    </div>
</div>