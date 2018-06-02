@extends('layouts.app')

@section('content')

<!--<div class="container">
      
      
       The justified navigation menu is meant for single line per list item.
           Multiple lines will require custom code not provided by Bootstrap. -->
    <div class="col-med-9 col-lg-9 col-sm-9 pull-left">
      
        <div class="row" style = "background: white; margin: 10px" >

        <h1>Create New Project</h1>

        <form method="post" action="{{ route('projects.store') }}">
            {{ csrf_field() }}

            <div class="form-group">
                <label for="project-name">Name<span class="required">*</span></label>
                <input placeholder="Enter Name"
                    id="project-name"
                    required
                    name="name"
                    spellcheck="false"
                    class="form-control"
                />
            </div>

            @if($companies == null)    
                <input 
                class="form-control"
                type="hidden"
                    name="company_id"
                    value="{{ $company_id }}"
                />
            @endif

            @if($companies != null)
            <div class="form-group">
                <label for="company->content">Select Company</label>

                <select name="company_id" class="form-control">
                    @foreach($companies as $company)
                    <option value="{{ $company->id }}">{{ $company->name }}</option>
                    @endforeach
                </select>
            </div>
            @endif


            <div class="form-group">
                <label for="project->content">Description</label>
                <textarea placeholder="Enter description"
                    style="resize:vertical"
                    id="project-content"
                    name="description"
                    rows="5" spellcheck="false"
                    class="form-control autosize-target text-left">
                    
                </textarea>
            </div>

            <div class="form-group">
                <input type="submit" class="btn btn-primary"
                    value="Submit"/>
            </div>

        </div>
    </div>

    <div class="col-sm-3 col-med-3 col-lg-3 pull-right">
          <!--<div class="sidebar-module sidebar-module-inset">
            <h4>About</h4>
            <p>Etiam porta <em>sem malesuada magna</em> mollis euismod. Cras mattis consectetur purus sit amet fermentum. Aenean lacinia bibendum nulla sed consectetur.</p>
          </div>-->

          <div class="sidebar-module">
            <h4>Actions</h4>
            <ol class="list-unstyled">
              <li><a href="/projects">My Projects</a></li>
            </ol>
          </div>
<!--
          <div class="sidebar-module">
            <h4>Members</h4>
            <ol class="list-unstyled">
              <li><a href="#">Edit</a></li>
              <li><a href="#">Delete</a></li>
              <li><a href="#">Add New User</a></li>
            </ol>
          </div>
-->

    </div>


    @endsection