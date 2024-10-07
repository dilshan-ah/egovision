@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center mt-4">
        <div class="col-md-12">
            <div class="text-end">
                <a href="{{route('ticket.open') }}" class="btn btn-sm btn-primary mb-2"> <i class="fa fa-plus"></i> @lang('New Ticket')</a>
            </div>
            <div class="table-responsive">
                <table class="table bg-light">
                    <thead>
                        <tr>
                            <th>@lang('Subject')</th>
                            <th>@lang('Status')</th>
                            <th>@lang('Priority')</th>
                            <th>@lang('Last Reply')</th>
                            <th>@lang('Action')</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($supports as $support)
                        <tr>
                            <td> <a href="{{ route('ticket.view', $support->ticket) }}" class="fw-bold"> [@lang('Ticket')#{{ $support->ticket }}] {{ __($support->subject) }} </a></td>
                            <td>
                                @if($support->status == 0)
                                @lang('Open')
                                @elseif($support->priority == 1)
                                @lang('Answered')
                                @elseif($support->priority == 2)
                                @lang('Replied')
                                @elseif($support->priority == 3)
                                @lang('Closed')
                                @endif
                            </td>
                            <td>
                                @if($support->priority == 1)
                                @lang('Low')
                                @elseif($support->priority == 2)
                                @lang('Medium')
                                @elseif($support->priority == 3)
                                @lang('High')
                                @endif
                            </td>
                            <td>{{ \Carbon\Carbon::parse($support->last_reply)->diffForHumans() }} </td>

                            <td>
                                <a href="{{ route('ticket.view', $support->ticket) }}" class="btn btn-primary btn-sm">
                                    <i class="fa fa-desktop"></i>
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="100%" class="text-center">{{ __($emptyMessage) }}</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{$supports->links()}}

        </div>
    </div>
</div>
@endsection