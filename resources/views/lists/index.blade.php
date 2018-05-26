@extends('layouts.app')

@section('styles')

@stop

@section('content')

<div class="d-flex align-items-center p-3 my-3 text-white-50 bg-purple rounded box-shadow">
    <div class="lh-100">
      <h6 class="mb-0 text-white lh-100">Laravel + MailChimp</h6>
      <small>Matthew Palencia</small>
    </div>
</div>

<div class="col-xs-2 col-md-2">
  <a href="{{ URL::action('ListController@create') }}" class="btn btn-primary">
    <i class="fa fa-plus-circle"></i> New List
  </a><br><br>
</div>

@if($lists)
<table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Name</th>
      <th scope="col">Company</th>
      <th scope="col">Subject</th>
      <th scope="col">Subscribe URL</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
    @php $crt = 1 @endphp
    @foreach( $lists as $list )
    <tr>
      <th scope="row">{{$crt }}</th>
      <td>{{ $list->name }}</td>
      <td>{{ $list->company }}</td>
      <td>{{ $list->subject }}</td>
      <td>{{ $list->subscribe_url_short }}</td>
      <td style="display: flex;">
          <a href="{{ URL::action('ListMemberController@show', $list->id) }}" class="badge  badge-warning">
          <span class="fa fa-user"></span> Members
          </a> &nbsp;

          <a href="{{ URL::action('ListController@edit', $list->id) }}" class="badge  badge-info">
          <span class="fa fa-edit"></span> Edit
          </a> &nbsp;

          <form class="badge  badge-danger" action="{{ URL::action('ListController@destroy', $list->id) }}" method="POST" style="cursor: pointer;">
              <input type="hidden" name="_method" value="DELETE">
              <input type="hidden" name="_token" value="{{ csrf_token() }}" />
              <a id="alert{{$list->id}}"><span class="fa fa-trash"></span> Delete</a>
          </form>
      </td>
    </tr>
    @php $crt++ @endphp
    @endforeach

  </tbody>
</table>
<div class="pagination"> {{ $lists->links() }} </div>
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