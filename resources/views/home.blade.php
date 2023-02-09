<!DOCTYPE html>
<html lang="en">

<head>
    <title>Product List</title>
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
    <form action="/logout" method="POST" class="d-flex justify-content-center">
        @csrf
        <a href="/brands" class="btn btn-info" style="width: 80px">Brand</a>
        <div style="width:20px"></div>
        <button class="btn btn-danger " type="submit" style="width: 80px ">Logout</button>
    </form>

    <div class="d-flex justify-content-between">
        <div class="p-2 bd-highlight">
            <h1>Product List</h1>
        </div>
        <div class="p-2 bd-highlight">
            <a href="products/add" class="btn btn-primary">Add Product</a>
        </div>
    </div>
    <div class="table-responsive">

        <table class="table align-middle table-hover">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Name</th>
                    <th scope="col">Price</th>
                    <th scope="col">Brand</th>
                    <th scope="col">Image</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            @foreach ($products as $key => $product)
                <tr>
                    <th scope="row">{{ $key + 1 }}</th>
                    <td scope="row">{{ $product->name }}</td>
                    <td scope="row">Rp. {{ number_format($product->price, 0, ',', '.') }}</td>
                    <td scope="row">
                        {{ empty($product->brand->name) ? 'Null' : $product->brand->name }}
                    </td>
                    <td scope="row"><img src={{ asset($product->image) }} style="max-height: 150px;"></td>
                    <td scope="row">
                        <form method="POST" action="products/delete/{{ $product->id }}">
                            @method('delete')
                            @csrf
                            <a class="btn btn-primary" href="products/edit/{{ $product->id }}"
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
