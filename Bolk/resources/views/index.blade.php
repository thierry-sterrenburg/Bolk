@extends('layouts.master')
@section('content')
<div id="page-wrapper">
  <br>
  @if (!Auth::check())
  <div class="alert alert-danger">
    <i class="fa fa-exclamation-triangle"></i> In order to use this program, you have to log in.
  </div>
  @else
  <div class="alert alert-success">
    <i class="fa fa-smile-o"></i> Welcome to this program.
  @endif
</div>
@endsection
