<style>
.form-card{max-width:680px;background:var(--pink-50);border:2px solid var(--line);border-radius:var(--radius);padding:26px}
.field{margin-bottom:18px}
.field label{display:block;font-weight:800;margin-bottom:6px}
.field input,.field textarea{width:100%;padding:11px 14px;border:2px solid var(--line);border-radius:12px;background:#fff;font:inherit;color:var(--plum)}
.field input:focus,.field textarea:focus{outline:none;border-color:var(--green);box-shadow:0 0 0 3px var(--green-soft)}
.field textarea{min-height:130px;resize:vertical}
.field .err{color:#B3364E;font-size:13px;font-weight:700;margin-top:4px}
.grid2{display:grid;grid-template-columns:1fr 1fr;gap:16px}
.form-actions{display:flex;gap:10px;margin-top:8px}
@media (max-width:600px){.grid2{grid-template-columns:1fr}}
</style>

@php $b = $book ?? null; @endphp
<div class="form-card">
    <form method="POST" action="{{ $action }}">
        @csrf
        @if ($b) @method('PUT') @endif

        <div class="field">
            <label for="judul">Judul</label>
            <input id="judul" name="judul" type="text" value="{{ old('judul', $b->judul ?? '') }}" required placeholder="Judul buku">
            @error('judul')<div class="err">{{ $message }}</div>@enderror
        </div>

        <div class="grid2">
            <div class="field">
                <label for="penulis">Penulis</label>
                <input id="penulis" name="penulis" type="text" value="{{ old('penulis', $b->penulis ?? '') }}" required placeholder="Nama penulis">
                @error('penulis')<div class="err">{{ $message }}</div>@enderror
            </div>
            <div class="field">
                <label for="penerbit">Penerbit</label>
                <input id="penerbit" name="penerbit" type="text" value="{{ old('penerbit', $b->penerbit ?? '') }}" placeholder="Nama penerbit">
                @error('penerbit')<div class="err">{{ $message }}</div>@enderror
            </div>
        </div>

        <div class="field" style="max-width:240px">
            <label for="tahun_terbit">Tahun terbit</label>
            <input id="tahun_terbit" name="tahun_terbit" type="number" value="{{ old('tahun_terbit', $b->tahun_terbit ?? '') }}" placeholder="2024">
            @error('tahun_terbit')<div class="err">{{ $message }}</div>@enderror
        </div>

        <div class="field">
            <label for="deskripsi">Deskripsi</label>
            <textarea id="deskripsi" name="deskripsi" placeholder="Ringkasan singkat isi buku">{{ old('deskripsi', $b->deskripsi ?? '') }}</textarea>
            @error('deskripsi')<div class="err">{{ $message }}</div>@enderror
        </div>

        <div class="form-actions">
            <button type="submit" class="btn btn-green">Simpan</button>
            <a href="{{ route('books.index') }}" class="btn btn-ghost">Batal</a>
        </div>
    </form>
</div>