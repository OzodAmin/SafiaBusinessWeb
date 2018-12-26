<?php ?>
@extends('admin.layouts.app')

@section('content')
    <div class="container">
        <div class="row">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Districts Management 
                        <a href="{{ route('districts.create') }}" class="btn btn-success">
                            <i class="fa fa-btn fa-plus"></i> 
                            &nbsp;New District
                        </a>
                    </div>
                    <div class="panel-body">
                        @include('flash::message')
                        <table class="table table-striped table-bordered table-condensed">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>City Name</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach ($districts as $key => $district)

                                <tr class="districts-users">
                                    <td>{{ $district->translate('ru')->title }}</td>
                                    <td>{{ $district->city->translate('ru')->title }}</td>
                                    <td>
                                        <a class="btn btn-primary" href="{{ route('districts.edit',$district->id) }}"><i class="fa fa-btn fa-edit"></i> Edit</a>

                                        <form action="{{ url('backend/districts/'.$district->id) }}" method="POST" style="display: inline-block">
                                            {{ csrf_field() }}
                                            {{ method_field('DELETE') }}

                                            <button type="submit" id="delete-task-{{ $district->id }}" class="btn btn-danger">
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
                {{ $districts->links() }}
            </div>
        </div>
@endsection