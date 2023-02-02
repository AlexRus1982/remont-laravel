{{--<!-- Панель поисковых логов -->--}}
<div class="tab-pane fade" id="nav-search-logs" role="tabpanel" aria-labelledby="nav-search-logs-tab" tabindex="0">
    <table class="table table-striped">
        <thead class="table-info sticky-top" style="top: -10px;">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Поисковый запрос</th>
                <th scope="col">Дата и время поиска</th>
            </tr>
        </thead>
        <tbody>
            @php
                $items = DB::table('searching_logs')->get();
                
                $number = 1;
                $html = "";
                foreach($items as $item){
                    $html .= "
                        <tr>
                            <th scope='row'>{$number}</th>
                            <td>{$item->search_text}</td>
                            <td>{$item->timestamp}</td>
                        </tr>
                    ";
                    $number++;
                }

                echo $html;
            @endphp
        </tbody>
    </table>
</div>