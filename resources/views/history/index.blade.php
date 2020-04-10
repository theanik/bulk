@extends('layouts.app')
@section('content')
<div class="container-fluid app-body">
	<h3>Recent Post sent to Buffer

	@if($user->plansubs())
		@if($user->plansubs()['plan']->slug == 'proplusagencym' OR $user->plansubs()['plan']->slug == 'proplusagencyy' )
			<a href="https://bufferapp.com/oauth2/authorize?client_id={{env('BUFFER_CLIENT_ID')}}&redirect_uri={{env('BUFFER_REDIRECT')}}&response_type=code" class="btn btn-primary pull-right">Add Buffer Account</a>
		@endif
	@endif




	</h3>

	<div class="row">
		<div class="col-md-12">
			<div class="row">
				<form method="GET" action="{{ route('search_by_date') }}">
					<div class="col-md-4">
						<input type="date" class="form-control" name="search_by_date">
						<button type="submit" class="btn btn-primary">
							Search
							<i class="fas fa-sync"></i>
						</button>
					</div>
				</form>
				<form action="{{ route('filter_by_group') }}" method="get">
					<div class="col-md-4">
						<select class="form-control" name="fileds">
							<option value="">All Group</option>
							@foreach ($groups as $group)
								<option value="{{ $group->type }}">{{ $group->type }}</option>
							@endforeach
						</select>
						<button type="submit" class="btn btn-primary">
							Search
							<i class="fas fa-sync"></i>
						</button>
	
					</div>
				</form>

				<form action="{{ route('search_data') }}" method="get">
					<div class="col-md-4">
						
						<input type="text" class="form-control" name="search_data" placeholder="Search">

						<button type="submit" class="btn btn-primary">
							Search
							<i class="fas fa-sync"></i>
						</button>
					</div>
				</form>

				
			</div>
			<table class="table table-hover social-accounts"> 
				<thead> 
                    <tr>
                        <th>Group Name</th> 
                        <th>Group Type</th>
                        <th>Accout Name</th>
                        <th>Post Text</th>
                        <th>Time</th>
                    </tr> 
				</thead> 
				<tbody> 
				@foreach ($bufferPosts as $bufferPost)
					<tr>
						<td>
                            {{ $bufferPost->groupInfo['name'] }}
                        </td>
                        <td>
                            {{ $bufferPost->groupInfo['type'] }}
                        </td>
                        <td>
							<div class="media">
								<div class="media-left">
									<a href="">
										<span class="fa fa-{{$bufferPost->accountInfo['type']}}"></span>
										<img width="50" class="media-object img-circle" src="{{$bufferPost->accountInfo['avatar']}}" alt="">
									</a>
								</div>
							</div>
						</td> 
					
						 
						<td>
                            
                            {{ strlen($bufferPost->post_text) > 10 ? substr($bufferPost->post_text,0,10)."..." : $bufferPost->post_text }}
                        </td>
                        <td>
                            {{ date('d M Y h:i A', strtotime($bufferPost->sent_at)) }}
						</td>
                    </tr>
					@endforeach
					
				</tbody> 
				
			</table>
			<div class="row">
				{{ $bufferPosts->links() }}
			</div>
		</div>
	</div>
</div>
@endsection


