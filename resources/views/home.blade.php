<!DOCTYPE html>
<html lang="en">

<head>
    <title>Halaman Beranda</title>
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
    <form action="/logout" method="POST">
        @csrf
        <button class="btn btn-danger " type="submit">Logout</button>
    </form>
    <div class="d-flex justify-content-between">
        <div class="p-2 bd-highlight">
            <h1>Daftar Product</h1>
        </div>
        <div class="p-2 bd-highlight">
            <a href="product/tambah" class="btn btn-primary">Tambah Product</a>
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
                    <th scope="col">Action</th>
                </tr>
            </thead>
            @foreach ($products as $key => $product)
                <tr>
                    <th scope="row">{{ $key + 1 }}</th>
                    <td scope="row">{{ $product->name }}</td>
                    <td scope="row">Rp. {{ number_format($product->price, 0, ',', '.') }}</td>
                    <td scope="row">{{ $product->brand }}</td>
                    <td scope="row">
                        <form method="POST" action="product/delete/{{ $product->id }}">
                            @method('delete')
                            @csrf
                            <a class="btn btn-primary" href="product/edit/{{ $product->id }}"
                                style="width: 80px">Edit</a>
                            <button type="submit" style="width: 80px" class="btn btn-danger"
                                onclick="return confirm('Yakin mau dihapus?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</body>

</html>
