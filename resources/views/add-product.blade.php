<!DOCTYPE html>
<html lang="en">

<head>
    <title>Add Product</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script src="{{ asset('js/app.js') }}"></script>
</head>

<body style="padding: 5%">
    <div class="container overflow-hidden">
        <div class=" rounded p-2 position-relative">
            <h1 class="text-center">Add Product</h1>
            <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-8 ps-0 ">
                    <form method="POST" action="/products/add" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="row mb-3 ">
                            <label for="name" class="col-sm-2 col-form-label ">Name</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="name" name="name" required>
                                @if ($errors->has('name'))
                                    <div class="text-danger">
                                        {{ $errors->first('name') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="price" class="col-sm-2 col-form-label">Price</label>
                            <div class="col-sm-10">
                                <input type="number" class="form-control" id="price" name="price" required>
                                @if ($errors->has('price'))
                                    <div class="text-danger">
                                        {{ $errors->first('price') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="row mb-3 ">
                            <label for="brand" class="col-sm-2 col-form-label">Brand
                            </label>
                            <div class="col-sm-10">
                                {{-- <input type="text" class="form-control" id="brand" name="brand" required>
                                @if ($errors->has('brand'))
                                    <div class="text-danger">
                                        {{ $errors->first('brand') }}
                                    </div>
                                @endif --}}
                                <select name="brand_id" class="form-select" aria-label="Default select example">
                                    @foreach ($brands as $brand)
                                        <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                                    @endforeach
                                    <option value="" selected>Null</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3 ">
                            <label for="image" class="col-sm-2 col-form-label ">Image</label>
                            <div class="col-sm-10">
                                <input type="file" class="form-control" id="image" name="image">
                                @if ($errors->has('image'))
                                    <div class="text-danger">
                                        {{ $errors->first('image') }}
                                    </div>
                                @endif
                                <br>
                                <img id="preview-image-before-upload" style="max-height: 150px; ">
                            </div>
                        </div>
                        <div class="d-flex justify-content-center gap-2">
                            <a class="btn btn-danger btn-lg btn-block" href="/" style="max-width: 200px">back</a>
                            <button type="submit" value="Upload" class="btn btn-primary btn-lg btn-block"
                                style="max-width: 200px ">Submit</button>
                        </div>
                    </form>
                </div>
            </div>


        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function(e) {
            $('#image').change(function() {
                let reader = new FileReader();
                reader.onload = (e) => {
                    $('#preview-image-before-upload').attr('src', e.target.result);
                }
                reader.readAsDataURL(this.files[0]);
            });
        });
    </script>
</body>

</html>
