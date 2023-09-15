@extends('layout')

@section('content')
    <h1>Lista użytkowników</h1>
    <table class="table">
        <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Użytkownik</th>
            <th scope="col"></th>
            <th scope="col">Handle</th>
        </tr>
        </thead>
        <tbody>
        @foreach($users as $user)
        <tr>
            <th scope="row">{{ $user['id'] }}</th>
            <td>{{ $user['name'] }}</td>
            <td>{{ $user['email'] }}</td>
            <td>@mdo</td>
        </tr>
        @endforeach
        </tbody>
    </table>
@endsection
