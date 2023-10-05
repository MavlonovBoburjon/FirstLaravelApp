<x-main xmlns:x-slot="http://www.w3.org/1999/xlink">
    <x-slot:title>
        Postni o'zgartirish  #{{$post->id}}
    </x-slot:title>

    <x-page-star>
        Postni o'zgartirish
    </x-page-star>
    <!-- Post Edit Start -->
    <div class="container-fluid py-5">
        <div class="container">
            <div class="row align-items-end mb-4">
                <div class="col-lg-6">
                    <h6 class="text-secondary font-weight-semi-bold text-uppercase mb-3">New Post</h6>
                    <h1 class="section-title mb-3">Create new post here</h1>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-7 mb-5 mb-lg-0">
                    <div class="post-form">
                        <div id="success"></div>
                        <form action="{{route('posts.update', ['post' => $post])}}" method="POST" enctype="multipart/form-data">
                            @method('PUT')
                            @csrf
                            @if($errors->any())
                                {{ implode('', $errors->all('<div>:message</div>')) }}
                            @endif
                            <div class="form-group">
                                <div class="form-row">
                                    <div class="col-sm-6 control-group">
                                        <input type="text" class="form-control p-4" name="title" value="{{$post->title}}" placeholder="Sarlavha"/>
                                        @error('title')
                                        <p class="help-block text-danger">{{$message}}</p>
                                        @enderror
                                    </div>
                                    <div class="col-sm-6 control-group">
                                        <input type="file" class="form-control p-4" name="photo"/>
                                        @error('photo')
                                        <p class="help-block text-danger">{{$message}}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="control-group">
                                    <textarea type="text" class="form-control p-3" name="short_content" placeholder="Qisqacha Mazmuni"/>{{$post->short_content}}</textarea>
                                    @error('short_content')
                                    <p class="help-block text-danger">{{$message}}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="control-group">
                                    <textarea class="form-control p-4" rows="6" name="content" placeholder="Maqola">{{$post->content}}</textarea>
                                    @error('content')
                                    <p class="help-block text-danger">{{$message}}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="flex">
                                <button class="btn btn-success py-3 px-5" type="submit">Saqlash</button>
                                <a href="{{route('posts.show', ['post' => $post->id])}}" class="btn btn-danger py-3 px-5" type="submit">Bekor qilish</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Post Edit End -->
</x-main>
