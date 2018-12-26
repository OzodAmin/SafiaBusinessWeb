<?php ?>
@extends('admin.layouts.app')

@section('content')
    <div class="container">
        <div class="row">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        User Management&nbsp;
                        <a href="{{ route('users.create') }}" class="btn btn-success">
                            <i class="fa fa-btn fa-plus"></i> 
                            &nbsp;New User
                        </a>
                    </div>

                    <div class="panel-body">
                        @include('flash::message')
                        @if ($message = Session::get('success'))
                            <div class="alert alert-success">
                                <p>{{ $message }}</p>
                            </div>
                        @endif
                        <table class="table table-striped table-bordered table-condensed">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Company</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach ($users as $key => $user)

                                <tr class="list-users">
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->companyName }}</td>
                                    <td>
                                        <a class="btn btn-info" href="{{ route('users.show',$user->id) }}">
                                            <i class="fa fa-btn fa-eye"></i>&nbsp;Show
                                        </a>
                                        <a class="btn btn-primary" href="{{ route('users.edit',$user->id) }}">
                                            <i class="fa fa-btn fa-edit"></i>&nbsp;Edit
                                        </a>

                                        <form action="{{ url('backend/users/'.$user->id) }}" method="POST" style="display: inline-block">
                                            {{ csrf_field() }}
                                            {{ method_field('DELETE') }}

                                            <button type="submit" id="delete-task-{{ $user->id }}" class="btn btn-danger">
                                                <i class="fa fa-btn fa-trash"></i>&nbsp;Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            {{ $users->links() }}
        </div>
    </div>
@endsection