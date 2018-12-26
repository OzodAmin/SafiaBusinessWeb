@extends('admin.layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Edit cover
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($cover, ['route' => ['covers.update', $cover->id], 'method' => 'patch']) !!}

                        @include('admin.cover.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection