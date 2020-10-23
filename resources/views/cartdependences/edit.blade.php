@extends('layouts.app')

@section('content')
@auth

<div class="container">
    <div class="row">
        <div class="col-md-12 ">
            <div class="panel panel-default">
                <div class="panel-heading"><a href="{{route('dependences')}}">Назад к списку</a></div>

                <div class="panel-body">
                    @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>

                    @endif
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    {{Form::open(['url' => action('Cartdependences@save'), 'method' => 'POST'])}}
                    <div class="form-group">
                        {{Form::hidden('id', $dependences->id)}}
                        {{Form::label('Printer_lbl', 'Принтер/МФУ', ['class' => 'form-control', 'for' => 'Printer_id'])}}
                        {{Form::select('Printer_id', $printers->pluck('printer_name', 'id'), $dependences->printer_id, ['class' => 'form-control', 'data-dependent' => 'Cartridge_id'])}}
                    </div>
                    <div class="form-group">
                        {{Form::label('Cartridge_lbl', 'Картридж', ['class' => 'form-control', 'for' => 'Cartridge_id'])}}
                        {{Form::select('Cartridge_id', $cartridges->pluck('cartridge_name', 'id'), $dependences->cartridge_id, ['class' => 'form-control'])}}
                    </div>

                    <div class="form-group">
                        {{Form::submit('Изменить зависимость', ['class' => 'btn btn-primary'])}}
                    </div>
                    {{Form::close()}}
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@else
<h1>Please login...</h1>
@endauth

@endsection