@extends('layouts.dashboard')

@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h2>{{ $title }}</h2>
    </div>
    @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show mt-4" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <div class="m-5">
        <div class="row my-3 d-flex justify-content-between">
            <div class="col-lg-2">
                <a class="btn btn-dark" href="/dashboard/kost/create"><i class="bi bi-plus-circle"></i> Tambah Data</a>
            </div>
        </div>
        <div class="table-responsive text-center">
            <table class="table table-striped table-sm">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Pemilik</th>
                        <th scope="col">Alamat</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($kost as $k)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $k->nama }}</td>
                            <td>{{ $k->user->name }}</td>
                            <td>{{ $k->alamat }}</td>
                            <td>
                                <a href="/dashboard/kost/{{ $k->slug }}" class="btn btn-success"><i
                                        class="bi bi-eye"></i></a>
                                <a href="/dashboard/kost/{{ $k->slug }}/edit" class="btn btn-warning"><i
                                        class="bi bi-pencil"></i></a>
                                @if ($kamar->where('kost_id', $k->id)->count())
                                    <button type="submit" class="btn btn-danger"
                                        onclick="return alert('Tidak bisa dihapus karena terdapat data kamar')">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                @else
                                    <form action="/dashboard/kost/{{ $k->slug }}" method="post" class="d-inline">
                                        @method('delete')
                                        @csrf
                                        <button type="submit" class="btn btn-danger"
                                            onclick="return confirm('Hapus Data?')"><i class="bi bi-trash"></i></button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="d-flex justify-content-end">
            {{ $kost->links() }}
        </div>
    </div>
@endsection