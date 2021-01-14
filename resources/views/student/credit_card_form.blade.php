@extends('layouts.student')

@section('content')
    <div class="container py-5">
        <!-- Title -->
        <div class="row mb-4">
            <div class="col-lg-8 mx-auto text-center">
                <h1 class="display-4">{{ __('Tus datos de pago') }}</h1>
            </div>
        </div>
        <!-- End -->

        <div class="row">
            <div class="col-lg-7 mx-auto">
                <div class="bg-white rounded-lg shadow-sm p-5">
                    {{-- Credit card form tabs --}}
                    <ul role="tablist" class="nav bg-dark text-white nav-pills rounded-pill nav-fill mb-3">
                        <li class="nav-item">
                            <a data-toggle="pill" href="#nav-tab-card" class="nav-link rounded-pill">
                                <i class="fa fa-credit-card"></i>
                                {{ __('Información de tu tarjeta en :app', ['app' => env('APP_NAME')])}}
                            </a>
                        </li>
                    </ul>
                    {{-- End --}}
                    @include('partials.form_errors')
                    
                    {{-- Credit card form content --}}
                    <div class="tab-content">
                        <div id="nav-tab-card" class="tab-pane fade show active">
                            <form action="{{ route('student.billing.process_credit_card') }}" method="post" role="form">
                                @csrf
                                <div class="form-group">
                                    <label for="card_number">{{ __('Número de la tarjeta') }}</label>
                                    <div class="input-group">
                                        <input type="text" name="card_number" placeholder="{{ __('Número de la tarjeta') }}" required class="form-control digits" value="{{ old('card_number') ?: (auth()->user()->card_last_four ? '************' . auth()->user()->card_last_four : null)  }}" maxlength="16"/>
                                        <div class="input-group-append">
                                            <span class="input-group-text">
                                                <i class="fa fa-cc-visa mx-1"></i>
                                                <i class="fa fa-cc-mastercard mx-1"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-8">
                                        <div class="form-group">
                                            <label>
                                                <span class="hidden-xs">{{ __("Fecha expiración") }}</span>
                                            </label>
                                            <div class="input-group">
                                                <input
                                                    type="text"
                                                    placeholder="{{ __("MM") }}"
                                                    name="card_exp_month"
                                                    class="form-control digits"
                                                    required
                                                    maxlength="2"
                                                />
                                                <input
                                                    type="text"
                                                    placeholder="{{ __("YY") }}"
                                                    name="card_exp_year"
                                                    class="form-control digits"
                                                    required
                                                    maxlength="2"
                                                />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group mb-4">
                                            <label >{{ __("CVC") }}</label>
                                            <input type="text" name="cvc" required class="form-control digits" maxlength="3">
                                        </div>
                                    </div>
                                </div>

                                <button
                                    type="submit"
                                    class="site-btn btn-block rounded-pill shadow-sm"
                                >
                                    {{ __("Guardar tarjeta") }}
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
<script>
$(document).ready(function() {
    $('input.digits').on('input', function(e){
        var maxDigits = $(this).attr('maxlength');
        this.value = this.value.replace(/[^0-9]/g, '');
        // alert(maxDigits);
    });
});
</script>
@endpush