@extends('app')


@section('head')

{!!  Html::style('plugins/dependent_dropdown/css/dependent-dropdown.min.css')  !!}

@endsection


@section('content')

<?php 

print_r(get_districts(34));

?>

@endsection


