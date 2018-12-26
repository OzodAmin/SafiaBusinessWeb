@extends('admin.layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Edit measure
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($measure, ['route' => ['measures.update', $measure->id], 'method' => 'patch']) !!}

                        @include('admin.measure.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection