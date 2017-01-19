@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="panel panel-default">
            <div class="panel-heading text-center">
                Учительская
            </div>
            <div class="panel-body">
                <div class="new_ask">
                    {!!
                          Former::vertical_open()
                            ->id('form-asks')
                            ->action(\URL::action('AdminController@postAdd'))
                            ->method('POST')
                            ->data_form()
                    !!}
                    <label class="choose-question">Выберите вопрос</label>
                    <input hidden class="ask_id" name="ask_id">
                    <div class="question" hidden>
                        {!!
                               Former::text('question')
                                   ->label('')

                           !!}
                    </div>
                    <br>
                    <div class="row textarea_question" hidden>
                        <div class="col-sm-12">
                            {!!
                                Former::textarea('answer')
                                    ->label('')
                                    ->placeholder('введите ответ')
                                    ->rows(13)
                            !!}
                        </div>
                    </div>
                    <div class="row textarea_question" hidden>
                        <div class="col-sm-12">
                            <button class="btn btn-primary" id="addAsk">Отправить ответ</button>
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
                        @foreach($asks as $cnt=>$item)
                            <tr>
                                <td class="col-sm-1">
                                    {{++$cnt}})
                                </td>
                                <td class="col-sm-8">
                                    {{ $item->question }}
                                </td>

                                <td class="col-sm-3">
                                    {{ $item->created_at->format('d-m-Y H:i:s')}}
                                </td>
                            </tr>
                            <tr>
                                <td class="col-sm-1">

                                </td>
                                <td class="col-sm-8">
                                    <span class="quest-hidden" hidden>{{ $item->question }}</span>
                                    <span class="quest-id-hidden" hidden>{{ $item->id }}</span>
                                    @if(!empty($item->answer))
                                        {{ $item->answer }}
                                    @endif
                                    @if(empty($item->answer))
                                        <button class="btn btn-primary drawAsk">Ответить</button>
                                    @endif
                                </td>
                                <td class="col-sm-3">
                                </td>
                            </tr>
                        @endforeach
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
    </style>
    <script type="text/javascript">
        $(function () {
            $('.drawAsk').click(function () {
                var $question = $(this).parent().find(".quest-hidden").text();
                var $ask_id = $(this).parent().find(".quest-id-hidden").text();
                $(".new_ask").find(".question").show().find("input").val($question);
                $(".new_ask").find(".ask_id").val($ask_id);
                $(".textarea_question").show();
                $(".choose-question").hide();

                console.log($ask_id);
            });
        });
    </script>
@stop