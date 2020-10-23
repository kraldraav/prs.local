@extends('layouts.app')

@section('content')
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

                    @auth

                    {{Form::open(['route' => 'change_profile'])}}
                    <div class="form-group">
                        {{Form::label('name_lbl', 'Отображаемое имя')}}
                        {{Form::input('name', 'name', $currUser->name, ['class' => 'form-control'])}}
                    </div>
                    <div class="form-group">
                        {{Form::submit('Изменить', ['class' => 'btn btn-primary'])}}
                    </div>
                    {{Form::close()}}

                    @else
                    <h1>Please login...</h1>
                    @endauth
                </div>
            </div>
        </div>
    </div>


</div>
@endsection