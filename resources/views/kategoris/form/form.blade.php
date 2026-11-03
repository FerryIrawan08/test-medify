<form method="POST">
    @csrf
    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="form-group mb-3">
        <label>Kode Kategori</label>
        <input type="text" class="form-control" name="kode" value="{{ old('kode', $item->kode ?? '') }}" placeholder="{{ $method == 'new' ? 'Otomatis di-generate jika dikosongkan' : '' }}" @if($method == 'edit') readonly @endif>
        <small class="text-muted">Format contoh: KAT-0001 (opsional saat baru, akan di-generate otomatis)</small>
    </div>

    <div class="form-group mb-3">
        <label>Nama Kategori <span class="text-danger">*</span></label>
        <input type="text" class="form-control" name="nama" required value="{{ old('nama', $item->nama ?? '') }}" placeholder="Contoh: Obat Generik">
    </div>

    <button class="btn btn-primary mt-2">Submit</button>
</form>

