@extends('app')

@section('content')

    <table class="table">
        <thead>
        <tr>
            <th>#</th>
            <th>Display Name</th>
            <th>Name</th>
            <th colspan="2"><a id="create-btn" href="{{ URL::route('permissions.create') }}" class="btn btn-primary btn-block">Create</a></th>
        </tr>
        </thead>
        <tbody>
        @foreach($permissions as $permission)
            <tr>
                <td>{{ $permission->id }}</td>
                <td>{{ $permission->display_name }}</td>
                <td>{{ $permission->name }}</td>
                <td width="80"><a class="btn btn-primary btn-edit"  href="{{ URL::route('permissions.edit', $permission->id) }}">Edit</a></td>
                <td width="80">{!! Form::open(['route' => ['permissions.update', $permission->id], 'method' => 'DELETE']) !!}
                    {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-delete']) !!}
                    {!!  Form::close() !!}</td>





            </tr>
        @endforeach
        </tbody>
    </table>


    {!! str_replace('/?', '?', $permissions->render()) !!}



@stop

@section('tour')

  {
          title: "CREATE ROLE",
          content: "Here is where you can click to create new Role",
         target: document.querySelector("#create-btn"),
          placement: "left",
          yOffset:-12,

        },

   {
         title: "EDIT ROLE",
         content: "By clicking here you can edit a particular row",
         target: document.querySelector(".btn-edit"),
         placement: "left",
         yOffset:-12
        },

    {
         title: "Delete Role",
         content: "If you want to delete any Role click on the Delete button of that row ",
         target: document.querySelector(".btn-delete"),
         placement: "left",
         yOffset:-12
         },


@stop

@section('jscode')



@stop