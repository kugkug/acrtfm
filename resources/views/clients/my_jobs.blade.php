@include('partials.clients.headers')

<section class="container">
	<div class="row">
		<div class="col-md-12"  >
			
			<div class="card">
				<div class="card-header">
					<h3 class="card-title">My Jobs</h3>

					<div class="card-tools">
						<button class="btn btn-primary" data-trigger="add-job">
							<i class="fas fa-plus"></i> Add Job Site
						</button>
					</div>
				</div>
				<div class="card-body">
					<table id="my-jobs" class="table table-bordered table-hover dataTable dtr-inline" aria-describedby="my-jobs_info">
						<thead>
							<tr>
								<th>Site</th>
								<th>Description</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>Site 1</td>
								<td>Description 1</td>
								<td>
									<i class="fas fa-eye text-warning cursor-pointer"></i>
									<i class="fas fa-edit text-primary cursor-pointer"></i>
									<i class="fas fa-trash text-danger cursor-pointer"></i>
								</td>
							</tr>
							<tr>
								<td>Site 2</td>
								<td>Description 2</td>
								<td>
									<i class="fas fa-eye text-warning cursor-pointer"></i>
									<i class="fas fa-edit text-primary cursor-pointer"></i>
									<i class="fas fa-trash text-danger cursor-pointer"></i>
								</td>
							</tr>
							<tr>
								<td>Site 3</td>
								<td>Description 3</td>
								<td>
									<i class="fas fa-eye text-warning cursor-pointer"></i>
									<i class="fas fa-edit text-primary cursor-pointer"></i>
									<i class="fas fa-trash text-danger cursor-pointer"></i>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>

		</div>
	</div>
</section>

@include('partials.clients.footers')
<script src="{{ asset('scripts/my-jobs.js') }}"></script>