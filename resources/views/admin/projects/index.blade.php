@extends('layouts.admin')

@section('content')
	<header class="py-3">
		<div class="container d-flex justify-content-between align-items-center">
			<h1>Projects</h1>

			<a href="{{ route('admin.projects.create') }}" class="btn btn-primary">
				Add a new project
				<i class="fa-solid fa-pencil"></i>
			</a>
		</div>
	</header>

	<section class="py-4">
		<div class="container">
			<h4 class="p-3">All projects</h4>

			{{-- messaggio operazione compiuta --}}
			@include('partials.session-messages')

			<div class="table-responsive">
				<table class="table table-light">
					<thead>
						<tr>
							<th scope="col">ID</th>
							<th scope="col">Cover Image</th>
							<th scope="col">Title</th>
							<th scope="col">Slug</th>
							<th scope="col">Actions</th>
						</tr>
					</thead>

					<tbody>
						{{-- @dd($projects) --}}
						@forelse($projects as $project)
							<tr>

								<td scope="row">{{ $project->id }}</td>
								<td><img src="{{ asset('storage/' . $project->cover_image) }}" alt="{{ $project->title }}" width="140"></td>
								<td>{{ $project->title }}</td>
								<td>{{ $project->slug }}</td>
								<td>
									<a class="btn" href="{{ route('admin.projects.show', $project) }}">
										<i class="fa-solid fa-eye"></i>
									</a>
									<a href="{{ route('admin.projects.edit', $project) }}" class="btn">
										<i class="fa-solid fa-pencil"></i>
									</a>






									{{-- bs5-modal-default --}}
									<button type="button" class="btn btn-lg" data-bs-toggle="modal"
										data-bs-target="#modal-{{ $project->id }}">
										<i class="fa-solid fa-trash" aria-hidden="true"></i>
									</button>

									<!-- Modal Body -->
									<!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->
									<div class="modal fade" id="modal-{{ $project->id }}" tabindex="-1" data-bs-backdrop="static"
										data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitle-{{ $project->id }}" aria-hidden="true">
										<div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-sm" role="document">
											<div class="modal-content">
												<div class="modal-header">
													<h5 class="modal-title" id="modalTitle-{{ $project->id }}">
														Delete {{ $project->title }} ?
													</h5>
													<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" data-bs-target="#modal-{{$project->id}}"></button>
												</div>
												
												{{-- <div class="modal-body">Destroy</div> --}}
												<div class="modal-footer">
													<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
														Close
													</button>
													<form action="{{route('admin.projects.destroy', $project)}}" method="post">
														@csrf
														@method('DELETE')

														<button type="submit" class="btn btn-danger">Confirm</button>
													</form>
												</div>
											</div>
										</div>
									</div>



									<!-- Modal trigger button -->
									<button
										type="button"
										class="btn btn-primary btn-lg"
										data-bs-toggle="modal"
										data-bs-target="#modalId"
									>
										Launch
									</button>
									
									<!-- Modal Body -->
									<!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->
									<div
										class="modal fade"
										id="modalId"
										tabindex="-1"
										data-bs-backdrop="static"
										data-bs-keyboard="false"
										
										role="dialog"
										aria-labelledby="modalTitleId"
										aria-hidden="true"
									>
										<div
											class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-sm"
											role="document"
										>
											<div class="modal-content">
												<div class="modal-header">
													<h5 class="modal-title" id="modalTitleId">
														Modal title
													</h5>
													<button
														type="button"
														class="btn-close"
														data-bs-dismiss="modal"
														aria-label="Close"
													></button>
												</div>
												<div class="modal-body">Body</div>
												<div class="modal-footer">
													<button
														type="button"
														class="btn btn-secondary"
														data-bs-dismiss="modal"
													>
														Close
													</button>
													<button type="button" class="btn btn-primary">Save</button>
												</div>
											</div>
										</div>
									</div>
									
									<!-- Optional: Place to the bottom of scripts -->
									<script>
										const myModal = new bootstrap.Modal(
											document.getElementById("modalId"),
											options,
										);
									</script>
									

									

								</td>
							</tr>

						@empty
							<tr class="">
								<td scope="row" colspan="5">No projects added yet!</td>
							</tr>
						@endforelse

					</tbody>
				</table>
			</div>
			{{ $projects->links('pagination::bootstrap-5') }}
		</div>
	</section>
@endsection
