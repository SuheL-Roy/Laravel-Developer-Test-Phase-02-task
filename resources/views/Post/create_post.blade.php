@extends('master.master')
@section('title')
    {{ __('add') }}
@endsection
@section('content')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

    <div class="pc-container">
        <div class="pc-content">



            <div class="row">
                <!-- [ sample-page ] start -->
                <div class="col-sm-12">
                    <div id="basicwizard" class="form-wizard row justify-content-center">
                        <div class="col-12">

                            <div class="card">
                                <form id="createForm" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="card-body">
                                        <div class="tab-content">

                                            <!-- END: Define your progress bar here -->
                                            <!-- START: Define your tab pans here -->
                                            <div class="tab-pane show active" id="contactDetail">
                                                <div id="contactForm">
                                                    <div class="text-center">
                                                        <h3 class="mb-2">
                                                            Create
                                                            Post
                                                        </h3>

                                                    </div>
                                                    <div class="row mt-4">
                                                        <div class="col">
                                                            <div class="row">

                                                                <div class="modal-body">
                                                                    <div class="row">
                                                                        <div class="col-lg-6">
                                                                            <input type="text" required
                                                                                class="form-control title" name="title"
                                                                                id="name"
                                                                                placeholder="Enter your title">
                                                                            <input type="hidden" name="id"
                                                                                class="id">
                                                                            <span class="text-danger error-message"
                                                                                id="titleError"></span>
                                                                        </div>
                                                                        <div class="col-lg-6">
                                                                            <select
                                                                                class="form-select category_name @error('category_name') is-invalid @enderror"
                                                                                name="category" required>
                                                                                <option value="">
                                                                                    Select
                                                                                    category
                                                                                </option>

                                                                                @foreach ($category as $item)
                                                                                    <option
                                                                                        value="{{ $item->category_name }}">
                                                                                        {{ $item->category_name }}</option>
                                                                                @endforeach

                                                                            </select>
                                                                            <span class="text-danger error-message"
                                                                                id="categoryError"></span>
                                                                        </div>
                                                                        <div class="col-lg-12">

                                                                            <textarea class="form-control mt-2 content" name="content" placeholder="Enter your content" rows="4" required></textarea>

                                                                            <span class="text-danger error-message"
                                                                                id="contentError"></span>

                                                                        </div>
                                                                        <div class="col-lg-6">
                                                                            {{-- <input type="file" class="form-control mt-2"
                                                                                name="image" required> --}}
                                                                            <input type="file" accept="image/*"
                                                                                class="form-control mt-2"
                                                                                id="product_image_input"
                                                                                onchange="previewImage(event)" required
                                                                                name="image">

                                                                            <!-- Image Preview -->
                                                                            <img src="" id="product_image_preview"
                                                                                class="mt-2"
                                                                                style="width: 120px; height: 120px; display: none;">

                                                                            <span class="text-danger error-message"
                                                                                id="imageError"></span>

                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer mt-2 p-10  gap-2">
                                                                    <a href="{{ route('home') }}"
                                                                        class="btn btn-danger">Back</a>

                                                                    <button type="submit"
                                                                        class="btn btn-primary">Save</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>




                                        </div>
                                    </div>
                                </form>
                            </div>
                            <!-- end tab content-->
                        </div>
                    </div>
                </div>
                <!-- [ sample-page ] end -->
            </div>





        </div>
    </div>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <script>
        function previewImage(event) {
            const input = event.target;
            const preview = document.getElementById('product_image_preview');

            if (input.files && input.files[0]) {
                preview.src = URL.createObjectURL(input.files[0]);
                preview.style.display = 'block';
            }
        }
    </script>

    <script>
        $(document).ready(function() {
            $('#createForm').on('submit', function(e) {
                e.preventDefault(); // prevent form from submitting normally

                let formData = new FormData(this);

                // Clear previous error messages
                $('.error-message').text('');

                $.ajax({
                    url: "{{ route('admin.posts') }}", // Change this to your store route
                    method: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,
                    beforeSend: function() {
                        // Optional: disable submit button or show loading
                    },
                    success: function(response) {
                        // Success logic here
                        $('#createForm')[0].reset(); // clear the form
                        $('#product_image_input').val('');
                        $('#product_image_preview').attr('src', '').hide();
                        toastr.success('Post created successfully!');
                        // alert('Post created successfully!');
                        // Optionally reload the post list table
                    },
                    error: function(xhr) {
                        if (xhr.status === 422) {
                            let errors = xhr.responseJSON.errors;
                            $.each(errors, function(key, value) {
                                $('#' + key + 'Error').text(value[0]);
                            });
                        }
                    }
                });
            });
        });
    </script>
@endsection
