@extends('layouts.admin')
@section('title', 'Edit Technology')
@section('heading', 'Edit technology')
@section('content')
@include('admin.technologies.form', ['technology' => $technology, 'categories' => $categories])
@endsection
