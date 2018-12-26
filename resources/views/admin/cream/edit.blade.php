@extends('admin.layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Edit cream
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($cream, ['route' => ['creams.update', $cream->id], 'method' => 'patch']) !!}

                        @include('admin.cream.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection