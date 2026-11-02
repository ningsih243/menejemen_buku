<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Books Store') }}</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800&display=swap" rel="stylesheet">
    <style>
:root{
  --pink-50:#FFF6F9; --pink-100:#F9D5E5; --pink-200:#F3BDD3; --pink-300:#E9A3C0;
  --green:#4C9A2A; --green-dark:#3F8422; --green-soft:#DDEFD3;
  --plum:#4A2B38; --plum-soft:#8A6475; --line:#F0C9D7;
  --yellow:#FFE9A8; --blue:#D4E8FA; --lilac:#E6DAF7;
  --radius:18px; --sidebar:250px;
}
*{box-sizing:border-box}
html,body{margin:0}
body{font-family:'Figtree',system-ui,sans-serif;background:var(--pink-100);color:var(--plum);font-size:15px;line-height:1.55}
a{color:inherit;text-decoration:none}
h1,h2,h3{margin:0;font-weight:800;letter-spacing:-.01em}
:focus-visible{outline:3px solid var(--green);outline-offset:2px}

/* ===== Shell ===== */
.shell{display:flex;min-height:100vh}
.sidebar{width:var(--sidebar);flex-shrink:0;background:var(--pink-200);border-right:2px solid var(--line);
  display:flex;flex-direction:column;position:sticky;top:0;height:100vh;overflow-y:auto}
