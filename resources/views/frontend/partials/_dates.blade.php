@forelse($departures as $item)
<tr>
    <td>{{$item->start}}</td>
    <td>{{$item->end}}</td>
    <td>Available</td>
    <td>${{$item->price}}</td>
    <td>
        <form action="{{ route('trip.book',$item->tour->slug) }}" method="POST">
            @csrf
            <input type="hidden" name="depID" value="{{$item->id}}">
            <button class="btn btn-sm btn-primary" type="submit">Book</button>
        </form>
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