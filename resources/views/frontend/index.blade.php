@extends('frontend.master')
@section('main')

<main class="main">

  <!-- Page Title -->
  <div class="page-title">
    <div class="container d-lg-flex justify-content-between align-items-center">
      <h1 class="mb-2 mb-lg-0">Blog</h1>
      <nav class="breadcrumbs">
        <ol>
          <li><a href="{{ route('home') }}">Home</a></li>
          <li class="current">Blog</li>
        </ol>
      </nav>
    </div>
  </div><!-- End Page Title -->

  <!-- Blog Posts Section -->
  <section id="blog-posts" class="blog-posts section">
    <div class="container">
      <div class="row gy-4">

        @forelse($posts as $post)
          <div class="col-lg-4">
            <article>

              <div class="post-img">
                <a href="{{ route('blog.show', $post->id) }}">
                  <img src="{{ asset('uploads/posts/'.$post->image) }}"
                       alt="{{ $post->title }}" 
                       class="img-fluid" style="width:100%;height:240px;object-fit:cover;">
                </a>
              </div>

              <p class="post-category">
                {{ $post->category_post->category_name ?? 'Uncategorized' }}
              </p>

              <h2 class="title">
                <a href="{{ route('blog.show', $post->id) }}">
                  {{ $post->title }}
                </a>
              </h2>

              <div class="d-flex align-items-center">
                <img src="{{ asset('frontend/assets/img/blog/blog-author.jpg') }}"
                     alt="Author" class="img-fluid post-author-img flex-shrink-0">
                <div class="post-meta">
                  <p class="post-author">Admin</p>
                  <p class="post-date">
                    <time datetime="{{ $post->created_at }}">
                      {{ $post->created_at->format('M d, Y') }}
                    </time>
                  </p>
                </div>
              </div>

            </article>
          </div><!-- End post list item -->
        @empty
          <p class="text-center">No posts found.</p>
        @endforelse

      </div>

      <!-- Pagination -->
      <div class="d-flex justify-content-center mt-4">
        {{ $posts->links('pagination::bootstrap-5') }}
      </div>

    </div>
  </section><!-- /Blog Posts Section -->

</main>
@endsection
