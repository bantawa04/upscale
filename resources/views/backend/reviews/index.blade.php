@extends('layouts.master')
@section('content')
<div class="row">
    <div class="col-md-12">
        <!-- The time line -->
        <div class="timeline">
            @foreach ($reviews as $item)

            <!-- timeline time label -->
            <div class="time-label">
                <span class="bg-green">{{ date('M j, Y', strtotime($item->created_at)) }}</span>
            </div>
            <!-- /.timeline-label -->
            <!-- timeline item -->
            <div>
                <i class="fas fa-comments bg-blue"></i>
                <div class="timeline-item">
                    <span class="time"><i class="fas fa-clock"></i>
                        {{ date('h: i', strtotime($item->created_at)) }}</span>
                    <h3 class="timeline-header">{{$item->name}} wrote {{$item->title}}</h3>

                    <div class="timeline-body">
                        {{$item->comment}}
                    </div>
                    <div class="timeline-footer d-flex d-flex-row">
                        @if(!$item->status)
                        <a class="btn btn-primary btn-sm"
                            href="{{ route('review.approve', [$item->tour->slug, $item->id]) }}">Approve</a>
                        @endif
                        <form action="{{ route('review.destroy', $item->id) }}" class="ml-2" method="post">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm" type="submit">
                                Delete</button>
                        </form>

                    </div>
                </div>
            </div>
            <!-- END timeline item -->
            @endforeach


            <!-- /.timeline-label -->
        </div>
    </div>
    <!-- /.col -->
</div>
@stop