
@extends('services.layout')

@section('content')

    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>📝 Ажурирај Сервисирање</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('services.index') }}"> Назад</a>
            </div>
        </div>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger mt-3">
            <strong>Внимание!</strong> Имаше проблеми со внесот.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('services.update', $service->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-6">
                <div class="form-group">
                    <strong>Механичар:</strong>
                    <input type="text" name="mechanic_name" value="{{ old('mechanic_name', $service->mechanic_name) }}" class="form-control" placeholder="Име и презиме на механичарот">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-6">
                <div class="form-group">
                    <strong>Клиент:</strong>
                    <input type="text" name="client_name" value="{{ old('client_name', $service->client_name) }}" class="form-control" placeholder="Име и презиме на клиентот">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-6">
                <div class="form-group">
                    <strong>Марка на возило:</strong>
                    <input type="text" name="vehicle_make" value="{{ old('vehicle_make', $service->vehicle_make) }}" class="form-control" placeholder="пр. Volkswagen">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-6">
                <div class="form-group">
                    <strong>Модел на возило:</strong>
                    <input type="text" name="vehicle_model" value="{{ old('vehicle_model', $service->vehicle_model) }}" class="form-control" placeholder="пр. Golf 7">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-6">
                <div class="form-group">
                    <strong>Регистрациска табличка:</strong>
                    <input type="text" name="license_plate" value="{{ old('license_plate', $service->license_plate) }}" class="form-control" placeholder="пр. SK1234AB">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-6">
                <div class="form-group">
                    <strong>Цена (МКД):</strong>
                    <input type="number" step="0.01" name="price" value="{{ old('price', $service->price) }}" class="form-control" placeholder="пр. 5500.00">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-6">
                <div class="form-group">
                    <strong>Датум на прием:</strong>
                    <input type="date" name="date_received" value="{{ old('date_received', $service->date_received->format('Y-m-d')) }}" class="form-control">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-6">
                <div class="form-group">
                    <strong>Датум на завршување (опционално):</strong>
                    <input type="date" name="date_completed" value="{{ old('date_completed', $service->date_completed ? $service->date_completed->format('Y-m-d') : '') }}" class="form-control">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Опис на интервенција:</strong>
                    <textarea class="form-control" style="height:150px" name="description" placeholder="Детален опис на извршениот сервис">{{ old('description', $service->description) }}</textarea>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 text-center mt-3">
                <button type="submit" class="btn btn-success">💾 Зачувај Промени</button>
            </div>
        </div>
    </form>
@endsection
