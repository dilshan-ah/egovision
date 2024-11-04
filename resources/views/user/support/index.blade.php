@extends('layouts.app')
@section('content')
@php
use App\Helpers\TranslationHelper;
$preferredLanguage = session('preferredLanguage');
$newTicket = TranslationHelper::translateText('New Ticket', $preferredLanguage);

$subject = TranslationHelper::translateText('Subject', $preferredLanguage);
$status = TranslationHelper::translateText('Status', $preferredLanguage);
$priority = TranslationHelper::translateText('Priority', $preferredLanguage);
$lastReply = TranslationHelper::translateText('Last Reply', $preferredLanguage);
$action = TranslationHelper::translateText('Action', $preferredLanguage);

$open = TranslationHelper::translateText('Open', $preferredLanguage);
$answered = TranslationHelper::translateText('Answered', $preferredLanguage);
$replied = TranslationHelper::translateText('Replied', $preferredLanguage);
$closed = TranslationHelper::translateText('Closed', $preferredLanguage);

$low = TranslationHelper::translateText('Low', $preferredLanguage);
$medium = TranslationHelper::translateText('Medium', $preferredLanguage);
$high = TranslationHelper::translateText('High', $preferredLanguage);

$minute = TranslationHelper::translateText('minutes ago', $preferredLanguage);
@endphp
<div class="container">
    <div class="row justify-content-center mt-4">
        <div class="col-md-12">
            <div class="text-end">
                <a href="{{route('ticket.open') }}" class="btn btn-dark mb-5 text-uppercase border"> <i class="fa fa-plus"></i>{{$newTicket}}</a>
            </div>
            <div class="table-responsive">
                <table class="table bg-light">
                    <thead>
                        <tr>
                            <th>{{$subject}}</th>
                            <th>{{$status}}</th>
                            <th>{{$priority}}</th>
                            <th>{{$lastReply}}</th>
                            <th>{{$action}}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($supports as $support)
                        <tr>
                            <td> <a href="{{ route('ticket.view', $support->ticket) }}" class="fw-bold"> [@lang('Ticket')#{{ $support->ticket }}] {{ __($support->subject) }} </a></td>
                            <td>
                                @if($support->status == 0)
                                {{$open}}
                                @elseif($support->priority == 1)
                                {{$answered}}
                                @elseif($support->priority == 2)
                                {{$replied}}
                                @elseif($support->priority == 3)
                                {{$closed}}
                                @endif
                            </td>
                            <td>
                                @if($support->priority == 1)
                                {{$low}}
                                @elseif($support->priority == 2)
                                {{$medium}}
                                @elseif($support->priority == 3)
                                {{$high}}
                                @endif
                            </td>
                            <td>{{TranslationHelper::translateText(\Carbon\Carbon::parse($support->last_reply)->diffForHumans(), $preferredLanguage)}} </td>

                            <td>
                                <a href="{{ route('ticket.view', $support->ticket) }}" class="btn btn-dark btn-sm">
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