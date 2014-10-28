
<div class="panel" style="background-color: rgba(255,255,255,0.7);margin-bottom: 0">
    <div class="panel-body" style="padding:3px;">
        @if(count($servers))
        <table class="table" style="margin-bottom: 0; margin-top: -6px">
            <tbody>
            @foreach($servers as $server)

                <tr style="padding: 0; margin: 0">
                    <td>
                        @if ($server->server->online)
                    <img src="/pic/green.png" alt="Server Online" class="top-tooltip" data-toggle="tooltip" data-placement="top" data-original-title="Server Online">
                    @else
                    <img src="/pic/red.png" alt="Server Offline" class="top-tooltip" data-toggle="tooltip" data-placement="top" data-original-title="Server Offline">
                    @endif
                    </td>
                    <td>{{{$server->server->title}}}</td>
                    @if (!empty($server->server->subcategory->alias))
                    <?php

                    if(Cache::has($server->server->id)){
                        $general = Cache::get($server->server->id);
                    }else{
                        $gq = new Gameq\Gameq();
                        $gq->addServer(array(
                            'id' => 'data',
                            'type'=> $server->server->subcategory->alias,
                            'connect_host' => $server->server->ip.':'.$server->server->port,
                        ));
                        $results = $gq->requestAllData();
                        $general = $results['data']['general'];
                        Cache::add($server->server->id, $general, 5);
                    }

                    ?>
                    <td>
                    @if(isset($general['num_players']) && isset($general['max_players']))
                    {{{$general['num_players'].'/'.$general['max_players']}}}
                    @endif
                    </td>
                    <td>
                    @if(isset($general['map']))
                    {{{$general['map']}}}
                    @endif
                    </td>
                    <td>{{{$server->server->ip.':'.$server->server->port}}}</td>
                    @endif
                </tr>
            @endforeach
            </tbody>
        </table>
        @else
        <p class="text-center">
            Add server to your Website
        </p>
        @endif
    </div>
</div>