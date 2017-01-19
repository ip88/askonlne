@foreach($asks as $cnt=>$item)
    <tr>
        <td class="col-sm-1 {{empty($item->answer) ? 'red' :'green'}}">
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
            @if(!empty($item->answer))
                {{ $item->answer }}
            @endif
            @if(empty($item->answer))
                Пока нет ответа
            @endif
        </td>
        <td class="col-sm-3">
        </td>
    </tr>
@endforeach