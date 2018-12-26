<?php ?>
@extends('admin.layouts.app')

@section('content')
    <div class="container">
        <div class="row">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Product Management&nbsp;
                        <a href="{{ route('products.create') }}" class="btn btn-success">
                            <i class="fa fa-btn fa-plus"></i> 
                            &nbsp;New product
                        </a>
                    </div>
                    <div class="panel-body">
                        @include('flash::message')
                        <table class="table table-striped table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Catrgory</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach ($products as $key => $product)

                                <tr class="products-users">
                                    <td><center>
                                        @if ($product->featured_image)
                                            {{ Html::image('uploads/product/admin_'.$product->featured_image, null, ['class'=>'visible animated']) }}
                                        @else
                                            {{ Html::image('uploads/product/320x320.jpg', null, ['class'=>'visible animated']) }}
                                        @endif
                                    </center></td>
                                    <td>{{ $product->translate('ru')->title }}</td>
                                    <td>{{ $product->category->title }}</td>
                                    <td>
                                        <a class="btn btn-primary" href="{{ route('products.edit',$product->id) }}"><i class="fa fa-btn fa-edit"></i> Edit</a>

                                        <form action="{{ url('backend/products/'.$product->id) }}" method="POST" style="display: inline-block">
                                            {{ csrf_field() }}
                                            {{ method_field('DELETE') }}

                                            <button type="submit" id="delete-task-{{ $product->id }}" class="btn btn-danger">
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
                {{ $products->links() }}
            </div>
        </div>
@endsection