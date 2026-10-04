@extends('layouts.admin')
@section('title', 'Edit Testimonial')
@section('heading', 'Edit testimonial')
@section('content')
@include('admin.testimonials.form', ['testimonial' => $testimonial])
@endsection
