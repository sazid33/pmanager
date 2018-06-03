@extends('layouts.app')

@section('content')

<!--<div class="container">
      
      
       The justified navigation menu is meant for single line per list item.
           Multiple lines will require custom code not provided by Bootstrap. -->
    <div class="col-med-9 col-lg-9 pull-left">
      <!-- Jumbotron -->
      <div class="well well-lg">
        <h2>{{$project->name}}</h2>
        <p class="lead">{{$project->description}}</p>
        <!--<a href="/projects/create" class="pull-right btn btn-primary btn-med">Add Project</a>-->
        <!--<p><a class="btn btn-lg btn-success" href="#" role="button">Get started today</a></p>-->
      </div>

      <!-- Example row of columns -->
      
      <div class="row container-fluid">
        @include('partials.comments')
      <br>
        <form method="post" action="{{ route('comments.store') }}">
            {{ csrf_field() }} 

            <input type="hidden" name="commentable_type" value="App\Project">
            <input type="hidden" name="commentable_id" value="{{ $project->id }}">

            <div class="form-group">
                <label for="comment->content">Comment</label>
                <textarea placeholder="Enter Comment"
                    style="resize:vertical"
                    id="comment-content"
                    name="body"
                    rows="3" spellcheck="false"
                    class="form-control autosize-target text-left">
                    
                </textarea>
            </div>

            <div class="form-group">
                <label for="comment->content">Proof of Work Done (Url/Photos)</label>
                <textarea placeholder="Enter Url / Screenshots"
                    style="resize:vertical"
                    id="comment-content"
                    name="url"
                    rows="1" spellcheck="false"
                    class="form-control autosize-target text-left">
                    
                </textarea>
            </div>

            <div class="form-group">
                <input type="submit" class="btn btn-primary"
                    value="Submit"/>
            </div>
        </form>
      </br>
      </div>
    </div>

    <div class="col-sm-3 col-med-3 col-lg-3 pull-right">
          <div class="sidebar-module pull-right">
            <h4>Actions</h4>
            <ol class="list-unstyled">
              <li><a href="/projects/{{ $project->id }}/edit">Edit</a></li>
              <li><a href="/projects/create">Add Project</a></li>
              <li><a href="/projects">My Projects</a></li>
              <!--<li><a href="/project/create">Create New project</a></li>-->

              
            @if($project->user_id == Auth::user()->id)
              <li>
                <a href="#"
                  onclick="
                  var result = confirm('Are you sure to delete this project?');
                  if(result){
                    event.preventDefault();
                    document.getElementById('delete-form').submit();
                  }"
                >Delete</a>
                
                <form id="delete-form" action="{{ route('projects.destroy', [$project->id]) }}"
                  method="POST" style="display:none;">
                    <input type="hidden" name="_method" value="delete">
                    {{ csrf_field() }}
                </form>

              </li>
            @endif
            </ol>
          </div>

    </div>


    @endsection