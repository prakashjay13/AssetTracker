@extends('layouts.app')
@section('content')
<div class="content-wrapper">
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <a href="/ImageUploading/{{$ast->id}}" class="btn btn-warning">Add Image</a>
                            <a href="/Assets" class="btn btn-secondary">Back</a>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            @foreach($imgs as $i)
                            <img src="{{url('storage/'.$i->img_path)}}" height="150" width="150" />
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @stop
    <!-- /.content-wrapper -->