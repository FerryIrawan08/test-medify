<form method="POST" enctype="multipart/form-data">
    @csrf
    @if($method == 'edit')
    <div class="form-group mb-2">
        <label>Kode Barang</label>
        <input type="text" class="form-control" name="kode_barang" required readonly value="{{$item->kode ?? ''}}">
    </div>
    @endif

    <div class="form-group mb-2">
        <label>Nama</label>
        <input type="text" class="form-control" name="nama" required  value="{{$item->nama ?? ''}}">
    </div>

    <div class="form-group mb-2">
        <label>Harga Beli</label>
        <input type="number" class="form-control" name="harga_beli" required  value="{{$item->harga_beli ?? ''}}">
    </div>

    <div class="form-group mb-2">
        <label>Laba (dalam persen)</label>
        <input type="number" class="form-control" name="laba" required  value="{{$item->laba ?? ''}}">
    </div>

    @php $selected = $item->supplier ?? ''; @endphp
    <div class="form-group mb-2">
        <label>Supplier</label>
        <select class="form-control" required name="supplier">
            <option @if($selected == '') selected @endif value="">--Pilih--</option>
            <option @if($selected == 'Tokopaedi') selected @endif>Tokopaedi</option>
            <option @if($selected == 'Bukulapuk') selected @endif>Bukulapuk</option>
            <option @if($selected == 'TokoBagas') selected @endif>TokoBagas</option>
            <option @if($selected == 'E Commurz') selected @endif>E Commurz</option>
            <option @if($selected == 'Blublu') selected @endif>Blublu</option>
        </select>
    </div>

    @php $selected = $item->jenis ?? ''; @endphp
    <div class="form-group mb-2">
        <label>Jenis</label>
        <select class="form-control" required name="jenis">
            <option @if($selected == '') selected @endif value="">--Pilih--</option>
            <option @if($selected == 'Obat') selected @endif>Obat</option>
            <option @if($selected == 'Alkes') selected @endif>Alkes</option>
            <option @if($selected == 'Matkes') selected @endif>Matkes</option>
            <option @if($selected == 'Umum') selected @endif>Umum</option>
            <option @if($selected == 'ATK') selected @endif>ATK</option>
        </select>
    </div>

    <div class="form-group mb-3">
        <label>Kategori</label>
        @if(isset($kategoris) && count($kategoris) > 0)
            <div class="p-2 border rounded bg-light" style="max-height: 180px; overflow-y: auto;">
                @foreach($kategoris as $kategori)
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="kategori_ids[]" value="{{ $kategori->id }}" id="kategori_{{ $kategori->id }}"
                            @if(in_array($kategori->id, old('kategori_ids', $selected_kategori_ids ?? []))) checked @endif>
                        <label class="form-check-label" for="kategori_{{ $kategori->id }}">
                            <span class="badge bg-secondary me-1">{{ $kategori->kode }}</span> {{ $kategori->nama }}
                        </label>
                    </div>
                @endforeach
            </div>
            <small class="text-muted">Pilih satu atau lebih kategori yang sesuai.</small>
        @else
            <div class="p-2 border rounded bg-light text-muted small">
                Belum ada kategori yang dibuat. <a href="{{ url('kategoris/form/new') }}" target="_blank">Tambah kategori baru</a>
            </div>
        @endif
    </div>

    <div class="form-group mb-3">
        <label>Foto</label>
        <input type="file" class="form-control" name="foto" accept="image/*">
        @if(!empty($item->foto))
        <div class="mt-2">
            <img src="{{ asset($item->foto) }}" alt="{{ $item->nama }}" style="max-height: 120px; border-radius: 6px; border: 1px solid #ddd; padding: 3px;">
            <p class="text-muted small mt-1 mb-0">Foto saat ini</p>
        </div>
        @endif
    </div>

    <button class="btn btn-primary mt-3">Submit</button>

</form>