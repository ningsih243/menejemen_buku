@extends('layouts.app')
@php $go = fn ($n, $p = null) => \Illuminate\Support\Facades\Route::has($n) ? route($n, $p) : '#'; @endphp
    @section('header')
        <div class="page-head">
            <div>
                <h1>Pengguna</h1>
                <p>Atur siapa yang bisa masuk dan perannya.</p>
            </div>
            <div style="display:flex;gap:10px;flex-wrap:wrap">
                <label class="search">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="7"/><path d="M21 21l-4-4"/></svg>
                    <input type="search" id="cari" placeholder="Cari nama atau email">
                </label>
                <a class="btn btn-green" href="{{ $go('users.create') }}">+ Tambah pengguna</a>
            </div>
        </div>
@endsection

@section('content')

    @if ($users->isEmpty())
        <div class="card empty">
            <img src="{{ asset('images/dino-books.svg') }}" alt="">
            <b>Belum ada pengguna</b>
            Tambahkan pengguna pertama.
        </div>
    @else
        <div class="users" id="daftar">
            @foreach ($users as $user)
                <div class="user" data-q="{{ strtolower($user->name . ' ' . $user->email) }}">
                    <div class="avatar c{{ $loop->index % 5 }}">{{ strtoupper(mb_substr($user->name, 0, 1)) }}</div>
                    <div>
                        <div class="n">{{ $user->name }}</div>
                        <small>{{ $user->email }}</small>
                    </div>
                    <div class="badges">
                        {{-- Spatie: getRoleNames() --}}
                        @if (method_exists($user, 'getRoleNames'))
                            @forelse ($user->getRoleNames() as $role)
                                <span class="badge alt">{{ $role }}</span>
                            @empty
                                <span class="badge warn">Tanpa peran</span>
                            @endforelse
                        @endif
                    </div>
                    <div class="actions">
                        <a class="btn btn-ghost btn-sm" href="{{ $go('users.edit', $user) }}">Edit</a>
                        @if (auth()->id() !== $user->id)
                            <form method="POST" action="{{ $go('users.destroy', $user) }}" onsubmit="return confirm('Hapus pengguna ini?')">
                                @csrf @method('DELETE')
                                <button class="btn btn-danger btn-sm" type="submit">Hapus</button>
                            </form>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>

        @if (method_exists($users, 'links'))
            <div style="margin-top:22px">{{ $users->links() }}</div>
        @endif
    @endif

    <script>
        document.getElementById('cari')?.addEventListener('input', function () {
            const q = this.value.toLowerCase();
            document.querySelectorAll('#daftar .user').forEach(el => {
                el.style.display = el.dataset.q.includes(q) ? '' : 'none';
            });
        });
    </script>
@endsection