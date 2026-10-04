@extends('layouts.admin')
@section('title', 'Create FAQ')
@section('heading', 'Create FAQ')
@section('content')
@include('admin.faqs.form', ['faq' => null])
@endsection
