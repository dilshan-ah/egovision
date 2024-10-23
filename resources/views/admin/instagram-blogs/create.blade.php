@extends('admin.layouts.app')
@push('style')
<link rel="stylesheet" href="{{ asset('ego-assets/css/jodit.fat.min.css') }}">
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush
@section('content')
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">{{ $pageTitle }}</h6>
            <h6 class="m-0"><a href="{{ route('insta.user.managePost') }}" class="text-decoration-none btn btn-primary">Instagram Post
                    List</a>
            </h6>
        </div>
        <div class="card-body">
            <form action="{{ route('insta.post.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="form-group col-6">
                        <label>Posted By</label>
                        <select name="posted_by" id="postedBy" class="form-control" onchange="fetchPosts()">
                            <option value="">Select a user</option>
                            @foreach($instaUsers as $instaUser)
                            <option value="{{ $instaUser->id }}">{{ $instaUser->name }}</option>
                            @endforeach
                        </select>
                        @error('posted_by')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group col-6">
                        <label>Select Post</label>
                        <select name="post" id="postSelect" class="form-control js-example-basic-single">
                            <option value="">Select a post</option>
                            @if(isset($instaData['data']))
                            @foreach($instaData['data'] as $data)
                            <option value="{{ $data['id'] }}" data-image="{{ $data['media_url'] }}">
                                {!! nl2br(e($data['caption'] ?? 'No caption available.')) !!}
                            </option>
                            @endforeach
                            @endif
                        </select>
                        @error('post')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    @if(isset($instaData))
                    <div class="form-group col-6">
                        <label>Associated Product</label>
                        <select name="product" class="form-control js-example-basic-single">
                            <option value="">Select a product</option>
                            @foreach($allProducts as $product)
                            <option value="{{ $product->id }}" >{{ $product->name }}</option>
                            @endforeach
                        </select>
                        @error('product')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    @endif

                    <div class="form-group col-12">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </form>


        </div>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $('.js-example-basic-single').select2();
    });
</script>


<script>
    function fetchPosts() {
        var userId = document.getElementById('postedBy').value;

        if (userId) {
            fetch(`/insta/user/posts/${userId}`)
                .then(response => response.json())
                .then(data => {
                    var postSelect = document.getElementById('postSelect');
                    // postSelect.innerHTML = '<option value="">Select a post</option>'; // Reset options

                    data.forEach(post => {
                        postSelect.insertAdjacentHTML('beforeend', `
                            <option value="${post.id}" data-image="${post.media_url}">
                                ${post.caption || 'No caption available.'}
                            </option>
                        `);
                    });

                    // Reinitialize Select2 after options are dynamically added
                    $('#postSelect').select2({
                        templateResult: formatOption,
                        templateSelection: formatSelection,
                        minimumResultsForSearch: 1
                    });

                })
                .catch(error => console.error('Error fetching posts:', error));
        } else {
            document.getElementById('postSelect').innerHTML = '<option value="">Select a post</option>';
        }
    }

    $(document).ready(function() {
        function formatOption(option) {
            if (!option.id) {
                return option.text;
            }

            var imageUrl = $(option.element).data('image');
            var optionHtml = `<span><img src="${imageUrl}" style="width: 100px; height: auto; margin-right: 10px;">${option.text}</span>`;
            return $(optionHtml);
        }

        function formatSelection(option) {
            if (!option.id) {
                return option.text;
            }

            var imageUrl = $(option.element).data('image');
            return $(`<span><img src="${imageUrl}" style="width: 20px; height: 20px; margin-right: 10px;">${option.text}</span>`);
        }

        // Initialize Select2 for the first time
        $('#postSelect').select2({
            templateResult: formatOption,
            templateSelection: formatSelection,
            minimumResultsForSearch: 1
        });
    });
</script>


@endsection