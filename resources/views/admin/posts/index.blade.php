@extends('layouts.app')

@section('content')
   <div class="container">
      <div class="row">
         <div class="col-md-12">
            <div class="card">
               <div class="card-header d-flex justify-content-between">
                  <span>Posts Manager</span>
                  <a class="btn btn-success btn-sm" href="{{ route('admin.posts.create') }}">
                     <i class="fa-solid fa-plus"></i>
                  </a>
               </div>

               <div class="card-body">
                  @if (session('status'))
                     <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                     </div>
                  @endif

                  {{-- POSTS TABLE --}}
                  <table class="table table-dark">
                     <thead>
                        <tr>
                           <th scope="col">ID</th>
                           <th scope="col">Author</th>
                           <th scope="col">Title</th>
                           <th scope="col">Category</th>
                           <th scope="col">Slug</th>
                           <th scope="col">Updated at</th>
                           <th scope="col"></th>
                        </tr>
                     </thead>
                     <tbody>
                        @foreach ($posts as $post)
                           <tr>
                              <th scope="row">{{ $post->id }}</th>
                              <td class="text-capitalize">{{ $post->user->name }}</td>
                              <td>{{ $post->title }}</td>
                              <td class="text-capitalize">
                                 @if ($post->category_id)
                                    <span style="background-color:{{ $post->category->color }}; color: #fff"
                                       class="badge badge-pill">{{ $post->category->name }}
                                    </span>
                                 @else
                                    <span>- - -</span>
                                 @endif
                              </td>
                              <td>{{ $post->slug }}</td>
                              <td>{{ $post->updated_at }}</td>
                              <td>
                                 <div class="d-flex align-items-center justify-content-between">
                                    <div class="d-flex align-items-center justify-content-between">
                                       {{-- DETAILS --}}
                                       <a class="btn btn-primary btn-sm m-1"
                                          href="{{ route('admin.posts.show', $post->id) }}">
                                          <i class="fa-solid fa-circle-info"></i>
                                       </a>
                                       {{-- EDIT --}}
                                       <a class="btn btn-secondary btn-sm m-1"
                                          href="{{ route('admin.posts.edit', $post->id) }}">
                                          <i class="fa-solid fa-pen-to-square"></i>
                                       </a>
                                    </div>
                                    {{-- DELETE POST --}}
                                    <form action="{{ route('admin.posts.destroy', $post->id) }}" method="POST">
                                       @method('DELETE')
                                       @csrf
                                       <button class="btn btn-danger btn-sm ml-3" type="submit">
                                          <i class="fa-solid fa-trash-can"></i>
                                       </button>
                                    </form>
                                 </div>
                              </td>
                           </tr>
                        @endforeach
                     </tbody>
                  </table>
               </div>
            </div>
            @if ($posts->hasPages())
               {{ $posts->links() }}
            @endif
         </div>
         <br>
         <div class="col-md-12">
            <div class="row">
               <div class="col-12">
                  <h1 class="text-center my-3">Divided by category</h1>
               </div>
               @foreach ($categories as $c_list)
                  <div class="col-3">
                     <h4>
                        <span class="text-uppercase">{{ $c_list->name }}</span>
                        <sup class="badge badge-info badge-pill">{{ count($c_list->post) }} posts</sup>
                     </h4>
                     <ul class="list-group list-group-flush mt-2 mb-5">
                        @foreach ($c_list->post as $single_post)
                           <li class="list-group-item">
                              <a href="{{ route('admin.posts.show', $single_post->id) }}">
                                 {{ $single_post->title }}
                              </a>
                           </li>
                        @endforeach
                     </ul>
                  </div>
               @endforeach
            </div>
         </div>
      </div>
   </div>
@endsection
