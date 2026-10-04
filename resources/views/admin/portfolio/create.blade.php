@extends('layouts.admin')
@section('title', 'Create Portfolio Project')
@section('heading', 'Create portfolio project')
@section('content')
@include('admin.portfolio.form', ['project' => null])
@endsection
