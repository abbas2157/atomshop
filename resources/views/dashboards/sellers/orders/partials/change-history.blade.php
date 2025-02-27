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
                        <td>{{ $item->status ?? '' }}</td>
                        <td>{{ $item->created_at->format('M d, Y h:i A') ?? '' }}</td>
                        <td></td>
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