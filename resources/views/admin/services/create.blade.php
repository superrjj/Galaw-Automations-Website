@extends('layouts.admin')

@section('title', 'Create Service')
@section('heading', 'Create service')

@section('content')
@include('admin.services.form', ['service' => null, 'categories' => $categories])
@endsection
