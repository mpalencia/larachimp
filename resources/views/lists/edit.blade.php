@extends('layouts.app')

@section('styles')

@stop

@section('content')

<div class="d-flex align-items-center p-3 my-3 text-white-50 bg-purple rounded box-shadow">
    <div class="lh-100">
      <h6 class="mb-0 text-white lh-100">Create New List</h6>
    </div>
</div>

<form action="{{ URL::action('ListController@update', $list->id) }}" method="post" accept-charset="UTF-8">  
  
  <input type="hidden" value="PATCH" name="_method">

  {!! csrf_field() !!}

  <div class="form-group">
    <label for="name">Name</label>
    <input type="text" class="form-control" id="name" name="name" required="" value="{{ $list->name }}">
  </div>

  <div class="form-group">
    <label for="permission_reminder">Permission Reminder</label>
    <input type="text" class="form-control" id="permission_reminder" name="permission_reminder" required="" value="{{ $list->permission_reminder }}">
  </div>

  <div class="form-group">
    <span class="label label-info  badge-primary rounded" style="padding: 0 10px;">Contact</span>
  </div>

  <div class="form-group">
    <label for="company">Company</label>
    <input type="text" class="form-control" id="company" name="company" required="" value="{{ $list->company }}">
  </div>

  <div class="form-group">
    <label for="address1">Address 1</label>
    <input type="text" class="form-control" id="address1" name="address1" required="" value="{{ $list->address1 }}">
  </div>

  <div class="form-group">
    <label for="address2">Address 2</label>
    <input type="text" class="form-control" id="address2" name="address2" required="" value="{{ $list->address2 }}">
  </div>

  <div class="form-group">
    <label for="city">City</label>
    <input type="text" class="form-control" id="city" name="city" required="" value="{{ $list->city }}">
  </div>

  <div class="form-group">
    <label for="state">State</label>
    <input type="text" class="form-control" id="state" name="state" required="" value="{{ $list->state }}">
  </div>

  <div class="form-group">
    <label for="zip">Zip</label>
    <input type="text" class="form-control" id="zip" name="zip" required="" value="{{ $list->zip }}">
  </div>

  <div class="form-group">
    <label for="country">Country</label>
    <input type="text" class="form-control" id="country" name="country" required="" value="{{ $list->country }}">
  </div>

  <div class="form-group">
    <label for="phone">Phone</label>
    <input type="text" class="form-control" id="phone" name="phone" required="" value="{{ $list->phone }}">
  </div> 

  <div class="form-group">
    <span class="label label-info  badge-primary rounded" style="padding: 0 10px;">Campaign Defaults</span>
  </div>

  <div class="form-group">
    <label for="from_name">From Name</label>
    <input type="text" class="form-control" id="from_name" name="from_name" required="" value="{{ $list->from_name }}">
  </div>

  <div class="form-group">
    <label for="from_email">From Email</label>
    <input type="email" class="form-control" id="from_email" name="from_email" required="" value="{{ $list->from_email }}">
  </div>

  <div class="form-group">
    <label for="subject">Subject</label>
    <input type="text" class="form-control" id="subject" name="subject" required="" value="{{ $list->subject }}">
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