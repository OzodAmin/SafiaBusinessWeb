<?php ?>
@extends('admin.layouts.app')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            Order Management
        </div>
        <div class="panel-body">
            @include('flash::message')
            <table class="table table-striped table-bordered table-hover">
                <thead>
                <tr>
                    <th>Order</th>
                    <th>Status</th>
                    <th>Total price</th>
                    <th>Created at</th>
                    <th>Customer</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>

                @foreach ($orders as $order)

                    <tr class="products-users">
                        <td class="col-sm-1">
                            <a href="{{ route('orders.show',$order->id) }}">
                                #{{ $order->id }}
                            </a>
                        </td>
                        <td class="col-sm-1">
                            @switch($order->status)
                                @case(Order::NEW_ORDER)
                                <label class="label label-primary">New</label>
                                @break
                                @case(Order::ACCEPTED_ORDER)
                                <label class="label label-success">Accepted</label>
                                @break
                                @case(Order::DECLINED_ORDER)
                                <label class="label label-danger">Declined</label>
                                @break
                            @endswitch
                        </td>
                        <td class="col-sm-2">
                            <?= number_format($order->total_price, 2, '.', ' '); ?>&nbsp;Сум
                        </td>
                        <td class="col-sm-1">
                            <?= date("d.m.Y", strtotime($order->created_at)); ?>
                        </td>
                        <td class="col-sm-4">
                            <a href="{{ route('users.show',$order->user->id) }}">
                                {{ $order->user->companyName }}
                            </a>
                        </td>
                        <td class="col-sm-3">
                            <a class="btn btn-info" href="{{ route('order.show',$order->id) }}">
                                <i class="fa fa-btn fa-eye"></i>&nbsp;Show
                            </a>
                            <a class="btn btn-primary" href="{{ route('orders.edit',$order->id) }}">
                                <i class="fa fa-btn fa-edit"></i>&nbsp;Edit
                            </a>
                            <form action="{{ url('backend/orders/'.$order->id) }}" method="POST" style="display: inline-block">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}

                                <button type="submit" id="delete-task-{{ $order->id }}" class="btn btn-danger">
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
    {{ $orders->links() }}
@endsection