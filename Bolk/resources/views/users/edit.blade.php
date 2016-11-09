@include('layouts.master')

@section('title') Add user @stop

@section('content')
    @php
        $projects = App\Project::all();
    @endphp
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <h1 class="page-header"><i class="fa fa-user"></i> {{ $state }} user</h1>
            </div>
            <div class="row">
                <form class="form-horizontal" id="frmUser" role="form" method="POST" action="@if($state == 'Create'){{ url('/users') }}@elseif($state == 'Edit'){{ url('/users/'.$user->id) }}@endif">
                    {{ csrf_field() }}

                    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                        <label for="name" class="col-md-4 control-label">Name</label>

                        <div class="col-md-6">
                            <input id="name" type="text" class="form-control" name="name" value="{{ $user->name }}" required autofocus>

                            @if ($errors->has('name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('fullname') ? ' has-error' : '' }}">
                        <label for="name" class="col-md-4 control-label">Full name</label>

                        <div class="col-md-6">
                            <input id="fullname" type="text" class="form-control" name="fullname" value="{{ $user->fullname }}" required autofocus>

                            @if ($errors->has('fullname'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('fullname') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                        <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                        <div class="col-md-6">
                            <input id="email" type="email" class="form-control" name="email" value="{{ $user->email }}" required>

                            @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="project" class="col-md-4 control-label">Assigned project</label>
                        <div class="col-md-6">
                            <select class="form-control" data-live-search="true" id="project" name="project">
                                <option value="0">All projects</option>
                                @foreach($projects as $project)
                                    <option value="{{ $project->id }}" @if($project->id == $user->projectid)selected @endif>{{ $project->id }}: {{ $project->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                        @if($state == 'Edit')
                        <span class="col-md-offset-4 help-block">The password will only change if you fill in values in below fields.</span>
                        @endif
                        <label for="password" class="col-md-4 control-label">Password</label>

                        <div class="col-md-6">
                            <input id="password" type="password" class="form-control" name="password" @if($state == 'Create')required @endif>

                            @if ($errors->has('password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                        <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>

                        <div class="col-md-6">
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" @if($state == 'Create')required @endif>

                            @if ($errors->has('password_confirmation'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password_confirmation') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    @php
                    $roles = App\Role::all();
                    $permissions = App\Permission::all();
                    @endphp

                    <!--<div class="col-md-offset-4 help-block">
                        Choose the role for this user in the program.
                    </div>

                    <div class="form-group {{ $errors->has('roles') ? 'has-error' : '' }}">
                        <label class="col-md-4 control-label">Choose user's role</label>
                        <div class="col-md-6">
                            <select class="form-control" name="role">
                                @foreach($roles as $role)
                                    <option value="{{ $role->id }}" @if($user->hasRole($role->name)) selected @endif>{{ $role->display_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>-->

                    <div class="col-md-offset-4 help-block">
                        Hold CTRL or Shift to select more permissions for user<!--{{ App\Role::where('name', $user->name)->first() }} {{ $user->roles }}-->.
                    </div>

                    <div class="form-group {{ $errors->has('roles') ? 'has-error' : '' }}">
                        <label class="col-md-4 control-label">Choose permissions of user</label>
                        <div class="col-md-6">
                            <select multiple class="form-control" size="7" name="permissions[]">
                            @foreach($permissions as $permission)
                                <option value="{{ $permission->id }}" name="permission[]" @if($user->can($permission->name)) selected @endif>
                                    {{ $permission->display_name }}
                                </option>
                            @endforeach
                            </select>
                        </div>

                    </div>

                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-4">
                            <a href="{{ url('/users') }}" class="btn btn-default">Cancel</a>
                            <button type="submit" id="frmUser-submit" class="btn btn-primary">
                                {{ $state }} user
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        //--------- submit action for Users ---------
        $(function() {
            $('#frmUser-submit').on('click', function(e) {
                e.preventDefault();
                var form = $('#frmUser');
                //form.attr()
                var formData = form.serialize();
                var url = form.attr('action');
                var state = '{{ $state }}';
                var type;

                if (state == 'Create'){
                    type = 'post';
                } else if (state == 'Edit') {
                    type = 'put';
                }

                $.ajax({
                    type: type, url: url, data: formData
                });
            })
        });
    </script>