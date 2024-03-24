@extends('adminlte::page')
@section('title', 'Dashboard') @section('content_header')
<h1>Dashboard</h1> @stop

@section('content')

<div class="card card-warning">
    <div class="card-header">
        <h3 class="card-title">Form Tambah Level</h3>
    </div>

    <div class="card-body">
        <form method="post" action="{{ route('/level/store') }}">
            {{ csrf_field() }}
            <div class="form-group">
                <label for="level_name">Level Name</label>
                <input type="text" class="form-control" id="level_name" name="level_nama" placeholder="Enter name">
            </div>
            <div class="form-group">
                <label for="level_kode">Level Kode</label>
                <input type="text" class="form-control" id="level_kode" name="level_kode" placeholder="Enter level_kode">
            </div>
            <input type="submit"  class="btn btn-success" value="Simpan">
        </form>
    </div>
</div>
@stop
