@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12 ">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <a href="{{route('lockevents')}}">Назад к списку заявок</a>
                </div>

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
                    
                    {{Form::open(['url' => action('LockeventsController@create'), 'method' => 'POST'])}}
                     <div class="form-group">
                        {{Form::label('Room_numb_lbl', 'Номер комнаты*', ['class' => '', 'for' => 'Room_numb'])}}
                        {{Form::text('Room_numb', null, ['placeholder'=>'Введите 4х значный номер комнаты (например 0942)', 'maxlength' => 4, 'class' => 'form-control', 'id' => 'Room_numb'])}}
                    </div>
                    <div class="form-group">
                        {{Form::label('Trouble_type_lbl', 'Тип заявки*', ['class' => '', 'for' => 'Trouble_type'])}}
                        {{Form::select('Trouble_type', $trouble_types->pluck('type_name', 'id'), null, ['id' => 'Trouble_type', 'class' => 'form-control'])}}
                    </div>
                    <div class="form-group">
                       {{Form::label('Comment_lbl', 'Комментарий', ['class' => '', 'for' => 'Comment'])}} 
                       {{Form::textarea('Comment', null, ['class' => 'form-control', 'id' => 'Comment'])}}
                    </div>
                    <div class="form-group">
                        {{Form::submit('Создать заявку', ['id' => 'SubmitBtn', 'class' => 'btn btn-primary pull-right'])}}
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