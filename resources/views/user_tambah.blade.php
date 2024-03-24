@extends('adminlte::page')
@section('title', 'Dashboard') @section('content_header')
<h1>Dashboard</h1> @stop

@section('content')

<div class="card card-warning">
    <div class="card-header">
        <h3 class="card-title">Form Tambah Data User</h3>
    </div>

    <div class="card-body">
        <form method="post" action="{{ route('/user/tambah_simpan') }}">
            {{ csrf_field() }}
            <div class="form-group">
                <label>Username</label>
                <input class="form-control" type="text" name="username" placeholder="Masukkan Username">
            </div>
            <div class="form-group">
                <label>Nama</label>
                <input class="form-control" type="text" name="nama" placeholder="Masukkan Nama">
            </div>
            <div class="form-group">
                <label>Password</label>
                <input class="form-control" type="password" name="password" placeholder="Masukkan Password">
            </div>
            <div class="form-group">
                <label>Level ID</label>
                <input class="form-control" type="number" name="level_id">
            </div>
            <input type="submit"  class="btn btn-success" value="Simpan">
        </form>
    </div>
</div>
@stop
