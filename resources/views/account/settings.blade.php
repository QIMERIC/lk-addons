@extends('account.layout')

@section('account-title') Settings @endsection

@section('account-content')
{!! breadcrumbs(['My Account' => Auth::user()->url, 'Settings' => 'account/settings']) !!}

<h1>Settings</h1>
<br>
<h3>Avatar</h3>
<div class="text-left"><div class="alert alert-warning">Please note a hard refresh may be required to see your updated avatar. Also please note that uploading a .gif will display a 500 error after; the upload should still work, however.</div></div>
@if(Auth::user()->isStaff)
        <div class="alert alert-danger">For admins - note that .GIF avatars leave a tmp file in the directory (e.g php2471.tmp). There is an automatic schedule to delete these files.
        </div>
    @endif
<form enctype="multipart/form-data" action="avatar" method="POST">
                <label>Update Profile Image</label><br>
                <input type="file" name="avatar">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="submit" class="pull-right btn btn-sm btn-primary">
            </form>
<br>
<h3>Profile</h3>

{!! Form::open(['url' => 'account/profile']) !!}
    <div class="form-group">
        {!! Form::label('text', 'Profile Text') !!}
        {!! Form::textarea('text', Auth::user()->profile->text, ['class' => 'form-control wysiwyg']) !!}
    </div>
    <div class="text-right">
        {!! Form::submit('Edit', ['class' => 'btn btn-primary']) !!}
    </div>
{!! Form::close() !!}
  <br>
  <h3>Edit Pronouns</h3>
{!! Form::open(['url' => 'account/pronouns']) !!}
    <div class="form-group row">
        <label class="col-md-2 col-form-label">Pronouns</label>
        <div class="col-md-9">
            {!! Form::text('pronouns', Auth::user()->profile->pronouns, ['class' => 'form-control']) !!}
        </div>
    </div>
    <div class="text-right">
        {!! Form::submit('Edit', ['class' => 'btn btn-primary']) !!}
    </div>

{!! Form::close() !!}

<h3>Email Address</h3>

<p>Changing your email address will require you to re-verify your email address.</p>

{!! Form::open(['url' => 'account/email']) !!}
    <div class="form-group row">
        <label class="col-md-2 col-form-label">Email Address</label>
        <div class="col-md-10">
            {!! Form::text('email', Auth::user()->email, ['class' => 'form-control']) !!}
        </div>
    </div>
    <div class="text-right">
        {!! Form::submit('Edit', ['class' => 'btn btn-primary']) !!}
    </div>
{!! Form::close() !!}

<h3>Change Password</h3>

{!! Form::open(['url' => 'account/password']) !!}
    <div class="form-group row">
        <label class="col-md-2 col-form-label">Old Password</label>
        <div class="col-md-10">
            {!! Form::password('old_password', ['class' => 'form-control']) !!}
        </div>
    </div>
    <div class="form-group row">
        <label class="col-md-2 col-form-label">New Password</label>
        <div class="col-md-10">
            {!! Form::password('new_password', ['class' => 'form-control']) !!}
        </div>
    </div>
    <div class="form-group row">
        <label class="col-md-2 col-form-label">Confirm New Password</label>
        <div class="col-md-10">
            {!! Form::password('new_password_confirmation', ['class' => 'form-control']) !!}
        </div>
    </div>
    <div class="text-right">
        {!! Form::submit('Edit', ['class' => 'btn btn-primary']) !!}
    </div>
{!! Form::close() !!}

@endsection
