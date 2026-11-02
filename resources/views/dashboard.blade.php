@extends('layouts.app')
@php
    $totalBuku = 0; $totalUser = 0; $bukuBaru = collect();
    try { $totalBuku = \App\Models\Book::count(); $bukuBaru = \App\Models\Book::latest()->take(5)->get(); } catch (\Throwable $e) {}
    try { $totalUser = \App\Models\User::count(); } catch (\Throwable $e) {}
    $go = fn ($n) => \Illuminate\Support\Facades\Route::has($n) ? route($n) : '#';
    $peran = Auth::user()->getRoleNames()->first();
@endphp
@section('content')
    <section class="hello">
        <img src="{{ asset('images/dino-books.svg') }}" alt="">
        <div>
            <h2>Halo, {{ Auth::user()->name }}!</h2>
            @role('Admin')
                <p>Anda mengelola seluruh data: buku, pengguna, dan peran mereka.</p>
                <a class="btn" href="{{ $go('users.index') }}">Kelola pengguna</a>
            @endrole
            @role('Dosen')
                <p>Anda bisa menambah dan memperbarui koleksi buku.</p>
                <a class="btn" href="{{ $go('books.create') }}">+ Tambah buku</a>
            @endrole
            @role('Mahasiswa')
                <p>Jelajahi koleksi buku yang tersedia di Books Store.</p>
                <a class="btn" href="{{ $go('books.index') }}">Lihat buku</a>
            @endrole
        </div>
    </section>

    <section class="stats">
        <div class="stat s1">
            <div class="ico"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 5a2 2 0 012-2h13v16H6a2 2 0 00-2 2z"/><path d="M4 21V5"/></svg></div>
            <div><b>{{ $totalBuku }}</b><span>Total buku</span></div>
        </div>
        @role('Admin')
        <div class="stat s2">
            <div class="ico"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="9" cy="8" r="4"/><path d="M2 21a7 7 0 0114 0"/></svg></div>
            <div><b>{{ $totalUser }}</b><span>Total pengguna</span></div>
        </div>
        @endrole
        <div class="stat s3">
            <div class="ico"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2l3 7 7 .6-5.3 4.7 1.6 7.2L12 17.8 5.7 21.5l1.6-7.2L2 9.6 9 9z"/></svg></div>
            <div><b>{{ $bukuBaru->count() }}</b><span>Buku terbaru</span></div>
        </div>
    </section>

    <section class="two">
        <div class="card">
            <h3>Buku yang baru ditambahkan</h3>
            @if ($bukuBaru->isEmpty())
                <div class="empty">
                    <img src="{{ asset('images/dino-books.svg') }}" alt="">
                    <b>Rak masih kosong</b>
                    @hasanyrole('Admin|Dosen')
                        Tambahkan buku pertama.
                    @else
                        Belum ada buku yang tersedia.
                    @endhasanyrole
                </div>
            @else
                <ul class="list">
                    @foreach ($bukuBaru as $b)
                        @php $jdl = $b->judul ?? $b->title ?? 'Tanpa judul'; @endphp
                        <li>
                            <div class="avatar c{{ $loop->index % 5 }}" style="border-radius:10px">{{ strtoupper(mb_substr($jdl, 0, 1)) }}</div>
                            <div>
                                <div class="t">{{ $jdl }}</div>
                                <small>{{ $b->penulis ?? $b->author ?? '-' }}</small>
                            </div>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>

        <div class="card">
            <h3>Pintasan</h3>
            <div class="shortcut">
                <a href="{{ $go('books.index') }}"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 5a2 2 0 012-2h13v16H6a2 2 0 00-2 2z"/></svg>Lihat buku</a>
                @hasanyrole('Admin|Dosen')
                    <a href="{{ $go('books.create') }}"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 5v14M5 12h14"/></svg>Tambah buku</a>
                @endhasanyrole
                @role('Admin')
                    <a href="{{ $go('users.index') }}"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="9" cy="8" r="4"/><path d="M2 21a7 7 0 0114 0"/></svg>Kelola pengguna</a>
                @endrole
                <a href="{{ $go('profile.edit') }}"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="8" r="4"/><path d="M4 21a8 8 0 0116 0"/></svg>Ubah profil</a>
            </div>
        </div>
    </section>
@endsection