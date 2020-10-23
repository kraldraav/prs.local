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
                    {{Form::open(['url' => action('CartridgeController@create'), 'method' => 'POST'])}}
                    <div class="form-group">
                        {{Form::label('CartName_lbl', 'Наименование картриджа*', ['class' => '', 'for' => 'cartridge_name'])}}
                        {{Form::input('cartridge_name', 'cartridge_name', '', ['class' => 'form-control'])}}
                    </div>
                    <div class="form-group">
                        {{Form::label('Desc_lbl', 'Описание*', ['class' => '', 'for' => 'Desc'])}}
                        {{Form::input('Desc', 'Desc', '', ['class' => 'form-control'])}}
                    </div>
                    <div class="form-group">
                        {{Form::label('Count_lbl', 'Наличие*', ['class' => '', 'for' => 'Count'])}}
                        {{Form::number('Count', 'Count', null, ['class' => 'form-control'])}}
                    </div>
                    <div class="form-group">
                        {{Form::label('Threshold_lbl', 'Порог оповещения*', ['class' => '', 'for' => 'Threshold'])}}
                        {{Form::number('Threshold', 'Threshold', null, ['class' => 'form-control'])}}
                    </div>
                    <div class="form-group">
                        {{Form::submit('Добавить картридж', ['id' => 'SubmitBtn', 'class' => 'btn btn-primary pull-right'])}}
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