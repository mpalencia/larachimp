@extends('layouts.app')

@section('styles')

@stop

@section('content')

<div class="d-flex align-items-center p-3 my-3 text-white-50 bg-purple rounded box-shadow">
    <div class="lh-100">
      <h6 class="mb-0 text-white lh-100">{{ $list->name }}</h6>
      <small>{{ $list->subscribe_url_short }}</small>
    </div>
</div>

<div class="col-xs-4 col-md-4">

  <a href="{{ URL::action('ListController@index') }}" class="btn btn-primary">
    <i class="fa fa-arrow-circle-left"></i> Back to list
  </a>

  <a href="{{ URL::action('ListMemberController@create', $list->id) }}" class="btn btn-warning">
    <i class="fa fa-plus-circle"></i> Add Member
  </a><br><br>

</div>

@if(count($members) >0)
<table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Email</th>
      <th scope="col">First Name</th>
      <th scope="col">Last Name</th>
      <th scope="col">Status</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
    @php $crt = 1 @endphp
    @foreach( $members as $member )
    <tr>
      <th scope="row">{{$crt }}</th>
      <td>{{ $member->email }}</td>
      <td>{{ $member->first_name }}</td>
      <td>{{ $member->last_name }}</td>
      <td>{{ $member->status }}</td>
      <td style="display: flex;">
          <a href="{{ URL::action('ListMemberController@edit', $member->id) }}" class="badge  badge-info">
          <span class="fa fa-edit"></span> Edit
          </a> &nbsp;

          <form class="badge  badge-danger" action="{{ URL::action('ListMemberController@destroy', $member->id) }}" method="POST" style="cursor: pointer;">
              <input type="hidden" name="_method" value="DELETE">
              <input type="hidden" name="_token" value="{{ csrf_token() }}" />
              <a id="alert{{$member->id}}"><span class="fa fa-trash"></span> Delete</a>
          </form>
      </td>
    </tr>
    @php $crt++ @endphp
    @endforeach
  </tbody>
</table>
<div class="pagination"> {{ $members->links() }} </div>
@else

  No members yet

@endif

@stop

@section('scripts')
<script type="text/javascript">
$(document).ready(function() {

  //Delete product
  $("a[id*=alert]").on("click", function(){

      if(confirm("Do you want to delete this item?")){
          $(this).parent('form').submit();
      }
      
  });

});
</script>
@stop