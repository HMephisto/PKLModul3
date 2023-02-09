<!DOCTYPE html>
<html lang="en">

<head>
    <title>Brand List</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script src="{{ asset('js/app.js') }}"></script>
</head>

<body style="padding: 5%">
    @if (session()->has('success'))
        <div class="alert alert-primary alert-dismissible fade show" role="alert" id="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <div class="d-flex justify-content-center">
        <a href="/" class="btn btn-info" style="width: 80px">Product</a>
    </div>
    <div class="d-flex justify-content-between">
        <div class="p-2 bd-highlight">
            <h1>Brand List</h1>
        </div>
        <div class="p-2 bd-highlight">
            <a href="brands/add" class="btn btn-primary">Add Brand</a>
        </div>
    </div>
    <div class="table-responsive">

        <table class="table align-middle table-hover">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Name</th>
                    <th scope="col">image</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            @foreach ($brands as $key => $brand)
                <tr>
                    <th scope="row">{{ $key + 1 }}</th>
                    <td scope="row">{{ $brand->name }}</td>
                    <td scope="row"><img src={{ asset($brand->image) }} alt="" style="max-height: 150px;"> </td>
                    <td scope="row">
                        <form method="POST" action="brands/delete/{{ $brand->id }}">
                            @method('delete')
                            @csrf
                            <a class="btn btn-primary" href="brands/edit/{{ $brand->id }}"
                                style="width: 80px">Edit</a>
                            <button type="submit" style="width: 80px" class="btn btn-danger"
                                onclick="return confirm('Are you sure want to delete?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</body>

</html>
