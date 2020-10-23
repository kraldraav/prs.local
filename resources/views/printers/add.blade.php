@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12 ">
            <div class="panel panel-default">
                
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
                    @auth
                    {{Form::open(['url' => action('PrinterController@create'), 'method' => 'POST'])}}
                    <div class="form-group">
                        {{Form::label('Printer_name_lbl', 'Наименование принтера/мфу*', ['class' => '', 'for' => 'printer_name'])}}
                        {{Form::input('printer_name', 'printer_name', '', ['class' => 'form-control'])}}
                    </div>
                    <div class="form-group">
                        {{Form::submit('Добавить устройство', ['id' => 'SubmitBtn', 'class' => 'btn btn-primary pull-right'])}}
                    </div>
                    {{Form::close()}}
                    @else

                    @endauth
                </div>
            </div>
        </div>
    </div>
</div>
@endsection