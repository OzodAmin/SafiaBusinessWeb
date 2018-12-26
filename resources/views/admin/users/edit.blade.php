@extends('admin.layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Edit user
            <a href="{{url('users/reset', $user->id)}}" class="btn btn-success">
                <i class="fa fa-btn fa-key"></i> 
                &nbsp;Reset password
            </a>
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($user, ['route' => ['users.update', $user->id], 'method' => 'patch']) !!}

                        @include('admin.users.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection