<!DOCTYPE html>
<html lang="en">

<head>
    <title>Halaman Tambah Product</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script src="{{ asset('js/app.js') }}"></script>
</head>

<body style="padding: 5%">
    <div class="container overflow-hidden">
        <div class=" rounded p-2 position-relative">
            <h1 class="text-center">Tambah Product</h1>
            <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-8 ps-0 ">
                    <form method="POST" action="/product/tambah" enctype="multipart/form-data">
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
                                <input type="number" class="form-control" id="price" name="price"
                                    required>
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
                                <input type="text" class="form-control" id="brand" name="brand"
                                    required >
                                @if ($errors->has('brand'))
                                    <div class="text-danger">
                                        {{ $errors->first('brand') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="d-flex justify-content-center gap-2">
                            <a class="btn btn-danger btn-lg btn-block" href="/"
                                style="max-width: 200px">back</a>
                            <button type="submit" value="Upload" class="btn btn-primary btn-lg btn-block"
                                style="max-width: 200px ">Submit</button>
                        </div>
                    </form>
                </div>
            </div>


        </div>
    </div>
</body>

</html>
