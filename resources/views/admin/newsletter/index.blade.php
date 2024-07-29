@extends('admin.layouts.master')

@section('content')
 
        <h1>Lista de Emails Registrados</h1>
        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Email</th>
                </tr>
            </thead>
            <tbody>
                @foreach($newsletter as $key => $news)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $news->email }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
   
@endsection
