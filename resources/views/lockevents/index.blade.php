@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12 ">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <a href="{{route('add_lockevents')}}" class="btn btn-primary">Добавить заявку</a>
                    <a href="{{route('add_troubletypes')}}" class="btn btn-primary">Добавить тип заявки</a>
                    <a href="{{route('lockevents_report')}}" class="btn btn-primary">Отчет по заявкам</a>
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
                                <th scope="col">Дата</th>
                                <th style="width: 10%" scope="col"># Комнаты</th>
                                <th scope="col">Тип заявки</th>
                                <th style="width: 50%" scope="col">Комментарий</th>
                                <th scope="col">ФИО Инженера</th>
                                
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($items as $item)
                            <tr>
                                <td>{{$item->created_at}}</td>
                                <td><a href="/lockevents/room/{{$item->room_numb}}"><b>{{$item->room_numb}}</b></a></td>
                                <td>{{$item->type_name}}</td>
                                <td>{{$item->comment}}</td>
                                <td>{{$item->name}}</td>
                                
                            </tr>
                            
                            @endforeach
                           
                            
                        </tbody>
                    </table>
                   <?php echo $items->render(); ?>
                    
                    @else

                    @endauth
                </div>
            </div>
        </div>
    </div>
</div>
@endsection