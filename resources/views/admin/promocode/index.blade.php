@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="card shadow mb-4 col-12 p-0">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">{{ $pageTitle }}</h6>
                <h6 class="m-0"><a href="{{ route('promo.create') }}"
                        class="text-decoration-none btn btn-primary">Create
                        Promo Code</a>
                </h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Code</th>
                                <th>Note</th>
                                <th>Offer Type</th>
                                <th>Free Delivery</th>
                                <th>Offer Amount</th>
                                <th>Minimum Amount</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach(@$promocodes as $promocode)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$promocode->reedem_code}}</td>
                                <td>{{$promocode->note}}</td>
                                <td>{{$promocode->offer_type == 'deliver_offer' ? 'Delivery Offer' : 'Product Offer'}}</td>
                                <td class="text-capitalize">{{$promocode->free_delivery}}</td>
                                <td>{{$promocode->offer_amount}}%</td>
                                <td>{{$promocode->min_amount}}৳</td>
                                <td class="text-capitalize">{{$promocode->status}}</td>
                                <td>
                                    <a href="{{route('promo.edit',$promocode->id)}}" class="btn btn-secondary btn-xs">Edit</a>
                                    <form action="{{route('promo.delete',$promocode->id)}}" method="post" class="d-inline">
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