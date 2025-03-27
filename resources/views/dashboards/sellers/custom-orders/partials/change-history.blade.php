<div class="az-content-label mg-b-5 mt-4">Order Change history</div>
<p class="mg-b-20">All order status Change related to this order </p>
<div class="table-responsive">
    <table class="table az-table-reference mg-b-0" >
        <thead>
            <tr>
                <th>Status</th>
                <th>Date & Time</th>
                <th>Others</th>
            </tr>
        </thead>
        <tbody>
            @if($order_change_status->isNotEmpty())
                @foreach ($order_change_status as $item)
                    <tr>
                        <td class="align-middle">{{ $item->status ?? '' }}</td>
                        <td class="align-middle">{{ $item->created_at->format('M d, Y h:i A') ?? '' }}</td>
                        <td>
                            @php
                                $payload = [];
                                if(!is_null($item->payload)) {
                                    $payload = json_decode($item->payload,true);
                                    $keys = array_keys($payload);
                                }
                            @endphp
                            @if(!empty($payload))
                                @for($i = 0; $i < count($keys); $i++) 
                                    @if($keys[$i] == 'img')
                                        <div> <b>Picture : </b> <a target="_blank" href="{{ asset($payload[$keys[$i]]) }}">View</a> <br></div>
                                    @else
                                        <div> <b>{{ ucfirst(str_replace('_', ' ', $keys[$i])) }} : </b> {{ $payload[$keys[$i]] ?? '' }} <br></div>
                                    @endif
                                @endfor
                            @endif
                        </td>
                    </tr>
                @endforeach
            @else
            <tr>
                <td colspan="5"  class="align-middle text-center"> No Date Found</td>
            </tr>
            @endif
            
        </tbody>
    </table>
</div>