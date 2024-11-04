@extends('layouts.app')

@section('content')

@php
$policyPages = getContent('policy_pages.element',false,null,true);
@endphp
@php
use App\Helpers\TranslationHelper;
$preferredLanguage = session('preferredLanguage');
$returnText = TranslationHelper::translateText('Return product', $preferredLanguage);
$sevenDay = TranslationHelper::translateText('7 days are over', $preferredLanguage);
$selectItem = TranslationHelper::translateText('Select Items to return', $preferredLanguage);

$orderedItem = TranslationHelper::translateText('Ordered Items', $preferredLanguage);
$productName = TranslationHelper::translateText('Product Name', $preferredLanguage);
$unitPrice = TranslationHelper::translateText('Unit Price', $preferredLanguage);
$quantity = TranslationHelper::translateText('Quantity', $preferredLanguage);
$price = TranslationHelper::translateText('Price', $preferredLanguage);

$subtotal = TranslationHelper::translateText('Subtotal', $preferredLanguage);
$discount = TranslationHelper::translateText('Discount', $preferredLanguage);
$tax = TranslationHelper::translateText('Tax', $preferredLanguage);
$delivery = TranslationHelper::translateText('Delivery Charge', $preferredLanguage);
$total = TranslationHelper::translateText('Total', $preferredLanguage);

$orderStatus = TranslationHelper::translateText('Order Status History', $preferredLanguage);
$orderPending = TranslationHelper::translateText('Order has been placed and pending', $preferredLanguage);
$orderProcessed = TranslationHelper::translateText('Order is being processed', $preferredLanguage);
$orderShipped = TranslationHelper::translateText('Order has been shipped', $preferredLanguage);
$orderCompleted = TranslationHelper::translateText('Order is completed', $preferredLanguage);
$orderFailed = TranslationHelper::translateText('Order has failed', $preferredLanguage);
$orderCancelled = TranslationHelper::translateText('Order has been canceled', $preferredLanguage);
$orderReturned = TranslationHelper::translateText('Order has been returned', $preferredLanguage);

$userDetails = TranslationHelper::translateText('User Details', $preferredLanguage);
$billingAddress = TranslationHelper::translateText('Billing Address', $preferredLanguage);
$paymentMethod = TranslationHelper::translateText('Payment Method', $preferredLanguage);
$cod = TranslationHelper::translateText('Cash on delivery', $preferredLanguage);
$op = TranslationHelper::translateText('Online Payment', $preferredLanguage);
@endphp

