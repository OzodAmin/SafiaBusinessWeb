<?php ?>
@extends('admin.layouts.app')

@section('content')
    <div class="container">
        <div class="row">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Fillings Management&nbsp;
                        <a href="{{ route('fillings.create') }}" class="btn btn-success">
                            <i class="fa fa-btn fa-plus"></i> 
                            &nbsp;New Filling
                        </a>
                    </div>
                    <div class="panel-body">
                        @include('flash::message')
                        <table class="table table-striped table-bordered table-condensed">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach ($fillings as $key => $filling)

                                <tr class="fillings-users">
                                    <td>{{ $filling->translate('ru')->title }}</td>
                                    <td>
                                        <a class="btn btn-primary" href="{{ route('fillings.edit',$filling->id) }}"><i class="fa fa-btn fa-edit"></i> Edit</a>

                                        <form action="{{ url('backend/fillings/'.$filling->id) }}" method="POST" style="display: inline-block">
                                            {{ csrf_field() }}
                                            {{ method_field('DELETE') }}

                                            <button type="submit" id="delete-task-{{ $filling->id }}" class="btn btn-danger">
                                                <i class="fa fa-btn fa-trash"></i> Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                {{ $fillings->links() }}
            </div>
        </div>
@endsection