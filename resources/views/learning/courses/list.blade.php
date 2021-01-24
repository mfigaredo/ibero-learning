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
					@include('partials.learning.courses.single')
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