<div class="container-fluid">
    <div class="row">

        @if(@$order->status == "Complete")
        <div class="col-12 mb-4">
            <div class="card d-flex justify-content-end align-items-center flex-row p-3">
                @php
                $disableButton = false;
                if ($order->completing_time) {
                $completingDate = \Carbon\Carbon::parse($order->completing_time);
                $currentDate = \Carbon\Carbon::now();
                if ($completingDate->diffInDays($currentDate) > 7) {
                $disableButton = true;
                }
                }
                @endphp
                @if($disableButton)<p class="text-danger me-2 mb-0">{{$sevenDay}}</p> @endif

                <button class="btn btn-outline-dark" @if($disableButton) disabled @endif data-bs-toggle="modal" data-bs-target="#returnModal">{{$returnText }}</button>

                <form action="{{ route('return.make') }}" method="post" id="returnForm">
                    @csrf
                    <div class="modal fade" id="returnModal" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalToggleLabel">{{$selectItem}}</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    @php
                                    $hasItemsToReturn = false;
                                    foreach(@$order->orderItems as $item) {
                                    if(!$item->return) {
                                    $hasItemsToReturn = true;
                                    break;
                                    }
                                    }
                                    @endphp

                                    @if($hasItemsToReturn)
                                    @foreach(@$order->orderItems as $item)
                                    @if(!$item->return)
                                    <div class="form-check justify-content-between d-flex mb-3">
                                        <div>
                                            <input class="form-check-input item-checkbox" type="checkbox" value="{{ $item->id }}" id="flexCheckDefault{{ $item->id }}" name="items[{{ $loop->index }}][item]" data-item-id="{{ $item->id }}">
                                            <label class="form-check-label" for="flexCheckDefault{{ $item->id }}">
                                                {{ @$item->product->name }} x {{ @$item->pair }}
                                            </label>
                                        </div>
                                        <input type="number" name="items[{{ $loop->index }}][quantity]" min="1" max="{{ $item->pair }}" class="quantity-input" disabled />
                                    </div>
                                    @endif
                                    @endforeach
                                    @else
                                    <p>No items available for return.</p>
                                    @endif
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-dark" id="nextButton" data-bs-target="#exampleModalToggle2" data-bs-toggle="modal" disabled>Next</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal fade" id="exampleModalToggle2" aria-hidden="true" aria-labelledby="exampleModalToggleLabel2" tabindex="-1">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalToggleLabel2">Reason to return</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label for="exampleFormControlTextarea1" class="form-label">Write a proper reason</label>
                                        <textarea name="reason" class="form-control mb-3" id="exampleFormControlTextarea1" rows="3"></textarea>

                                        <div class="form-check text-start mb-3">
                                            <input type="checkbox" class="form-check-input" id="privacyPolicy" required>
                                            <label class="form-check-label" for="privacyPolicy">I have read and accept <span>@foreach($policyPages as $policy) <a href="{{ route('policy.pages', [$policy->id, slug($policy->data_values->title)]) }}">{{ __($policy->data_values->title) }}</a> @if(!$loop->last), @endif @endforeach</span></label>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-dark" data-bs-target="#returnModal" data-bs-toggle="modal">Back</button>
                                    <button type="submit" class="btn btn-dark">Return</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>

                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        const checkboxes = document.querySelectorAll('.item-checkbox');
                        const quantityInputs = document.querySelectorAll('.quantity-input');
                        const nextButton = document.getElementById('nextButton');

                        checkboxes.forEach((checkbox, index) => {
                            checkbox.addEventListener('change', function() {
                                // Enable/disable the corresponding quantity input
                                quantityInputs[index].disabled = !this.checked;

                                // Always check the Next button after changing checkbox state
                                checkNextButton();
                            });
                        });

                        // Function to check if all checked items have filled quantities
                        function checkNextButton() {
                            let allValid = true;

                            checkboxes.forEach((checkbox, index) => {
                                if (checkbox.checked) {
                                    if (!quantityInputs[index].value) {
                                        allValid = false; // If any checked box does not have a filled quantity, set to false
                                    }
                                }
                            });

                            // Enable or disable the Next button based on validity
                            nextButton.disabled = !allValid;
                        }

                        // Add event listener to quantity inputs to validate when they change
                        quantityInputs.forEach((input, index) => {
                            input.addEventListener('input', function() {
                                // Ensure Next button is checked whenever the quantity is changed
                                checkNextButton();
                            });
                        });
                    });
                </script>



            </div>
        </div>
        @endif
        <div class="col-lg-8 col-12 mb-4">
            <div class="card mb-4">
                <div class="card-header">
                    <h6 class="m-0 font-weight-bold text-primary">{{$orderedItem}}</h6>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>{{$productName}}</th>
                                <th>{{$unitPrice}}</th>
                                <th>{{$quantity}}</th>
                                <th>{{$price}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(@$order->orderItems)
                            @foreach($order->orderItems as $item)
                            <tr>
                                <td>{{@$loop->iteration}}</td>
                                <td>
                                    {{ @$item->product->name ?? '' }}
                                    @if($item->return)
                                    <span class="text-danger">(Return {{ $item->return->status }})</span>
                                    <span class="text-danger">({{ $item->return->quantity }} products)</span>
                                    @endif
                                </td>

                                <td>{{@$item->price/@$item->pair ?? ''}}BDT</td>
                                <td>{{@$item->pair}}</td>
                                <td>{{@$item->price}}BDT</td>
                            </tr>
                            @endforeach
                            @endif
                        </tbody>
                        <tfoot>
                            <tr>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th>{{$subtotal}}</th>
                                <th>{{@$order->subtotal}} BDT</th>
                            </tr>
                            <tr>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th>{{$discount}}</th>
                                <th>-{{@$order->discount}} BDT</th>
                            </tr>
                            <tr>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th>{{$tax}}</th>
                                <th>{{@$order->tax}} BDT</th>
                            </tr>
                            <tr>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th>{{$delivery}}</th>
                                <th>{{@$order->delivery_charge}} BDT</th>
                            </tr>
                            <tr>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th>{{$total}}</th>
                                <th>{{@$order->amount}}BDT</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-header">
                    <h6 class="m-0 font-weight-bold text-primary">{{$orderStatus}}</h6>
                </div>
                <div class="card-body">
                    <table class="table">
                        <tbody>
                            @if(@$order->created_at)
                            <tr>
                                <td class="text-info">{{$orderPending}}</td>
                                <td>{{ diffForHumans(@$order->created_at) }}</td>
                            </tr>
                            @endif
                            @if(@$order->processing_time)
                            <tr>
                                <td class="text-primary">{{$orderProcessed}}</td>
                                <td>{{ diffForHumans(@$order->processing_time) }}</td>
                            </tr>
                            @endif

                            @if(@$order->shipping_time)
                            <tr>
                                <td class="text-warning">{{$orderShipped}}</td>
                                <td>{{ diffForHumans(@$order->shipping_time) }}</td>
                            </tr>
                            @endif

                            @if(@$order->completing_time)
                            <tr>
                                <td class="text-success">{{$orderCompleted}}</td>
                                <td>{{ diffForHumans(@$order->completing_time) }}</td>
                            </tr>
                            @endif

                            @if(@$order->failing_time)
                            <tr>
                                <td class="text-danger">{{$orderFailed}}</td>
                                <td>{{ diffForHumans(@$order->failing_time) }}</td>
                            </tr>
                            @endif

                            @if(@$order->cancelling_time)
                            <tr>
                                <td class="text-danger">{{$orderCancelled}}</td>
                                <td>{{ diffForHumans(@$order->cancelling_time) }}</td>
                            </tr>
                            @endif

                            @if(@$order->returning_time)
                            <tr>
                                <td class="text-secondary">{{$orderReturned}}</td>
                                <td>{{ diffForHumans(@$order->returning_time) }}</td>
                            </tr>
                            @endif
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
        <div class="col-lg-4 col-12 mb-4">
            <div class="card mb-4">
                <div class="card-header">
                    <h6 class="m-0 font-weight-bold text-primary">{{$userDetails}}</h6>
                </div>
                <div class="card-body">
                    <h4>{{@$order->user->firstname}} {{@$order->user->lastname}}</h4>
                    <h4>{{@$order->user->email}}</h4>
                    <h4>{{@$order->user->mobile}}</h4>
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-header">
                    <h6 class="m-0 font-weight-bold text-primary">{{$billingAddress}}</h6>
                </div>
                <div class="card-body">
                    <h4>{{@$order->name}}</h4>
                    <h4>{{@$order->email}}</h4>
                    <h4>{{@$order->phone}}</h4>
                    <h4>{{@$order->address_one}}</h4>
                    <h4>{{@$order->address_two}}</h4>
                    <h4>{{@$order->company}}</h4>
                    <h4>{{@$order->city}},{{@$order->zip_code}}</h4>
                    <h4>{{@$order->state}}</h4>
                    <h4>{{@$order->country}}</h4>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h6 class="m-0 font-weight-bold text-primary">{{$paymentMethod}}</h6>
                </div>
                <div class="card-body">
                    @if(@$order->payment_method == 'cod')
                    <h4>{{$cod}}</h4>
                    @else
                    <h4>{{$op}}</h4>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

@endsection