@extends('layouts.admin')
@section('title', 'Edit Portfolio Project')
@section('heading', 'Edit portfolio project')
@section('content')
@include('admin.portfolio.form', ['project' => $project])
@endsection
