@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12 ">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <a href="{{route('lockevents')}}" >Назад к списку заявок</a>
                </div>

                <div class="panel-body">
                    @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>

                    @endif

                    @auth
                    <h3>Список заявок по замку #<b><?php echo $id; ?></b></h3>
                    <table class="table table-sm table-hover">
                        <thead>
                            <tr>
                                <th scope="col">Дата</th>
                                <th scope="col">Тип заявки</th>
                                <th scope="col">Комментарий</th>
                                <th scope="col">ФИО Инженера</th>
                            </tr>
                        </thead>
                        <tbody>
                    @foreach($items as $item)
                    <tr>
                        <td scope="row">{{$item->created_at}}</td>
                        <td>{{$item->type_name}}</td>
                        <td>{{$item->comment}}</td>
                        <td>{{$item->name}}</td>
                    </tr>
                    @endforeach
</tbody></table>
                    <?php echo $items->render(); ?>
                    @else

                    @endauth
                </div>
            </div>
        </div>
    </div>
</div>
@endsection