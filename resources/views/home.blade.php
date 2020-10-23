@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12 ">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <a href="{{route('add')}}" class="btn btn-primary">Добавить заявку</a>
                    <a href="{{route('event_report')}}" class="btn btn-primary">Отчет для списания</a>
                </div>

                <div class="panel-body">
                    @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>

                    @endif

                    @auth
                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th style="width: 25%" scope="col">Подразделение</th>
                                <th scope="col">Кабинет</th>
                                <th scope="col">Принтер/МФУ</th>
                                <th style="width: 10%" scope="col">Картридж</th>
                                <th scope="col">ФИО Инженера</th>
                                <th scope="col">Дата замены</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach($events as $event)
                            <tr>
                                <td>{{$event->depart_name}}</td>
                                <td>{{$event->room_numb}}</td>
                                <td>{{$event->printer_name}}</td>
                                <td>{{$event->cartridge_name}}</td>
                                <td>{{$event->name}}</td>
                                <td>{{$event->updated_at}}</td>
                                <td>@if (strtotime("now") <= strtotime('+1 day', strtotime($event->updated_at)))
                                    <a href="/reprint/{{$event->id}}" target="_blank">Распечатать</a>  

                                    @endif
                                </td>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>

                    <?php echo $events->render(); ?>
                    @else

                    @endauth
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
