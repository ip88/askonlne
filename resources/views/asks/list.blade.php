@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="panel panel-default">
            <div class="panel-heading text-center">
            </div>
            <div class="panel-body">
                <div class="new_ask">
                    {!!
                          Former::vertical_open()
                            ->id('form-asks')
                            ->action(\URL::action('UserController@postAdd'))
                            ->method('POST')
                            ->data_form()
                    !!}
                    <div class="row">
                        <div class="col-sm-12">
                            {!!
                                Former::textarea('question')
                                    ->label('Ваш вопрос')
                                    ->placeholder('введите вопрос')
                                    ->rows(13)
                            !!}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <button class="btn btn-primary" id="addAsk">Добавить</button>
                        </div>
                    </div>
                    {!! Former::close() !!}
                </div>
                <div class="asks">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>№</th>
                            <th>Вопрос</th>

                            <th>ДатаВремя</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @include('asks.asks_ajax')
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
    <style>
        .new_ask {
            width: 30%;
            min-height: 150px;
            float: left;
        }

        .asks {
            width: 60%;
            min-height: 150px;
            margin-left: 40%;
        }
        .red{
            background: red;
        }
        .green{
            background: darkseagreen;
        }
    </style>
    <script type="text/javascript">
        $(function () {
            $('#addAsk').click(function (stop) {
                stop.preventDefault();
                var formData = new FormData($('form')[0]);

                $.ajax({
                    type: "POST",
                    url: "/user/add",
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function (html) {
                        console.log(html);
                        $(".asks tbody").empty().append(html);
                        $("#question").val('');
                    }
                });
            });
        });
    </script>
@stop