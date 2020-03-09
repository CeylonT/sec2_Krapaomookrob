@extends('layouts.app')

@section('title', 'Admin Panel - Even Die I am The Tutor')

@section('topic', 'Admin Panel')

@section('menu')
<a class="btn ownbtn" href="#">Manage Admin</a>
<a class="btn ownbtn" href="#">For etc</a>
@endsection

@section('content')
<div class="row">
  <div class="col-lg-9">
    <div class="card">
      <div class="card-body pr-0">
        <h4 class="card-title">Hello, Tee</h4>
        <admin-payment-request></admin-payment-request>

      </div>
    </div>
  </div>
</div>
@endsection