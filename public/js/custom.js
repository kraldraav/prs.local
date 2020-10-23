$(document).ready(function () {
    function getDesc() {
        var Cartridge_id = $('select[name="Cartridge_id"] option:selected').val();
        $('#alertCart').remove();
        if (Cartridge_id > 0) {
            $.ajax({
                url: '/cartridges/desc/' + Cartridge_id,
                type: "GET",
                dataType: "json",
                beforeSend: function () {
                    $('#loader').css("visibility", "visible");
                },

                success: function (data) {

                    $("#Desc_lbl").empty();
                    var count_items = data[0].count;
                    if (count_items <= 0)
                    {
                        //alert('Выбранные картриджи отсутствуют!!! Необходимо заказывать!!!');
                        $('#SubmitBtn').attr('class', 'btn btn-secondary pull-right disabled');
                        $('#SubmitBtn').attr('aria-disabled', 'true');
                        $('#SubmitBtn').attr('type', 'button');

                        $('<div class="alert alert-danger alert-dismissible" id="alertCart"><strong>Ошибка!</strong> Картриджей данного типа нет в наличии!!! Передай информацию Шилину А.В. <a href="#" onClick="return sendAlert();" class="btn btn-warning" id="SendAlert">Отправить уведомление</a></div>').insertBefore($("#Desc_lbl"));

                    } else
                    {
                        $('#SubmitBtn').attr('class', 'btn btn-primary pull-right');
                        $('#SubmitBtn').attr('aria-disabled', 'false');
                        $('#SubmitBtn').attr('type', 'submit');
                    }
                    $("#Desc_lbl").text(data[0].desc + '| В наличии: ' + count_items + "шт.");
                },
                complete: function () {
                    $('#loader').css("visibility", "hidden");
                }
            });
        } else {
            $("#Desc_lbl").empty();
        }
    }

    $('select[name="Depart_id"]').on('change', function () {
        var Depart_id = $('select[name="Depart_id"] option:selected').val()
        if (Depart_id > 1) {
            $('#Room_numb').attr("disabled", false);
            $('#Printer_id').attr("disabled", false);
        } else
        {
            $('#Room_numb').attr("disabled", true);
            $('#Room_numb').val('');
            $('#Printer_id').attr("disabled", true);
            $('select[name="Printer_id"]').val("1").change();
            $('#Cartridge_id').attr("disabled", true);
            $('select[name="Cartridge_id"]').empty();
        }
    });

    if ($('select[name="Printer_id"] option:selected').text()) {
        var printer_id = $('select[name="Printer_id"] option:selected').val();
        if (printer_id > 1) {
            $.ajax({
                url: '/cartridges/get/' + printer_id,
                type: "GET",
                dataType: "json",
                beforeSend: function () {
                    $('#loader').css("visibility", "visible");
                },

                success: function (data) {

                    $("#Desc_lbl").empty();
                    $('select[name="Cartridge_id"]').empty();
                    $('select[name="Cartridge_id"]').append('<option value="0"></option>');
                    $.each(data, function (key, value) {


                        $('select[name="Cartridge_id"]').append('<option value="' + key + '">' + value + '</option>');

                    });
                },
                complete: function () {
                    $('#loader').css("visibility", "hidden");
                }
            });
        } else {
            $('select[name="Cartridge_id"]').empty();
            $("#Desc_lbl").empty();
        }
    }

    $('#AddCartridgeBtn').click(function () {
        $("<li class='item'>new Select</li>").insertBefore($("#AddCartridgeBtn"));
    });

    $('select[name="Printer_id"]').on('change', function () {
        var printer_id = $(this).val();
        $('#alertCart').remove();
        if (printer_id > 1) {
            $.ajax({
                url: '/cartridges/get/' + printer_id,
                type: "GET",
                dataType: "json",
                beforeSend: function () {
                    $('#loader').css("visibility", "visible");
                },

                success: function (data) {

                    $("#Desc_lbl").empty();
                    $('select[name="Cartridge_id"]').empty();

                    var countVars = Object.keys(data).length;
                    if (countVars > 1) {
                        $('select[name="Cartridge_id"]').append('<option value="0"></option>');
                    }


                    $.each(data, function (key, value) {
                        $('select[name="Cartridge_id"]').append('<option value="' + key + '">' + value + '</option>');
                    });
                    if (countVars == 1)
                    {
                        getDesc();
                    }
                    $('#Cartridge_id').attr("disabled", false);
                },
                complete: function () {
                    $('#loader').css("visibility", "hidden");
                }
            });
        } else {
            $('select[name="Cartridge_id"]').empty();
            $("#Desc_lbl").empty();
        }

    });

    $('select[name="Cartridge_id"]').on('change', function () {
        getDesc();
    });
});