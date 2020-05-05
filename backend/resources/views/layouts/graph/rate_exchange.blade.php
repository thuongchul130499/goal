<table class="table table-stretched">
    <thead>
      <tr>
        <th>Thành phố</th>
        <th>Loại</th>
        <th>Mua vào</th>
        <th>Bán ra</th>
      </tr>
    </thead>
    <tbody>
        @foreach($ratesGold->ratelist->city as $item)
            <tr>
                <td @if(count($item->item)>1)  {{ "rowspan=" . (count($item->item)+1) }} @endif>
                    {{ (string)$item['name'] }}
                </td>
                @php 
                    $first = reset($item->item);
                    next($item);
                @endphp
                <td>
                    {{ (string)$first['type'] }}
                </td>
                <td>
                    <div class="badge badge-danger">{{ (string)$first['sell'] }}</div>
                </td>
                <td>
                    <div class="badge badge-success">{{ (string)$first['buy'] }}</div>
                </td>
            </tr>
            @if(count($item->item) >1 )
               @foreach($item->item as $t)
                <tr>
                    <td>
                        {{ (string)$t['type'] }}
                    </td>
                    <td>
                        <div class="badge badge-danger">{{ (string)$first['sell'] }}</div>
                    </td>
                    <td>
                        <div class="badge badge-success">{{ (string)$t['buy'] }}</div>
                    </td>
                </tr>
                @endforeach
            @endif
        @endforeach
    </tbody>
  </table>