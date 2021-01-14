<thead>
    <tr class="text-center">
        <th>{{ __('#ID') }}</th>
        <th>{{ __('Coste total') }}</th>
        <th>{{ __('Cupón') }}</th>
        <th>{{ __('Fecha del Pedido') }}</th>
        <th>{{ __('Estado') }}</th>
        <th>{{ __('Número de Cursos') }}</th>
        @if(!$detail)
            <th>{{ __('Acciones') }}</th>
        @endif
    </tr>
</thead>