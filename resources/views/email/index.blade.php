@extends('layouts.app')

@section('content')
<!--<script src="http://code.icndb.com/jquery.icndb.js"></script>-->

<script type="text/javascript">


    function ClearEmail(address){
        //console.log(address);
        
        if(address !== ''){
           $.ajax({
               type: 'GET',
               url: '/emails/clearEmail/'+address,
               success: function(data){
                   console.log(data);
               }
           }); 
        }
    }

    $(document).ready(function () {

        $('#emails').tablesorter({theme: 'default'});

        $('#btnTik').click(function () {
            $.ajax({
                type: "GET",
                url: "https://api.icndb.com/jokes/random",
                dataType: "json",
                success: function (msg) {
                    //$("#joke").html(msg.value.joke);
                    $('#modalBody').html(msg.value.joke);
                },
                error: function (req, status, error) {
                    alert(req + " " + status + " " + error);
                }
            });
            $('#exampleModalCenter').trigger('focus');
        });
        $("#inputfilter").keyup(function () {
            filter = new RegExp($(this).val(), 'i');
            $("#emails tbody tr").filter(function () {
                $(this).each(function () {
                    found = false;
                    $(this).children().each(function () {
                        content = $(this).html();
                        if (content.match(filter)) {
                            found = true
                        }
                    });
                    if (!found) {
                        $(this).hide();
                    } else {
                        $(this).show();
                    }
                });
            });
        });
        $('#myModal').on('shown.bs.modal', function () {


            $('#myInput').trigger('focus')
        });
    });
</script>
<div class="container">
    <div class="row">
        <div class="col-md-12 ">
            <div class="panel panel-default">
                <!--<div class="panel-heading"><a class="btn btn-primary" href="{{route('add_printer')}}">Добавить</a></div>-->

                <div class="panel-body">
                    @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>

                    @endif

                    @auth
                    <h1>Список корпоративных e-mail</h1>
                    <div class="alert alert-primary" role="alert">
                        <div class="container">
                            <table>
                                <tr>
                                    <td>Уважаемые коллеги, данная страница находится на этапе разработки и тестирования!<br/>
                                        Не пытайтесь активно <button type="button" class="btn btn-sm btn-danger" id="btnTik" data-toggle="modal" data-target="#exampleModalCenter">тЫкать</button> в неё!<br/>
                                        С Уважением, ваш любимый системный администратор! ;)</td>
                                    <td><img src="https://media2.giphy.com/media/29N7io9xsCMaA/giphy.gif?cid=790b76115cdca84d6e4e5866596c308f&rid=giphy.gif" height="75px"/></td>
                                </tr>
                            </table>
                            <br/>

                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">Фильтр:</span>
                            </div>
                            <input id="inputfilter" type="text" class="form-control" placeholder="some text" aria-label="some text" aria-describedby="basic-addon1">
                        </div>
                        <table id="emails" class="table table-striped table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">Наименование</th>
                                    <th scope="col">Состояние ящика</th>
                                    <th scope="col">Сотрудник</th>
                                    <th scope="col">Квота (Мб)</th>
                                    <th scope="col">Использовано Мб</th>
                                    <th scope="col">Редиректы</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($emails as $email)
                                <tr class="<?php echo ($email->active == 1) ? 'success' : 'danger'; ?>">
                                    <?php
                                    $status = ($email->active == 1) ? 'Активен' : 'Заблокирован';
                                    $isFull = ($email->used >= $email->quota) ? '<span class="badge badge-danger">Переполнен!</span>' : '';
                                    ?>
                                    <td>{{$email->address}}</td>
                                    <td><?php echo $status . '<br/>' . $isFull; ?></td>
                                    <td><a href="#">{{$email->fio}}</a></td>
                                    <td><a href="#">{{$email->quota}}</a></td>
                                    <td><?php
                                        echo $email->used . '<br/>';
                                        echo ($isFull != '') ? '<input type="button" onclick="ClearEmail(\''.$email->address.'\');return false;" id="ClearEmailBtn"  type="button" class="btn btn-primary btn-sm" value="Очистить">' : '';
                                        ?></td>
                                    <td><a href="/emails/changeRedirect/{{$email->address}}">{{$email->redirect}}</a></td>
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

    <!-- Modal -->
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">АГА! Все-таки тыкнул!</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div id="modalBody" class="modal-body">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" id="CloseRefBtn">Закрыть</button>
                </div>
            </div>
        </div>
    </div>
    @endsection