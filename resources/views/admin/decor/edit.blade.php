@extends('admin.layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Edit decor
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($decor, ['route' => ['decors.update', $decor->id], 'method' => 'patch']) !!}

                        @include('admin.decor.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection