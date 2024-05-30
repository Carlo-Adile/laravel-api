@extends('layouts.admin')

@section('content')
	<header class="py-3">
		<div class="container d-flex justify-content-between align-items-center">
			<h1>Edit the project: {{ $project->title }}</h1>

		</div>
	</header>

	<div class="container">
		@include('partials.validation-messages')

		<form action="{{ route('admin.projects.update', $project) }}" method="post" enctype="multipart/form-data">
			@csrf
			@method('PUT')
			
			<div class="mb-3">
				<label for="" class="form-label">Title</label>
				<input type="text" class="form-control @error('title') is-invalid @enderror" name="title" id="title"
					aria-describedby="helpId" placeholder="" value="{{ old('title', $project->title) }}" />
				<small id="helpId" class="form-text text-muted">edit the title for this project</small>
				@error('title')
					<div class="text-danger py-2">
						{{ $message }}
					</div>
				@enderror
			</div>

			<div class="d-flex gap-2 mb-3">
				@if (Str::startsWith($project->cover_image, 'https://'))
					<img src="{{ $project->cover_image }}">
				@else
					<img src="{{ asset('storage/' . $project->cover_image) }}" alt="{{ $project->title }}" width="240"
						loading="lazy">
				@endif
				<div>
					<label for="cover_image" class="form-label">Cover image</label>
				<input type="file" class="form-control" name="cover_image" id="cover_image" aria-describedby="helpId"
					placeholder="cover_image" />
				<small id="helpId" class="form-text text-muted">add a cover image</small>
					@error('cover_image')
						<div class="text-danger py-2">
							{{ $message }}
						</div>
					@enderror
				</div>
			</div>

			<div class="mb-3">
				<label for="category_id" class="form-label">Type</label>
				<select class="form-select form-select-lg" name="type_id" id="type_id">
					<option selected disabled>Select a type</option>
					@foreach ($types as $type)
						<option value="{{ $type->id }}" {{ $type->id == old('type_id', $project->type_id) ? 'selected' : '' }}>
							{{ $type->name }}</option>
					@endforeach
				</select>
			</div>

			<div class="mb-3">
				<label for="technologies" class="form-label">Technologies used</label>
				<div class="row row-cols-3 px-4">
					@foreach ($technologies as $technology)
						<div class="form-check col">
							<input name="technologies[]" class="form-check-input" type="checkbox" value="{{ $technology->id }}"
								id="technology-{{ $technology->id }}" value="{{old('technologies')}}" />
							<label class="form-check-label" for="technology-{{ $technology->id }}"> {{ $technology->name }} </label>
						</div>
					@endforeach
				</div>

			</div>

			<div class="mb-3">
				<label for="content" class="form-label">Content</label>
				<textarea type="text" class="form-control @error('content') is-invalid @enderror" name="content" id="content"
				 aria-describedby="helpId" placeholder="" rows="5">{{ old('content', $project->content) }}</textarea>
				<small id="helpId" class="form-text text-muted">edit the content of this project</small>
				@error('content')
					<div class="text-danger py-2">
						{{ $message }}
					</div>
				@enderror
			</div>

			<button type="submit" class="btn btn-primary">
				Save
			</button>

		</form>
	</div>
@endsection
