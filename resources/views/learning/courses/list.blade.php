{{-- Course Section --}}
<section class="course-section spad">
	<div class="container">
		<div class="section-title mb-3">
			<h2>{{ __('Listado de Cursos') }}</h2>
			<p>
				{{ __ ('Aquí tienes los cursos de la plataforma') }}
			</p>
		</div>
		<div class="course-wrap">
			<div class="row course-items-area">
				@forelse($courses as $course)
					{{-- course --}}
					<div class="mix col-lg-3 col-md-4 col-sm-6">
						<div class="course-item">
							<div class="course-thumb set-bg" data-setbg="{{ $course->imagePath() }}">
								<div class="price">
									{{ __('Precio: :price Eur', ['price' => $course->price]) }}
								</div>
							</div>
							<div class="course-info">
								<div class="course-text">
									<h5>{{ $course->title }}</h5>
									<div class="students">
										{{ __(':count Estudiantes', ['count' => $course->students_count])}}
									</div>
								</div>
								<div class="course-author">
									<div class="ca-pic set-bg" data-setbg="img/authors/1.jpg"></div>
									<p>{{ $course->teacher->name }}</p>
								</div>
								<div class="course-author">
									<a href="{{ route('courses.show', ['course' => $course]) }}" class="btn-block site-btn">{{ __('Ver el curso') }}</a>
								</div>
							</div>
						</div>
					</div>
				@empty
					<div class="col-12">
						<div class="empty-results">
								{!! __("No hay ningún curso para mostrar") !!}
						</div>
					</div>
				@endforelse
			</div>

			<div class="row justify-content-center mt-2">
				@if(count($courses))
						{{ $courses->links() }}
				@endif
			</div>
		</div>
	</div>
</section>

