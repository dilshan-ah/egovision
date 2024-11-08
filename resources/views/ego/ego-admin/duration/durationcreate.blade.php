@extends('admin.layouts.app')
@section('content')
<link rel="stylesheet" href="{{ asset('ego-assets/css/jodit.fat.min.css') }}">
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">{{ $pageTitle }}</h6>
            <h6 class="m-0"><a href="{{ route('duration.index') }}"
                    class="text-decoration-none btn btn-primary">Duration
                    List</a>
            </h6>
        </div>
        <div class="card-body">
            <form action="{{ route('duration.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="form-group col-6">
                        <label>Duration Name</label>
                        <input type="text" class="form-control" name="name"
                            placeholder="please enter duration name....">
                        @error('name')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group col-6">
                        <label id="duration-field-label">Months (number of months)</label> <!-- Updated label -->
                        <input type="number" class="form-control" name="month"
                            placeholder="Please enter duration...">
                        @error('month')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group col-6">
                        <label id="duration-label">Count as Day</label> <!-- Added ID here -->
                        <select name="is_month" class="form-control" id="isMonthSelect">
                            <option value="1">Yes</option>
                            <option value="0">No</option>
                        </select>
                        @error('is_month')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <script>
                        document.getElementById('isMonthSelect').addEventListener('change', function() {
                            var selectedValue = this.value;
                            var label = document.getElementById('duration-label');
                            var fieldLabel = document.getElementById('duration-field-label');

                            if (selectedValue === '0') {
                                label.textContent = 'Count as Month';
                                fieldLabel.textContent = 'Days (number of days)'; // Changes label to "Days"
                            } else {
                                label.textContent = 'Count as Day';
                                fieldLabel.textContent = 'Months (number of months)'; // Reverts to "Months"
                            }
                        });
                    </script>

                    <div class="form-group col-6">
                        <label for="">Duration Image</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="inputGroupFile01"
                                name="duration_image">
                            <label class="custom-file-label" for="inputGroupFile01">Choose Image</label>
                            @error('duration_image')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div id="imagePreview" style="margin-top: 10px;"></div>
                    </div>
                    <div class="form-group col-12">
                        <label for="">Duration Description</label>
                        <textarea name="duration_description" class="form-control" id="editor1"></textarea>
                        @error('duration_description')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group col-12">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@push('script')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="{{ asset('ego-assets/js/jodit.fat.min.js') }}"></script>
<script>
    $(document).ready(function() {

        const editor1 = new Jodit('#editor1', {
            toolbarAdaptive: false,
            toolbarSticky: true,
            height: 300,
        });


        $('#inputGroupFile01').on('change', function() {
            var file = this.files[0];
            if (file) {
                $(this).next('.custom-file-label').html(file.name);
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#imagePreview').html('<img src="' + e.target.result +
                        '" alt="Selected Image" style="width: 200px; height: auto;">');
                }
                reader.readAsDataURL(file);
            } else {
                $(this).next('.custom-file-label').html('Choose file');
                $('#imagePreview').html('');
            }
        });

    });
</script>
@endpush