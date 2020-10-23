@extends('layouts.app')

@section('content')
@auth

<div class="container">
    <div class="row">
        <div class="col-md-12 ">
            <div class="panel panel-default">
                <div class="panel-heading"><a href="/lockevents">Назад</a></div>

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

                    {{Form::open(['url' => action('TroubletypesController@create'), 'method' => 'POST'])}}
                    <div class="form-group">
                        {{Form::label('Type_name_lbl', 'Тип заявки для замков', ['class' => '', 'for' => 'Type_name'])}}
                        {{Form::text('Type_name', null, ['class' => 'form-control', 'id' => 'Type_name'])}}
                    </div>
                    <div class="form-group">
                        {{Form::submit('Создать новый тип', ['id' => 'SubmitBtn', 'class' => 'btn btn-primary pull-right'])}}
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