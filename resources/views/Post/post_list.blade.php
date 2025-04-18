@extends('master\master')
@section('title')
    {{ __('Post List') }}
@endsection
@section('content')
    <div class="pc-container">

        <div class="pc-content">
            <!-- [ breadcrumb ] start -->
            <div class="page-header">
                <div class="page-block">
                    <div class="row align-items-center">
                        <div class="col-md-12">
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="../dashboard/index.html">Home</a></li>
                                <li class="breadcrumb-item"><a href="javascript: void(0)">Dashboard</a></li>
                                <li class="breadcrumb-item" aria-current="page">Post List</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!-- [ breadcrumb ] end -->
            <!-- [ Main Content ] start -->
            <div class="row">
                <!-- [ sample-page ] start -->
                <div class="col-sm-12">
                    <div class="card table-card">
                        <div class="card-body">

                            <form action="{{ route('admin.search_title') }}" method="GET">
                                @csrf
                                <div class="col-sm-10 d-flex align-items-center">

                                    <div class="col-sm-5 p-sm-2">

                                    </div>
                                    <div class="col-sm-3 p-sm-2">
                                        <label for="project" class="form-label"></label>
                                        <select class="form-select project_id @error('project_id') is-invalid @enderror"
                                            name="title_name" required>
                                            <option value="">Select Post Title</option>
                                            @foreach ($title as $item)
                                                <option {{ $item == $title_name ? 'selected' : '' }}
                                                    value="{{ $item }}">
                                                    {{ $item }}</option>
                                            @endforeach

                                        </select>
                                    </div>



                                    <div class="col-sm-3 p-sm-2">
                                        <button type="submit" class="btn btn-primary mt-4">
                                            Filter
                                        </button>
                                    </div>

                                </div>
                            </form>
                            <div class="text-end p-sm-4 pb-sm-2">
                                <a href="{{ route('admin.create_post') }}" class="btn btn-primary">
                                    Create Post
                                </a>

                            </div>
                            <div id="exampleModalLive" class="modal fade" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLiveLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLiveLabel">Create Post</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>


                                        <form action="{{ route('admin.update') }}" method="POST"
                                            enctype="multipart/form-data">
                                            @csrf
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <input type="text" required class="form-control title"
                                                            name="title" id="name" placeholder="Enter your title">
                                                        <input type="hidden" name="id" class="id">
                                                        <span class="text-danger error-message" id="nameError"></span>
                                                    </div>
                                                    <div class="col-lg-12">
                                                        <select
                                                            class="form-select mt-2 category_name @error('category_name') is-invalid @enderror"
                                                            name="category" required>
                                                            <option value="">Select category</option>
                                                            @foreach ($category as $item)
                                                                <option value="{{ $item->category_name }}">
                                                                    {{ $item->category_name }}</option>
                                                            @endforeach


                                                        </select>
                                                    </div>
                                                    <div class="col-lg-12">
                                                        <textarea class="form-control mt-2 content" name="content" placeholder="Enter your content" rows="4" required></textarea>
                                                    </div>
                                                    <div class="col-lg-12">
                                                        <input type="file" class="form-control mt-2" name="image">

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-primary">Save</button>
                                            </div>
                                        </form>

                                    </div>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-hover tbl-product" id="pc-dt-simple">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Image</th>
                                            <th>Category</th>
                                            <th>Title</th>
                                            <th>Content</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($post as $item)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>
                                                    <img src="{{ asset('storage/' . $item->image) }}" alt="Post Image"
                                                        width="100">

                                                </td>
                                                <td>{{ $item->category }}</td>
                                                <td>{{ $item->title }}</td>
                                                <td>{{ $item->content }}</td>
                                                <td>
                                                    <a href="#" class="btn btn-primary edit-btn"
                                                        data-bs-toggle="modal" data-id="{{ $item->id }}"
                                                        data-bs-target="#exampleModalLive">
                                                        <i class="fas fa-edit"></i>
                                                    </a>

                                                    <a href="{{ route('admin.destroy', ['id' => $item->id]) }}"
                                                        class="btn btn-danger">
                                                        <i class="fas fa-trash"></i>
                                                    </a>

                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- [ sample-page ] end -->
            </div>
            <!-- [ Main Content ] end -->
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        @if (session('danger'))
            Swal.fire({
                toast: true,
                position: 'top-end',
                icon: 'error',
                title: '{{ session('danger') }}',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                customClass: {
                    popup: 'small-toast'
                }
            });
        @elseif (session('success'))
            Swal.fire({
                toast: true,
                position: 'top-end',
                icon: 'success',
                title: '{{ session('success') }}',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                customClass: {
                    popup: 'small-toast'
                }
            });
        @endif
    </script>

    <script>
        $(document).on('click', '.edit-btn', function(e) {
            e.preventDefault();

            const postId = $(this).data('id');

            $.ajax({
                url: "{{ route('admin.get_post') }}",
                type: 'GET',
                data: {
                    id: postId
                },
                success: function(response) {
                    $('.id').val(response[0]['id']);
                    $('.title').val(response[0]['title']);
                    $('.category_name').val(response[0]['category']);
                    $('.content').val(response[0]['content']);

                },
                error: function(xhr) {

                    alert('Error fetching post data');
                }
            });
        });
    </script>
@endsection
