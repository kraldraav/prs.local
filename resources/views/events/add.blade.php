@extends('layouts.app')

@section('content')
@auth

<div class="container">
    <div class="row">
        <div class="col-md-12 ">
            <div class="panel panel-default">
                <div class="panel-heading"><a href="/">Назад</a></div>

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

                    {{Form::open(['url' => action('EventsController@create'), 'method' => 'POST'])}}
                    <div class="form-group">
                        {{Form::label('Depart_lbl', 'Подразделение*', ['class' => '', 'for' => 'Depart_id'])}}
                        {{Form::select('Depart_id', $departs->pluck('depart_name', 'id'), null, ['class' => 'form-control'])}}
                    </div>
                    <div class="form-group">
                        {{Form::label('Room_numb_lbl', 'Кабинет', ['class' => '', 'for' => 'Room_numb'])}}
                        {{Form::text('Room_numb', null, ['class' => 'form-control', 'id' => 'Room_numb', 'disabled' => 'disabled'])}}
                    </div>
                    <div class="form-group">
                        {{Form::label('Printer_lbl', 'Принтер/МФУ*', ['class' => '', 'for' => 'Printer_id'])}}
                        {{Form::select('Printer_id', $printers->pluck('printer_name', 'id'), null, ['id' => 'Printer_id', 'class' => 'form-control', 'data-dependent' => 'Cartridge_id', 'disabled' => 'disabled'])}}
                    </div>
                    <div class="form-group">
                        {{Form::label('Cartridge_lbl', 'Картридж*', ['class' => '', 'for' => 'Cartridge_id'])}}
                        {{Form::select('Cartridge_id', [null], null, ['id' => 'Cartridge_id', 'class' => 'form-control', 'disabled' => 'disabled'])}}
                        {{Form::label('CDesc_lbl', ' ', ['id'=>'Desc_lbl' ,'style' => "font-family: Georgia, 'Times New Roman', Times, serif"])}}
                        <!--{{Form::button('+', ['id="AddCartridgeBtn"','class' => 'btn btn-secondary'])}}-->
                    </div>

                    <div class="form-group">
                        {{Form::submit('Создать заявку', ['id' => 'SubmitBtn', 'class' => 'btn btn-primary pull-right'])}}
                    </div>
                    {{Form::close()}}

                </div>
            </div>
        </div>
    </div>


</div>

@else
<h1>Please login...</h1>
@endauth


<script src="{{asset('js/custom.js')}}"></script>
@endsection