<!DOCTYPE html>
<html lang="en">

<head>
    <title>Add Brand</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script src="{{ asset('js/app.js') }}"></script>
</head>

<body style="padding: 5%">
    <div class="container overflow-hidden">
        <div class=" rounded p-2 position-relative">
            <h1 class="text-center">Add Brand</h1>
            <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-8 ps-0 ">
                    <form method="POST" action="/brands/add" enctype="multipart/form-data">
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
                        <div class="row mb-3 ">
                            <label for="image" class="col-sm-2 col-form-label ">Image</label>
                            <div class="col-sm-10">
                                <input type="file" class="form-control" id="image" name="image">
                                @if ($errors->has('image'))
                                    <div class="text-danger">
                                        {{ $errors->first('image') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="d-flex justify-content-center gap-2">
                            <a class="btn btn-danger btn-lg btn-block" href="/brands"
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
