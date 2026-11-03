@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="form-group mb-2 d-flex justify-content-between align-items-center">
                <a href="{{url('kategoris')}}" class="btn btn-secondary">Kembali ke Daftar Kategori</a>
                <div>
                    <a href="{{url('kategoris/pdf/' . $data->kode)}}" class="btn btn-danger" target="_blank">
                        Download PDF
                    </a>
                    <a class="btn btn-info" href="{{url('kategoris/form/edit')}}/{{$data->id}}">Edit</a>
                    <a class="btn btn-danger" href="{{url('kategoris/delete')}}/{{$data->id}}" onclick="return confirm('Apakah Anda yakin ingin menghapus kategori ini?');">Delete</a>
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-header">Detail Kategori</div>
                <div class="card-body">
                    <table class="table table-borderless" style="max-width: 500px;">
                        <tr>
                            <th style="width: 160px;">Kode Kategori</th>
                            <td style="width: 20px;">:</td>
                            <td><span class="badge bg-secondary fs-6">{{$data->kode}}</span></td>
                        </tr>
                        <tr>
                            <th>Nama Kategori</th>
                            <td>:</td>
                            <td><strong>{{$data->nama}}</strong></td>
                        </tr>
                        <tr>
                            <th>Total Item Terkait</th>
                            <td>:</td>
                            <td>{{$data->items->count()}} Item</td>
                        </tr>
                    </table>
                </div>
            </div>

            <div class="card">
                <div class="card-header">Daftar Item dalam Kategori Ini</div>
                <div class="card-body">
                    @if($data->items->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-striped table-hover align-middle">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Foto</th>
                                        <th>Kode</th>
                                        <th>Nama Item</th>
                                        <th>Jenis</th>
                                        <th>Harga Beli</th>
                                        <th>Harga Jual</th>
                                        <th>Supplier</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($data->items as $index => $item)
                                        @php
                                            $harga_jual = $item->harga_beli + ($item->harga_beli * $item->laba / 100);
                                        @endphp
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>
                                                @if(!empty($item->foto))
                                                    <img src="{{ asset($item->foto) }}" alt="{{ $item->nama }}" style="width: 45px; height: 45px; object-fit: cover; border-radius: 4px;">
                                                @else
                                                    <span class="text-muted small">-</span>
                                                @endif
                                            </td>
                                            <td>{{ $item->kode }}</td>
                                            <td><strong>{{ $item->nama }}</strong></td>
                                            <td>{{ $item->jenis }}</td>
                                            <td>Rp {{ number_format($item->harga_beli, 0, ',', '.') }}</td>
                                            <td>Rp {{ number_format($harga_jual, 0, ',', '.') }}</td>
                                            <td>{{ $item->supplier }}</td>
                                            <td>
                                                <a href="{{ url('master-items/view/' . $item->kode) }}" class="btn btn-primary btn-sm">Lihat Item</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-4 text-muted">
                            <p class="mb-0">Belum ada item yang terhubung dengan kategori ini.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

