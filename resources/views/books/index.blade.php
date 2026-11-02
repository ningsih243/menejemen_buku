@extends('layouts.app')
@php $go = fn ($n, $p = null) => \Illuminate\Support\Facades\Route::has($n) ? route($n, $p) : '#'; @endphp
    @section('header')
        <div class="page-head">
            <div>
                <h1>Buku</h1>
                <p>Semua koleksi di Books Store.</p>
            </div>
            <div style="display:flex;gap:10px;flex-wrap:wrap">
                <label class="search">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="7"/><path d="M21 21l-4-4"/></svg>
                    <input type="search" id="cari" placeholder="Cari judul atau penulis">
                </label>
                @hasanyrole('Admin|Dosen')
                    <a class="btn btn-green" href="{{ $go('books.create') }}">+ Tambah buku</a>
                @endhasanyrole
            </div>
        </div>
@endsection

@section('content')

    @if ($books->isEmpty())
        <div class="card empty">
            <img src="{{ asset('images/dino-books.svg') }}" alt="">
            <b>Belum ada buku</b>
            @hasanyrole('Admin|Dosen')Klik “Tambah buku” untuk mengisi rak pertama.@else Belum ada buku yang tersedia.@endhasanyrole
        </div>
    @else
        <div class="books" id="daftar">
            @foreach ($books as $book)
                @php
                    $judul = $book->judul ?? $book->title ?? 'Tanpa judul';
                    $penulis = $book->penulis ?? $book->author ?? '-';
                @endphp
                <article class="book" data-q="{{ strtolower($judul . ' ' . $penulis) }}">
                    <div class="cover c{{ $loop->index % 5 }}">{{ strtoupper(mb_substr($judul, 0, 1)) }}</div>
                    <h3>{{ $judul }}</h3>
                    <div class="meta">{{ $penulis }}</div>
                    <div class="row">
                        @isset($book->tahun)<span class="badge alt">{{ $book->tahun }}</span>@endisset
                        @isset($book->stok)<span class="badge {{ $book->stok > 0 ? '' : 'warn' }}">Stok {{ $book->stok }}</span>@endisset
                        @isset($book->harga)<span class="badge warn">Rp {{ number_format($book->harga, 0, ',', '.') }}</span>@endisset
                    </div>
                    <div class="actions">
                        @hasanyrole('Admin|Dosen')
                            <a class="btn btn-ghost btn-sm" href="{{ $go('books.edit', $book) }}">Edit</a>
                        @endhasanyrole
                        @role('Admin')
                            <form method="POST" action="{{ $go('books.destroy', $book) }}" onsubmit="return confirm('Hapus buku ini?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-danger btn-sm" type="submit">Hapus</button>
                        </form>
                        @endrole
                    </div>
                </article>
            @endforeach
        </div>

        @if (method_exists($books, 'links'))
            <div style="margin-top:22px">{{ $books->links() }}</div>
        @endif
    @endif

    <script>
        document.getElementById('cari')?.addEventListener('input', function () {
            const q = this.value.toLowerCase();
            document.querySelectorAll('#daftar .book').forEach(el => {
                el.style.display = el.dataset.q.includes(q) ? '' : 'none';
            });
        });
    </script>
@endsection