@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="card shadow mb-4 col-12 p-0">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">{{ $pageTitle }}</h6>
                <h6 class="m-0"><a href="{{ route('insta.user.create') }}"
                        class="text-decoration-none btn btn-primary">Add Instagram Users</a>
                </h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Access Token</th>
                                <th>Expiry status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($instagrams as $instagram)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$instagram->name}}</td>
                                <td style="word-break: break-all;">{{$instagram->access_token}}</td>
                                <td>
                                    @php
                                    $expiresAt = \Carbon\Carbon::parse($instagram->created_at)->addDays(60);
                                    $remainingDays = now()->diffInDays($expiresAt, false);
                                    @endphp

                                    @if($remainingDays > 0)
                                    Will expire in {{ $remainingDays }} days
                                    @else
                                    <span class="text-danger">Expired</span>
                                    @endif
                                </td>
                                <td class="d-flex">
                                    <a href="{{route('insta.user.edit',$instagram->id)}}"
                                        class="btn btn-secondary btn-xs mr-2">Edit</a>
                                    <form action="{{ route('insta.user.delete',$instagram->id) }}" method="post">
                                        @csrf
                                        @method('delete')
                                        <button type="submit"
                                            class="btn btn-danger btn-xs">Delete</button>
                                    </form>

                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


</div>
</div>
@endsection