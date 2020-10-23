@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12 ">
            <div class="panel panel-default">
                <div class="panel-heading"><a class="btn btn-primary" href="{{route('add_dependence')}}">Добавить</a></div>
                
                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    
                    @endif
                
    @auth
    <h1>Зависимости расходки к технике</h1>
            <table class="table table-striped table-bordered table-hover">
                <thead>
                    <tr>
                        <th scope="col">Принтер</th>
                        <th scope="col">Картридж</th>
                        <th scope="col">&nbsp;</th>
                    </tr>
                </thead>
                <tbody>
                    
                    @foreach($dependences as $dependence)
                    <tr>
                        <td>{{$dependence->printer_name}}</td>
                        <td>{{$dependence->cartridge_name}}</td>
                        <td><a href="/dependences/edit/{{$dependence->id}}">Изменить...</a></td>
                    </tr>
                    @endforeach
                    
                </tbody>
            </table>
    
    <?php echo $dependences->render(); ?>
    @else
    
    @endauth
        </div>
    </div>
            </div>
            </div>
</div>
@endsection