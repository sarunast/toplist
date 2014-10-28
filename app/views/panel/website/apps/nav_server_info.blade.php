
<div class="panel" style="background-color: #F9F9F9">
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
                <td><small>{{{$server->server->title}}}</small></td>
                @if (!empty($server->server->subcategory->alias))
                <td><small>{{{$server->server->ip.':'.$server->server->port}}}</small></td>
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