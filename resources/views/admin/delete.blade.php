<div class="col-3" style="padding: 10px;">
	<a class="btn btn-danger" style="color:white;" data-toggle="modal" data-target="#delete">Delete {{ $what }}</a>
</div>
<div class="modal fade" id="delete">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<strong style="align-content: center; text-align: center; font-size: 15px;">Delete {{ $what }}</strong>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			{!! Form::open(['method'=>'DELETE', 'url'=>$url]) !!}
				<div class="modal-body">
					Are you sure you want to delete this {{ $what }}
				</div>
				<div class="modal-footer">
					<div class="mx-auto">
						<button class="btn btn-warning" type="submit" name="action" value="Delete">Delete</button>&nbsp;
						<button class="btn btn-info" data-dismiss="modal">Cancel</button>&nbsp;
						<button class="btn btn-danger" type="submit" name="action" value="Delete From Database">Delete From Database</button>
					</div>
				</div>
			{!! Form::close() !!}
		</div>
	</div>
</div>