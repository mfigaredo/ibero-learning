<!-- categories section -->
<section class="categories-section spad">
    <div class="container">
        <div class="section-title">
            <h2>{{ __('Nuestras categorías de cursos') }}</h2>
            <p>{!! __('Aquí tienes todas las categorías de cursos de programación que manejamos en <span class="brand-text">:app</span>', ['app' => env('APP_NAME')]) !!}</p>
        </div>
        <div class="row">
            @forelse($categories as $category)
                {{-- category --}}
                <div class="col-lg-4 col-md-6">
                    <div class="categorie-item">
                        <div class="ci-thumb set-bg" data-setbg="{{ $category->imagePath() }}"></div>
                        <div class="ci-text">
                            <h5>{{ $category->name }}</h5>
                            <p>{{ $category->description }}</p>
                            <span>{{ __(':total cursos', ['total' => $category->courses_count ]) }}</span>
                        </div>
                        <div class="course-author">
                            <a href="{{ route('courses.category', ['category' => $category]) }}" class="site-btn btn-block">
                                {{ __('Ver cursos') }}
                            </a>
                        </div>
                    </div>
                </div>
                {{-- ./category --}}
            @empty
                <div class="container">
                    <div class="empty-results">
                        {{ __('Actualmente no tenemos nada, pero estamos trabajando duro para añadir nuevo contenido.') }}
                    </div>
                </div>
            @endforelse
            
        </div>
    </div>
</section>
<!-- categories section end -->
