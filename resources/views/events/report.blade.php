@extends('layouts.app')

@section('content')
@auth
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

                    {{Form::open(['url' => action('EventsController@generateReport'), 'method' => 'POST'])}}
                        <div class="form-group">
                            {{ Form::label('sdate_lbl', 'Начало периода', ['class' => '', 'for' => 'sdate_input']) }}
                            <div class='input-group date' id='datetimepicker1'>
                                <input value="<?php echo (isset($datetime)) ? $datetime : date('Y-m-d H:i:s'); ?>" type='text' name="sdate_input" id="sdate_input" class="form-control" data-inputmask-inputformat="YYYY-MM-DD H:i:s" placeholder="YYYY-MM-DD H:i:s" />
                                <span class="input-group-addon">
                                    <span></span>
                                </span>
                            </div>
                        </div>
                        <div class="form-group">
                            {{Form::submit('Сгенерировать', ['id' => 'SubmitBtn', 'class' => 'btn btn-primary pull-right'])}}
                        </div>
                    {{Form::close()}}
                    <br/><br/>
                    @if(isset($events) && count($events) > 0)
                    <input type="button" id="SaveToExcel" class="btn btn-success" value="Сохранить в Excel"><br/><br/>
                    <table id="UsedCarts" class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th scope="col">Картридж</th>
                                <th scope="col">Подразделение</th>
                                <th scope="col">Количество</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($events as $event)
                        <tr>
                            <td>{{$event->cartridge_name}}</td>
                            <td>{{$event->depart_name}}</td>
                            <td>{{$event->countItem}}</td>
                        </tr>
                        @endforeach
                       </tbody> 
                    </table>
                    @endif
                </div>

            </div>
        </div>
    </div>
</div>

<script type="text/javascript">

    $(document).ready(function () {
        $('#sdate_input').mask('9999-99-99 99:99:99');
        $('#SaveToExcel').click(function(){
            exportTableToExcel('UsedCarts', 'UsedCarts');
        });
        //UsedCarts
    });
</script>

@else
<h1>Please login...</h1>
@endauth

@endsection
