@extends('layouts.admin')
@section('title', 'Create Testimonial')
@section('heading', 'Create testimonial')
@section('content')
@include('admin.testimonials.form', ['testimonial' => null])
@endsection
