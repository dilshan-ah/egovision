@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="card shadow mb-4 col-12 p-0">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">{{ $pageTitle }}</h6>
                <h6 class="m-0"><a href="{{ route('shipping.create') }}"
                        class="text-decoration-none btn btn-primary">Create
                        Shipping method</a>
                </h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Title</th>
                                <th>Place</th>
                                <th>Fee</th>
                                <th>Creation Time</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($shippingMethods as $shippingMethod)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$shippingMethod->title}}</td>
                                <td>{{$shippingMethod->place}}</td>
                                <td>{{$shippingMethod->fee}}</td>
                                <td>{{ $shippingMethod->created_at->timezone('Asia/Dhaka')->format('d, M Y / h:i A') }}<br>
                                    <small>{{ $shippingMethod->created_at->diffForHumans() }}</small>
                                </td>
                                <td>
                                    <a href="{{route('shipping.edit',$shippingMethod->id)}}" class="btn btn-secondary btn-xs">Edit</a>
                                    <form action="{{route('shipping.delete',$shippingMethod->id)}}" method="post" class="d-inline">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-danger btn-xs">Delete</button>
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