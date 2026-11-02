@extends('layouts.app')
@section('header')
    <div class="page-head">
        <div>
            <h1>Tambah buku</h1>
            <p>Isi data buku baru untuk koleksi Books Store.</p>
        </div>
    </div>
@endsection
@section('content')
    @include('books._form', ['action' => route('books.store')])
@endsection