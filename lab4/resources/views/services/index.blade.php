
@extends('services.layout')

@section('content')

    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>🛠️ Управување со Сервисирања на Возила</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('services.create') }}">
                    ➕ Додади Сервисирање
                </a>
            </div>
            <div id="counter">Backlog: </div>
            <div id="revenue">Revenue: </div>
        </div>
    </div>

{{--    @if ($message = Session::get('success'))--}}
{{--        <div class="alert alert-success mt-3">--}}
{{--            <p>{{ $message }}</p>--}}
{{--        </div>--}}
{{--    @endif--}}

    <table class="table table-bordered mt-3">
        <thead>
        <tr>
            <th>#</th>
            <th>Механичар</th>
            <th>Клиент</th>
            <th>Возило</th>
            <th>Рег. Табл.</th>
            <th>Опис</th>
            <th>Цена</th>
            <th>Прием</th>
            <th>Завршување</th>
            <th width="200px">Акција</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($services as $service)
            <tr>
                <td>{{ $service->id }}</td>
                <td>{{ $service->mechanic_name }}</td>
                <td>{{ $service->client_name }}</td>
                <td>{{ $service->vehicle_make }} ({{ $service->vehicle_model }})</td>
                <td>**{{ $service->license_plate }}**</td>
                <td>{{ \Illuminate\Support\Str::limit($service->description, 50) }}</td>
                <td class="price">{{ number_format($service->price, 2) }} MKD</td>
                <td>{{ $service->date_received->format('d.m.Y') }}</td>
                <td>{{ $service->date_completed ? $service->date_completed->format('d.m.Y') : 'Не е завршено' }}</td>
                <td>
                    <form action="{{ route('services.destroy', $service->id) }}" method="POST">
                        <a class="btn btn-primary btn-sm" href="{{ route('services.edit', $service->id) }}">
                            📝 Ажурирај
                        </a>

                        @csrf
                        @method('DELETE')

                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Дали сте сигурни дека сакате да го избришете ова сервисирање?')">
                            🗑️ Избриши
                        </button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <script>
        document.querySelector('#counter').innerHTML +=
            document.querySelectorAll("tr").length-1;
    </script>
    <script>
        let prices = document.querySelectorAll('.price');
        let revenue = 0;

        prices.forEach(p => {
            const value = parseFloat(p.textContent.replace(/[^0-9.-]/g, ""));
            revenue += isNaN(value) ? 0 : value;
        });

        document.querySelector('#revenue').textContent += revenue;
    </script>

    {!! $services->links() !!}

@endsection
