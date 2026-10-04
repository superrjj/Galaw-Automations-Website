@extends('layouts.admin')

@section('title', 'Edit Service')
@section('heading', 'Edit service')

@section('content')
@include('admin.services.form', ['service' => $service, 'categories' => $categories])
@endsection
