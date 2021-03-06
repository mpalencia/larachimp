@extends('layouts.app')

@section('styles')

@stop

@section('content')

<div class="d-flex align-items-center p-3 my-3 text-white-50 bg-purple rounded box-shadow">
    <div class="lh-100">
      <h6 class="mb-0 text-white lh-100">Edit Member</h6>
    </div>
</div>

<form action="{{ URL::action('ListMemberController@update', $member->id) }}" method="post" accept-charset="UTF-8">

  <input type="hidden" value="PATCH" name="_method">
  
  {{ csrf_field() }}
  
  <div class="form-group">
    <label for="email_address">Email Address</label>
    <input type="email" class="form-control" id="email_address" name="email_address" required="" value="{{ $member->email }}">
  </div>

  <div class="form-group">
    <label for="first_name">First Name</label>
    <input type="text" class="form-control" id="first_name" name="first_name" required="" value="{{ $member->first_name }}">
  </div>

  <div class="form-group">
    <label for="last_name">Last Name</label>
    <input type="text" class="form-control" id="last_name" name="last_name" required="" value="{{ $member->last_name }}">
  </div>

  <div class="p-3 my-3">
  <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
  <a href="#" onclick="history.go(-1)">
    <button type="button" class="btn btn-warning"><i class="fa fa-times-circle"></i> Back</button>
  </a>
  </div>

</form> 

@stop

@section('scripts')
<script type="text/javascript">

</script>
@stop