@extends('layouts.master')

@section('title') Users @stop

<script type="text/javascript">
</script>

@section('content')
    <div id="page-wrapper">
        <div class="container-fluid">
            @if(!Auth::check())
                <div class="row">
                    <div class="alert alert-danger">
                        <i class="fa fa-exclamation-triangle"></i> In order to use this program, you have to log in.
                    </div>
                </div>
            @else
            <div class="row">
                <h1 class="page-header"><i class="fa fa-users"></i> User administration</h1>
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
                        <th>Assigned project</th>
                        @role(('admin'))
                        <th>Admin tools</th>
                        @endrole
                        </tr>
                        </thead>

                        <tbody>
                        @foreach($users as $user)
                        <tr id="usr_{{$user->id}}">
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->fullname }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->created_at }}</td>
                        <td>@if(App\Project::find($user->projectid)){{ App\Project::find($user->projectid)->name }}@elseif(App\Project::find($user->projectid)=='')<i>All projects</i>@endif</td>
                        @role(('admin'))
                        <td>
                            @if(!$user->hasRole('admin'))
                            <a class="btn btn-success btn-edit" data-id="{{ $user->id }}" href="/users/{{ $user->id }}/edit"><i class="fa fa-pencil"></i></a>
                            <button class="btn btn-danger btn-delete" data-id="{{ $user->id }}"><i class="fa fa-trash-o"></i></button>
                            @endif
                        </td>

                        @endrole
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

                @role(('admin'))
                <a href="/users/create" class="btn btn-success">Add user</a>
                @endrole

            </div>
    </div>
            @endif
    </div>

    <script type="text/javascript">
        $.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });

        //-----------delete user-----------
        $('tbody').delegate('.btn-delete', 'click', function(){
            var value = $(this).data('id');
            var url = 'users/'+value;
            if (confirm('Are you sure you want to delete this user? You cannot undo this.') == true){
                $.ajax({
                    type: 'delete',
                    url: url,
                    data: {"_token": "{{ csrf_token() }}",
                        'id':value},
                    success:function(data){
                            $('#usr_'+value).remove();
                    }
                })
            };
        });
    </script>
@stop