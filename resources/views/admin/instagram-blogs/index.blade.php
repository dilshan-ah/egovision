@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="card shadow mb-4 col-12 p-0">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">{{ $pageTitle }}</h6>
                <h6 class="m-0"><a href="{{ route('insta.user.createPost') }}"
                        class="text-decoration-none btn btn-primary">Add Instagram Post</a>
                </h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Post</th>
                                <th>Posted by</th>
                                <th>Associated product</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($instaBlogs as $instaBlog)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$instaBlog->user->name}}</td>
                                <td>
                                    @if($instaBlog->post())
                                    {{ $instaBlog->post()['caption'] ?? 'No caption available' }}
                                    @else
                                    No post data available
                                    @endif
                                </td>

                                <td>{{$instaBlog->product->name}}</td>
                                <td class="d-flex">
                                    <form action="{{ route('insta.post.delete',$instaBlog->id) }}" method="post">
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