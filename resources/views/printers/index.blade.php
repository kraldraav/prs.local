@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12 ">
            <div class="panel panel-default">
                <div class="panel-heading"><a class="btn btn-primary" href="{{route('add_printer')}}">Добавить</a></div>

                <div class="panel-body">
                    @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>

                    @endif

                    @auth
                    <h1>Список принтеров/МФУ</h1>
                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th scope="col">Наименование</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach($printers as $printer)
                            <tr>
                                <td>{{$printer->printer_name}}</td>
                                <td><a href="/printers/edit/{{$printer->id}}">Изменить...</a></td>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                    @else

                    @endauth
                </div>
            </div>
        </div>
    </div>
</div>
@endsection