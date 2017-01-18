@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="panel panel-default">
            <div class="panel-heading">
                <b>Добавление новости</b>
            </div>
            <div class="panel-body">
                {!!
                    Former::vertical_open()
                        ->id('form_news')
                        ->action(\URL::action('NewsController@postAdd'))
                        ->method('POST')
                        ->data_form()
                !!}
                <div class="row">
                    <div class="col-sm-4">
                        {!!
                            Former::textarea('name')
                                ->label('Титул')
                                ->placeholder('введите титул')
                                ->rows(3)
                        !!}
                    </div>
                    <div class="col-sm-6">
                        {!!
                            Former::textarea('text')
                                ->label('Текст новости')
                                ->placeholder('введите текст')
                                ->rows(11)
                        !!}
                    </div>
                    <div class="col-sm-2">
                        {!!
                            Former::date('date_start')
                                ->label('Дата публикации')
                                ->placeholder('введите дату')
                                ->value(\Carbon\Carbon::now()->format('Y-m-d'))
                        !!}
                    </div>
                    <input name="enabled" value="1" hidden>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <button class="btn btn-primary pull-right" type="submit">Добавить</button>
                    </div>
                </div>
                {!! Former::close() !!}

            </div>
@stop
