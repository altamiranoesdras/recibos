@extends('layouts.app')

@section('title_page',__('Recibo'))

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header" id="root">
        <div class="container-fluid">
            <div class="row">
                <div class="col">
                    <h1 class="m-0 text-dark">
                        Recibo
                    </h1>
                </div><!-- /.col -->
                <div class="col">
                    <a class="btn btn-success float-right" href="{!! route('recibos.create') !!}">
                        <i class="fa fa-plus"></i>
                        <span class="d-none d-sm-inline">Nuevo Recibo</span>
                    </a>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">



            <div class="row">
                <div class="col-sm-12">
                    <div class="embed-responsive embed-responsive-16by9">

                        <iframe class="embed-responsive-item" id="documento" src="{{route('recibos.pdf',$recibo->id)}}"  ></iframe>

                    </div>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /.content -->
@endsection

