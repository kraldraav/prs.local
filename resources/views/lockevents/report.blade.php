@extends('layouts.app')

@section('content')
@auth
<?php
$floors = [4, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28];


?>
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

                    {{Form::open(['url' => action('LockeventsController@generateReport'), 'method' => 'POST'])}}

                    <div class="form-group">
                        {{ Form::label('floor_lbl', 'Этажи', ['class' => '', 'for' => 'floor']) }}
                        @foreach($floors as $floor)
                        {{ Form::checkbox('floor[]', $floor, true) }}
                        {{ $floor }}
                        @endforeach
                        <input type="button" class="btn btn-secondary" id="UnselectBtn" value="Снять выделение">
                    </div>

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
                    <br/><br/>

                    @if(isset($events) && count($events) > 0)
                    <input type="button" id="SaveToExcel" class="btn btn-success" value="Сохранить в Excel"><br/><br/>
                    <table id="lockevents" class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th scope="col">Дата</th>
                                <th scope="col">Номер</th>
                                <th scope="col">Проблема</th>
                                <th scope="col">Комментарий</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($events as $event)
                            <tr>
                                <td>{{$event->created_at}}</td>
                                <td>{{$event->room_numb}}</td>
                                <td>{{$event->type_name}}</td>
                                <td>{{$event->comment}}</td>
                            </tr>
                            @endforeach
                        </tbody> 
                    </table>
                    @endif


                    {{Form::close()}}
                </div>

            </div>
        </div>
    </div>
</div>

<script type="text/javascript">

    $(document).ready(function () {

        $('#SaveToExcel').click(function(){
            exportTableToExcel('lockevents', 'lockevents');
        });

        $('#sdate_input').mask('9999-99-99 99:99:99');

        $('#UnselectBtn').click(function () {
            
            var val = $('#UnselectBtn').val();
            
            if (val == 'Снять выделение') {
                $('input:checkbox').removeAttr('checked');
                $(this).val('Выделить все');
            }
            if (val == 'Выделить все') {
                $('input:checkbox').attr('checked', 'checked');
                $(this).val('Снять выделение');
            }
        });
    });
</script>
@else
<h1>Please login...</h1>
@endauth

@endsection