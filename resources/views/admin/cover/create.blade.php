<?php ?>
@extends('admin.layouts.app')

@section('content')
    <div class="">
        <div class="row">
                <div class="panel panel-default">
                    <div class="panel-heading">Create New Cover</div>

                    <div class="panel-body">
                        <!-- Display Validation Errors -->
                        @if (count($errors) > 0)
                            <div class="alert alert-danger">
                                <strong>Whoops!</strong> There were some problems with your input.<br><br>
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        {!! Form::open(['route' => 'covers.store']) !!}

                            @include('admin.cover.fields')

                        {!! Form::close() !!}

                    </div>
                </div>
            </div>
        </div>
@endsection