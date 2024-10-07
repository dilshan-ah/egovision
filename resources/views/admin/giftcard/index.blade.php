@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="card shadow mb-4 col-12 p-0">
                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-primary">{{ $pageTitle }}</h6>
                    <h6 class="m-0"><a href="{{ route('user.gift.create') }}"
                            class="text-decoration-none btn btn-primary">Create
                            Gift Card</a>
                    </h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Code</th>
                                    <th>Initial Balance</th>
                                    <th>Balance</th>
                                    <th>Expiry date</th>
                                    <th>Expense Percentage</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($giftCards as $giftCard)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $giftCard->code }}</td>
                                        <td>{{ $giftCard->balance }}৳</td>
                                        <td>{{ $giftCard->initial_balance }}৳</td>
                                        <td>{{ $giftCard->expiry_date }}</td>
                                        <td>{{ $giftCard->cutoff_percentage }}%</td>
                                        <td>
                                            @if ($giftCard->is_active == 1)
                                                Active
                                            @else
                                                Inactive
                                            @endif
                                        </td>
                                        <td class="d-flex">
                                            <a href="{{route('user.gift.edit',$giftCard->id)}}"
                                                class="btn btn-secondary btn-xs mr-2">Edit</a>
                                            <form action="{{ route('user.gift.delete',$giftCard->id) }}" method="post">
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
