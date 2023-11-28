@extends('frontend.Layout.master')
@section('title', 'Students List')
@section('content')

<div class="container">
    <center><h1 style="background-image: url('https://secure.b8cdn.com/bayt/assets/home-76y3bq4o/images/heart.svg');  background-position: right center; background-repeat: no-repeat;">
    Student Information</h1></center>
    <table class="student-table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Age</th>
                <th>Residence Location</th>
            </tr>
        </thead>
        <tbody>
            @foreach($student as $index)
                <tr>
                    <td>{{ $index->name }}</td>
                    <td>{{ $index->age }}</td>
                    <td>{{ $index->residence_location }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection