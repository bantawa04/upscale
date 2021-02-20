@forelse($departures as $item)
<tr>
    <td>{{$item->start}}</td>
    <td>{{$item->end}}</td>
    <td>Available</td>
    <td>${{$item->price}}</td>
    <td>
        <a class="btn btn-sm btn-primary" href="#">Book</a>
    </td>
</tr>
@empty
<tr>
    <td colspan="5">
        <div class="alert alert-danger" role="alert">
            <strong>No departure dates found for selected period.</strong>
        </div>
    </td>
</tr>
@endforelse