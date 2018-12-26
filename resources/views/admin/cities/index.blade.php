<?php ?>
@extends('admin.layouts.app')

@section('content')
    <div class="container">
        <div class="row">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Cities Management 
                        <a href="{{ route('cities.create') }}" class="btn btn-success">
                            <i class="fa fa-btn fa-plus"></i> 
                            &nbsp;New City
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

                            @foreach ($cities as $key => $city)

                                <tr class="cities-users">
                                    <td>{{ $city->translate('ru')->title }}</td>
                                    <td>
                                        <a class="btn btn-primary" href="{{ route('cities.edit',$city->id) }}"><i class="fa fa-btn fa-edit"></i> Edit</a>

                                        <form action="{{ url('backend/cities/'.$city->id) }}" method="POST" style="display: inline-block">
                                            {{ csrf_field() }}
                                            {{ method_field('DELETE') }}

                                            <button type="submit" id="delete-task-{{ $city->id }}" class="btn btn-danger">
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
                {{ $cities->links() }}
            </div>
        </div>
@endsection