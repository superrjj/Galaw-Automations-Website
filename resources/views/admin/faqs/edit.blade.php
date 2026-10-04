@extends('layouts.admin')
@section('title', 'Edit FAQ')
@section('heading', 'Edit FAQ')
@section('content')
@include('admin.faqs.form', ['faq' => $faq])
@endsection
