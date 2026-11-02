@extends('layouts.app')
@section('header')
    <div class="page-head">
        <div>
            <h1>Edit buku</h1>
            <p>Perbarui data buku ini.</p>
        </div>
    </div>
@endsection
@section('content')
    @include('books._form', ['action' => route('books.update', $book), 'book' => $book])
@endsection