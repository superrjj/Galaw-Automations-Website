@extends('layouts.admin')
@section('title', 'Create Technology')
@section('heading', 'Create technology')
@section('content')
@include('admin.technologies.form', ['technology' => null, 'categories' => $categories])
@endsection
