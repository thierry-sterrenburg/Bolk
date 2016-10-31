@extends('layouts.master')

@section('title') Users @stop

@section('content')
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <h1 class="page-header"><i class="fa fa-users"></i> User administration <a href="/logout" class="btn btn-default pull-right">Logout</a></h1>
            </div>
            <div class="row">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                        <tr>
                        <th>Name</th>
                        <th>Full name</th>
                        <th>Email</th>
                        <th>Date/Time added</th>
                        <th></th>
                        </tr>
                        </thead>

                        <tbody>
                        @foreach($users as $user)
                            <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->fullname }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->created_at }}</td>
                        {{--<td><a href="/user/{{ $user->id }}/edit" class="btn btn-info pull-left" style="margin-right: 3px;"><i class="fa fa-pencil"></i></a>--}}
                        {{--{{ Form::open(['url' => '/user/' . $user->id, 'method' => 'DELETE']) }}--}}
                        {{--{{ Form::submit('<i class="fa fa-danger"></i>', ['class' => 'btn btn-danger']) }}--}}
                        {{--{{ Form::close() }}--}}
                        {{--</td>--}}
                        <td><button class="btn btn-success btn-edit" data-id="{{ $user->id }}"><i class="fa fa-pencil"></i></button></td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

                <a href="/user/create" class="btn btn-success">Add user</a>
            </div>
            @stop