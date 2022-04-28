@extends('layouts.app')
@section('content')


   <div class="container">
       @if ($errors->any())
           <div class="alert alert-danger">
               <ul>
                   @foreach ($errors->all() as $error)
                       <li>{{ $error }}</li>
                   @endforeach
               </ul>
           </div>
       @endif
       <form method="POST" action="{{ route('todos.store') }}" enctype="multipart/form-data">
           @csrf
           <div class="form-group">
               <label for="">Title</label>
               <input type="text" name="title" class="form-control" value="{{ old('title' , request()->title ?? '') }}" id="" aria-describedby="" placeholder="Enter Title">
           </div>
           <div class="form-group">
               <label for="">Content</label>
               <input type="text" name="content" class="form-control" value="{{ old('content' , request()->content ?? '') }}"  aria-describedby="" placeholder="Enter Content">
           </div>
           <div class="form-group">
               <label for="">Image</label>
               <input type="file" name="image" class="form-control" id="" aria-describedby="" placeholder="">
           </div>
           <div class="form-group">
               <label for="">Start Date</label>
               <input type="date" name="start_date" class="form-control" value="{{ old('start_date' , request()->start_date ?? '') }}"  aria-describedby="" placeholder="Enter Content">
           </div>
           <div class="form-group">
               <label for="">End Date</label>
               <input type="date" name="end_date" class="form-control" value="{{ old('end_date' , request()->end_date ?? '') }}" { aria-describedby="" placeholder="Enter Content">
           </div>
           <br>
           <button type="submit" class="btn btn-primary">Submit</button>
       </form>
   </div>
@endsection
