@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="panel panel-default">
            <div class="panel-heading text-center">
            </div>
            <div class="panel-body">

                <table class="table">
                    <thead>
                    <tr>
                        <th>№</th>
                        <th>ДатаВремя</th>
                        <th>Вопрос</th>
                        <th>Ответ</th>

                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    {!!
                          Former::vertical_open()
                            ->id('form-asks')
                            ->action(\URL::action('AdminController@postAdd'))
                            ->method('POST')
                            ->data_form()
                    !!}
                    @foreach($asks as $cnt=>$item)
                        <tr>
                            <td class="col-sm-1">
                                {{++$cnt}})
                            </td>
                            <td class="col-sm-1">
                                {{ $item->created_at->format('d-m-Y H:i:s')}}
                            </td>
                            <input name="ids[]" value="{{$item->id}}" hidden>
                            <td class="col-sm-3">
                                {!!
                                    Former::textarea('questions[]')
                                        ->label('Вопрос  ученика')
                                        ->rows(7)
                                        ->value($item->question)
                                !!}

                            </td>
                            <td class="col-sm-7">
                                {!!
                                    Former::textarea('answers[]')
                                        ->label('Ваш ответ')
                                        ->rows(7)
                                           ->value($item->answer)
                                !!}
                            </td>
                        </tr>
                    @endforeach
                    <tr>
                        <td colspan="4">
                            <button class="btn btn-primary pull-right" type="submit">Сохранить</button>
                        </td>
                    </tr>
                    {!! Former::close() !!}
                    </tbody>
                </table>
            </div>

        </div>

    </div>
    <style>

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
                        $("#name").val('');
                    }
                });
            });
        });
    </script>
@stop