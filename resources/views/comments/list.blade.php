		@foreach ($comments as $comment)
		<div id="comment_{{ $comment->id }}" class="card mt-3">
			<div class="card-body">
				<div class="row">
					<div class="col-11">
						<a class="btn-link" href="/users/{{ $comment->user->id }}">{{ $comment->user->name }}</a> <span class="comment-body">{{ $comment->content }}</span>
					</div>
					<div class="col-1 text-center">
						<div class="dropdown dropleft">
							<a class="btn btn-comment btn-dropdown align-middle d-inline-flex p-2" id="comment_{{ $comment->id }}_dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-ellipsis-v"></i></a>
							<div class="dropdown-menu">
								@if (Auth::check() && $comment->user_id == Auth::user()->id )
								<a class="dropdown-item" onclick="removeComment()" href="#"><i class="fas fa-trash"></i> Remove </a>

								<form id="destoy-comment" action="/comments/{{ $comment->id }}" method="POST" style="display: none;">
									@csrf
									@method('DELETE')
								</form>

								<script>
									function removeComment() {
										if (confirm('You are going to remove your comment. Are you sure?')) {
											event.preventDefault();
											document.getElementById('destoy-comment').submit();
										}
									}
								</script>
								@else
								<span class="dropdown-item"><i class="fas fa-lock"></i> Only author can delete comment </span>
								@endif
								@if (isset($showRedirection))
								<a class="dropdown-item" href="/articles/{{ $comment->article_id }}"><i class="fas fa-external-link-alt"></i> go to article</a>
								@endif
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="card-links">
				<span class="text-secondary" data-toggle="tooltip" data-placement="bottom" title="{{ $comment->craeted_at }}">{{ $comment->created_at }}</span>
			</div>
		</div>
		@endforeach