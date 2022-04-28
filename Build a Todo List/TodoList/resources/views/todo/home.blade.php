@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <!DOCTYPE html>
            <html lang="en">
            <head>
                <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.7.9/angular.min.js"></script>
                <link
                    rel="stylesheet"
                    href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
                    integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh"
                    crossorigin="anonymous"
                />

                <style>
                    .complete {
                        text-decoration: line-through;
                    }
                </style>
            </head>
            <body>
            <div
                class="app-container d-flex align-items-center justify-content-center flex-column"
                ng-app="myApp"
                ng-controller="myController"
            >



                <h3>Todo App</h3>
                <div class="d-flex align-items-center mb-3">


                    <a class="btn btn-warning" href="{{ route('todos.create') }}">Create</a>

                </div>
                <div class="table-wrapper">
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif

                    <table class="table table-hover table-bordered" >
                        <thead>
                        <tr>
                            <th scope="col" class="col-auto">#</th>
                            <th scope="col" class="" width="230px">Title</th>
                            <th scope="col" class="col-md-auto">Content</th>
                            <th scope="col" class="col-md-auto" >Image</th>
                            <th scope="col" class="" width="190px">Start Date</th>
                            <th scope="col" class="" width="180px">End Date</th>
                            <th scope="col" class="col-md-auto">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($todos as $index => $todo)
                            <tr>
                                <th scope="row">{{ $index }}</th>
                                <td>{{ $todo->title }}</td>
                                <td>{{ $todo->content }}</td>
                                <td>
                                    <img src="{{ $todo->image_path }}" class="img-fluid" width="150px" height="150px" alt="">
                                </td>
                                <td>{{ $todo->start_date }}</td>
                                <td>{{ $todo->end_date }}</td>
                                <td>

                                    <form class="d-inline-block" action="{{ route('todos.destroy' , $todo->id) }}" method="POST" >
                                        @csrf
                                        @method('delete')
                                        <button type="submit"  class="btn btn-danger ">
                                            <i class="fas fa-trash">
                                            </i>
                                            Delete

                                        </button>

                                    </form>

                                </td>
                            </tr>

                        @endforeach


                        </tbody>
                    </table>
                </div>
            </div>

            <script
                src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
                integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n"
                crossorigin="anonymous"
            ></script>
            <script
                src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
                integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
                crossorigin="anonymous"
            ></script>
            <script
                src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
                integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6"
                crossorigin="anonymous"
            ></script>
            </body>
            </html>

        </div>
    </div>
</div>
@endsection
