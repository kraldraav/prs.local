@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12 ">
            <div class="panel panel-default">
                <div class="panel-heading"><a class="btn btn-primary" href="{{route('add_cartridge')}}">Добавить</a></div>
                
                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    
                    @endif
                
    @auth
    <h1>Список картриджей и наличие</h1>

            <table class="table table-striped table-bordered table-hover">
                <thead>
                    <tr>
                        <th scope="col">Наименование</th>
                        <th scope="col">Описание</th>
                        <th scope="col">Количество</th>
                        <th scope="col">Значение оповещения</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    
                    @foreach($cartridges as $cartridge)
                    <?php 
                    
                    if($cartridge->count > $cartridge->threshold)
                    {
                        $class = 'background-color:#D3FCB5;';
                    }    
                    
                    if($cartridge->count == $cartridge->threshold)
                    {
                        $class = 'background-color:#FFB561;';
                    }
                    
                     if($cartridge->count < $cartridge->threshold)
                    {
                        $class = 'background-color:#FF8888';
                    }
                    
                    
                    ?>
                    <tr style="{{$class}}">
                        <td>{{$cartridge->cartridge_name}}</td>
                        <td>{{$cartridge->desc}}</td>
                        <td>{{$cartridge->count}}</td>
                        <td>{{$cartridge->threshold}}</td>
                        <td><a href="/cartridges/edit/{{$cartridge->id}}">Изменить...</a></td>
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