.brand{display:flex;align-items:center;gap:10px;padding:16px 18px;border-bottom:2px solid var(--pink-300)}
.brand img{width:50px;height:auto;display:block;flex-shrink:0}
.brand strong{font-size:19px;font-weight:900;line-height:1.1}
.me{display:flex;align-items:center;gap:10px;padding:14px 18px;border-bottom:2px solid var(--pink-300)}
.me b{display:block;font-size:14px;line-height:1.2}
.me small{color:var(--plum-soft);font-size:12px;display:flex;align-items:center;gap:6px}
.me small::before{content:"";width:8px;height:8px;border-radius:50%;background:var(--green)}
.avatar{width:38px;height:38px;border-radius:50%;background:var(--yellow);display:grid;place-items:center;font-weight:900;flex-shrink:0}
.nav-label{padding:16px 18px 6px;font-size:12.5px;font-weight:800;color:var(--plum-soft)}
.nav{display:flex;flex-direction:column;gap:4px;padding:0 10px}
.nav a,.nav button{display:flex;align-items:center;gap:12px;width:100%;padding:10px 12px;border-radius:12px;border:0;background:transparent;font:inherit;font-weight:700;color:var(--plum);cursor:pointer;text-align:left;transition:background .15s}
.nav svg{width:19px;height:19px;flex-shrink:0}
.nav a:hover,.nav button:hover{background:var(--pink-100)}
.nav a.active{background:var(--green);color:#fff;box-shadow:0 3px 0 var(--green-dark)}
.nav .out:hover{background:#fff;color:#B3364E}
.side-foot{margin-top:auto;padding:14px 18px;border-top:2px solid var(--pink-300);font-size:12.5px;color:var(--plum-soft)}

.main{flex:1;min-width:0;padding:28px 34px 48px}
.topbar{display:none}
.page-head{display:flex;align-items:flex-end;justify-content:space-between;gap:16px;flex-wrap:wrap;margin-bottom:22px}
.page-head h1{font-size:28px}
.page-head p{margin:2px 0 0;color:var(--plum-soft)}

/* ===== Components ===== */
.card{background:var(--pink-50);border:2px solid var(--line);border-radius:var(--radius);padding:20px}
.btn{display:inline-flex;align-items:center;gap:8px;padding:10px 18px;border-radius:14px;border:0;font:inherit;font-weight:800;cursor:pointer}
.btn-green{background:var(--green);color:#fff;box-shadow:0 4px 0 var(--green-dark)}
.btn-green:hover{background:var(--green-dark)}
.btn-ghost{background:var(--pink-100);color:var(--plum);border:2px solid var(--line)}
.btn-sm{padding:6px 12px;font-size:13px;border-radius:10px}
.btn-danger{background:#fff;color:#B3364E;border:2px solid #F2B8C4}
.search{display:flex;align-items:center;gap:8px;background:var(--pink-50);border:2px solid var(--line);border-radius:14px;padding:8px 14px;min-width:240px}
.search input{border:0;background:transparent;font:inherit;color:inherit;width:100%;outline:none}
.badge{display:inline-block;padding:3px 10px;border-radius:99px;font-size:12px;font-weight:800;background:var(--green-soft);color:var(--green-dark)}
.badge.alt{background:var(--lilac);color:#5B3F8F}
.badge.warn{background:var(--yellow);color:#7A5A00}
.toast{background:var(--green-soft);border:2px solid #BFE0C4;color:var(--green-dark);padding:12px 16px;border-radius:14px;margin-bottom:18px;font-weight:700}
.empty{text-align:center;padding:42px 16px;color:var(--plum-soft)}
.empty img{width:120px;opacity:.9}
.empty b{display:block;color:var(--plum);font-size:17px;margin-top:6px}

/* ===== Dashboard ===== */
.hello{display:flex;align-items:center;gap:22px;background:var(--green);color:#fff;border-radius:24px;padding:24px 28px;margin-bottom:22px;position:relative;overflow:hidden}
.hello img{width:130px;flex-shrink:0;margin:-6px 0 -14px;filter:drop-shadow(0 6px 0 rgba(0,0,0,.12))}
.hello h2{font-size:26px}
.hello p{margin:4px 0 14px;opacity:.92;max-width:46ch}
.hello .btn{background:#fff;color:var(--green-dark)}
.hello::after{content:"★";position:absolute;right:28px;top:14px;font-size:26px;color:var(--yellow)}
.hello::before{content:"✦";position:absolute;right:84px;bottom:16px;font-size:20px;color:#fff;opacity:.6}
.stats{display:grid;grid-template-columns:repeat(auto-fit,minmax(190px,1fr));gap:16px;margin-bottom:22px}
.stat{border-radius:var(--radius);padding:18px 20px;display:flex;align-items:center;gap:14px;border:2px solid rgba(74,43,56,.08)}
.stat .ico{width:46px;height:46px;border-radius:14px;background:rgba(255,255,255,.7);display:grid;place-items:center}
.stat .ico svg{width:24px;height:24px}
.stat b{display:block;font-size:30px;line-height:1;font-weight:900}
.stat span{font-size:13.5px;color:var(--plum-soft);font-weight:700}
.s1{background:var(--yellow)} .s2{background:var(--blue)} .s3{background:var(--lilac)}
.two{display:grid;grid-template-columns:minmax(0,1.6fr) minmax(0,1fr);gap:18px}
.list{list-style:none;margin:12px 0 0;padding:0}
.list li{display:flex;align-items:center;gap:12px;padding:10px 0;border-bottom:2px dashed var(--line)}
.list li:last-child{border:0}
.list .t{font-weight:800;line-height:1.2}
.list small{color:var(--plum-soft)}
.shortcut{display:flex;flex-direction:column;gap:10px;margin-top:12px}
.shortcut a{display:flex;align-items:center;gap:12px;padding:12px 14px;background:var(--pink-100);border-radius:14px;font-weight:800;border:2px solid var(--line)}
.shortcut a:hover{border-color:var(--green)}
.shortcut svg{width:20px;height:20px;color:var(--green-dark)}

/* ===== Buku ===== */
.books{display:grid;grid-template-columns:repeat(auto-fill,minmax(210px,1fr));gap:18px}
.book{background:var(--pink-50);border:2px solid var(--line);border-radius:var(--radius);padding:14px;display:flex;flex-direction:column;gap:12px}
.cover{height:150px;border-radius:12px 18px 18px 12px;display:grid;place-items:center;font-size:54px;font-weight:900;color:rgba(74,43,56,.75);position:relative;border-left:14px solid rgba(74,43,56,.18)}
.c0{background:var(--yellow)} .c1{background:var(--blue)} .c2{background:var(--lilac)} .c3{background:var(--green-soft)} .c4{background:var(--pink-200)}
.book h3{font-size:16.5px;line-height:1.25}
.book .meta{color:var(--plum-soft);font-size:13.5px;margin-top:-6px}
.book .row{display:flex;gap:6px;flex-wrap:wrap;align-items:center}
.book .actions{display:flex;gap:8px;margin-top:auto}

/* ===== Pengguna ===== */
.users{display:flex;flex-direction:column;gap:12px}
.user{display:grid;grid-template-columns:auto 1fr auto auto;align-items:center;gap:16px;background:var(--pink-50);border:2px solid var(--line);border-radius:var(--radius);padding:14px 18px}
.user .avatar{width:48px;height:48px;font-size:18px}
.user .n{font-weight:800}
.user small{color:var(--plum-soft)}
.user .actions{display:flex;gap:8px}

/* ===== Responsive ===== */
@media (max-width:900px){
  .two{grid-template-columns:1fr}
  .sidebar{position:fixed;left:0;top:0;z-index:30;transform:translateX(-100%);transition:transform .2s}
  body.menu-open .sidebar{transform:none;box-shadow:0 0 0 100vmax rgba(74,43,56,.35)}
  .topbar{display:flex;align-items:center;gap:10px;margin-bottom:16px}
  .topbar button{border:2px solid var(--line);background:var(--pink-50);border-radius:12px;padding:8px 12px;font:inherit;font-weight:800;color:var(--plum)}
  .topbar img{width:34px}
  .main{padding:18px 16px 40px}
  .hello{flex-direction:column;text-align:center}
  .hello::after,.hello::before{display:none}
  .user{grid-template-columns:auto 1fr}
  .user .actions,.user .badges{grid-column:2}
}
@media (prefers-reduced-motion:reduce){*{transition:none!important}}

    </style>
</head>
<body>
@php
    $link = fn ($name) => \Illuminate\Support\Facades\Route::has($name) ? route($name) : '#';
@endphp
<div class="shell">
    <aside class="sidebar" id="sidebar">
        <a href="{{ $link('dashboard') }}" class="brand">
            <img src="{{ asset('images/dino-books.svg') }}" alt="Logo Books Store">
            <strong>Books Store</strong>
        </a>

        <div class="me">
            <div class="avatar">{{ strtoupper(mb_substr(Auth::user()->name ?? 'U', 0, 1)) }}</div>
            <div>
                <b>{{ Auth::user()->name ?? 'Pengguna' }}</b>
                <small>{{ Auth::user()->getRoleNames()->first() ?? 'Online' }}</small>
            </div>
        </div>

        <div class="nav-label">Menu utama</div>
        <nav class="nav">
            <a href="{{ $link('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 11l9-8 9 8"/><path d="M5 10v10h14V10"/></svg>
                Dashboard
            </a>
            <a href="{{ $link('books.index') }}" class="{{ request()->routeIs('books.*') ? 'active' : '' }}">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 5a2 2 0 012-2h13v16H6a2 2 0 00-2 2z"/><path d="M4 21V5"/></svg>
                Buku
            </a>
            @role('Admin')
            <a href="{{ $link('users.index') }}" class="{{ request()->routeIs('users.*') ? 'active' : '' }}">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="9" cy="8" r="4"/><path d="M2 21a7 7 0 0114 0"/><path d="M17 4a4 4 0 010 8M22 21a7 7 0 00-4-6"/></svg>
                Pengguna
            </a>
            @endrole
        </nav>

        <div class="nav-label">Sistem</div>
        <nav class="nav">
            <a href="{{ $link('profile.edit') }}" class="{{ request()->routeIs('profile.*') ? 'active' : '' }}">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="8" r="4"/><path d="M4 21a8 8 0 0116 0"/></svg>
                Profil
            </a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="out">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 21H5a2 2 0 01-2-2V5a2 2 0 012-2h4"/><path d="M16 17l5-5-5-5M21 12H9"/></svg>
                    Logout
                </button>
            </form>
        </nav>

        <div class="side-foot">Books Store v1.0</div>
    </aside>

    <main class="main">
        <div class="topbar">
            <button type="button" onclick="document.body.classList.toggle('menu-open')" aria-label="Buka menu">☰ Menu</button>
            <img src="{{ asset('images/dino-books.svg') }}" alt="">
        </div>

        @if (session('success'))
            <div class="toast">{{ session('success') }}</div>
        @endif

        {{ $header ?? '' }}
        @yield('header')
        @if (isset($slot) && ! $slot->isEmpty())
            {{ $slot }}
        @else
            @yield('content')
        @endif
    </main>
</div>
<script>
    document.addEventListener('click', function (e) {
        if (document.body.classList.contains('menu-open') && !e.target.closest('#sidebar') && !e.target.closest('.topbar button')) {
            document.body.classList.remove('menu-open');
        }
    });
</script>
</body>
</html>