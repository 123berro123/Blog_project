@extends('frontend.master')
@section('main')

<main class="main">

  <!-- Page Title -->
  <div class="page-title py-4 bg-light border-bottom">
    <div class="container d-lg-flex justify-content-between align-items-center">
      <h1 class="mb-2 mb-lg-0 h3 fw-bold text-dark">{{ $post->title }}</h1>
      <nav class="breadcrumbs">
        <ol class="mb-0">
          <li><a href="{{ route('home') }}">Home</a></li>
          <li><a href="{{ route('home') }}#blog-posts">Blog</a></li>
          <li class="current">Details</li>
        </ol>
      </nav>
    </div>
  </div>

  <!-- Blog Details Section -->
  <section class="section">
    <div class="container">

      <!-- Category & Date -->
      <div class="d-flex align-items-center mb-3">
        <span class="badge bg-primary-subtle text-dark border px-3 py-2">
          {{ $post->category_post?->category_name ?? 'Uncategorized' }}
        </span>
        <small class="text-muted ms-3">
          <i class="bi bi-calendar3 me-1"></i>{{ $post->created_at?->format('M d, Y') }}
        </small>
      </div>

      <!-- Post Image -->
      <div class="text-center mb-4">
        <img src="{{ asset('uploads/posts/'.$post->image) }}" 
             alt="{{ $post->title }}"
             class="img-fluid shadow-sm rounded"
             style="max-width:80%; max-height:300px; object-fit:cover;">
      </div>

      <!-- Content -->
      <article class="content px-lg-5">
        <p class="lead">{!! nl2br(e($post->description)) !!}</p>

        @if(!empty($post->tags))
          @php
            $tags = collect(explode(',', $post->tags))->map(fn($t) => trim($t))->filter();
          @endphp
          @if($tags->isNotEmpty())
            <div class="mt-4">
              <h6 class="fw-semibold mb-2">Tags:</h6>
              @foreach($tags as $tag)
                <span class="badge bg-light text-dark border me-2">{{ $tag }}</span>
              @endforeach
            </div>
          @endif
        @endif
      </article>

    </div>
  </section>
</main>

@endsection
