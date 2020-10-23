@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12 ">
            <div class="panel panel-default">
                <div class="panel-heading"><a href="/emails">Назад</a></div>
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
                    @if(isset($success))
                    <div class="alert alert-success">
                        <ul>
                            <li>{{$success}}</li>
                        </ul>
                    </div>
                    @endif
                    @auth

                    <h2>{{$data->address}}</h2>
                    {{Form::open(['url' => action('EmailController@changeRedirectAction'), 'method' => 'POST'])}}
                    {{ Form::hidden('address', $data->address, array('id' => 'email_address')) }}
                    <div class="form-group">
                        {{ Form::label('AliasLbl', 'Список ящиков для перенаправлений', ['class' => '', 'for' => 'AliasesTxtArea']) }}<br/>
                        {{ Form::textarea('AliasesTxtArea', $data->goto, ['id' => 'AliasesTxtArea', 'rows' => 4, 'cols' => 155]) }}
                    </div>
                    <div class="form-group">
                        {{Form::submit('Изменить', ['id' => 'SubmitBtn', 'class' => 'btn btn-primary pull-right'])}}
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