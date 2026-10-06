@extends('layouts.app')

@section('title', 'Posts')

@section('content')

    <div class="mb-4">
        <h1 class="app-page-title mb-1">Posts</h1>
        <p class="text-secondary mb-0">Search posts by User ID and study database indexing.</p>
    </div>

    <div class="card app-card mb-4">
        <div class="card-body p-4">

            <h2 class="h5 fw-semibold mb-3">Search Posts</h2>

            <form action="{{ route('posts.search') }}" method="GET" class="row g-3 align-items-end">

                <div class="col-12 col-sm-6 col-lg-4">
                    <label for="user_id" class="form-label fw-medium">User ID</label>

                    <input
                        type="number"
                        id="user_id"
                        name="user_id"
                        value="{{ request('user_id') }}"
                        placeholder="Enter User ID"
                        min="1"
                        required
                        @error('user_id') aria-invalid="true" aria-describedby="user_id_error" @enderror
                        class="form-control @error('user_id') is-invalid @enderror"
                    >

                    @error('user_id')
                        <div id="user_id_error" class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-12 col-sm-auto d-flex gap-2">
                    <button type="submit" class="btn btn-primary px-4">
                        Search
                    </button>

                    <a href="{{ route('posts.index') }}" class="btn btn-outline-secondary px-4">
                        Reset
                    </a>
                </div>

            </form>

        </div>
    </div>

    @if(request('user_id'))

        <div class="alert alert-info d-flex justify-content-between align-items-center mb-4" role="alert">
            <span>
                Showing posts for User ID: <strong>{{ request('user_id') }}</strong>
            </span>
            <a href="{{ route('posts.index') }}" class="btn btn-sm btn-outline-secondary ms-3">Clear</a>
        </div>

    @endif

    <div class="card app-card">

        <div class="card-header bg-transparent d-flex flex-wrap justify-content-between align-items-center gap-2 px-4 py-3">
            <h2 class="h5 fw-semibold mb-0">Posts List</h2>

            <span class="badge text-bg-light border fw-medium">
                {{ $posts->total() }} {{ Str::plural('record', $posts->total()) }}
            </span>
        </div>

        <div class="table-responsive">

            <table class="table app-table align-middle mb-0">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">User ID</th>
                        <th scope="col">User Name</th>
                        <th scope="col">Title</th>
                        <th scope="col">Description</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse($posts as $post)

                        <tr>
                            <td class="text-secondary">{{ $post->id }}</td>

                            <td><span class="badge text-bg-light border">{{ $post->user_id }}</span></td>

                            <td class="fw-medium">{{ $post->user->name ?? 'N/A' }}</td>

                            <td>{{ $post->title }}</td>

                            <td class="text-secondary">
                                {{ Str::limit($post->description, 80) }}
                            </td>
                        </tr>

                    @empty

                        <tr>
                            <td colspan="5" class="text-center text-secondary py-5">
                                No posts found.
                            </td>
                        </tr>

                    @endforelse

                </tbody>
            </table>

        </div>

        @if($posts->hasPages())
            <div class="card-footer bg-transparent px-4 py-3">
                <div class="pagination-wrapper">
                    {{ $posts->onEachSide(1)->links() }}
                </div>
            </div>
        @endif

    </div>

@endsection
