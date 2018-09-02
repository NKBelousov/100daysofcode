<?php

use Illuminate\Support\Facades\Auth;

$user = Auth::user();

?>

@extends('layouts.app')

@section('content')
<div class="container">
    <Profile
        name="<?= $user->name ?>"
        email="<?= $user->email ?>"
    />
</div>
@endsection
