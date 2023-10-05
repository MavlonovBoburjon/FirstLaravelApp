<x-main xmlns:x-slot="http://www.w3.org/1999/xlink">

    <x-slot:title>
        Yangi Post
    </x-slot:title>

    <x-page-star>
        Yangi Yost Yartish
    </x-page-star>
    <!-- Post Create Start -->
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
                        <form action="{{route('posts.store')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <div class="form-row">
                                    <div class="col-sm-4 control-group">
                                        <input type="text" class="form-control p-4" name="title" value="{{old('title')}}" placeholder="Sarlavha"/>
                                        @error('title')
                                            <p class="help-block text-danger">{{$message}}</p>
                                        @enderror
                                    </div>
                                    <div class="col-sm-4 control-group">
                                        <input type="file" class="form-control p-4" name="photo"/>
                                        @error('photo')
                                            <p class="help-block text-danger">{{$message}}</p>
                                        @enderror
                                    </div>
                                    <div class="col-sm-4 control-group">
                                        <select class="form-control form-control-lg"  name="category_id">
                                            <option value="">Categoriyani tanlang</option>
                                            @foreach($categories as $category)
                                                <option value="{{$category->id}}">{{$category->name}}</option>
                                            @endforeach
                                        </select>
                                        @error('category_id')
                                        <p class="help-block text-danger">{{$message}}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-row">
                                    <div class="col-sm-6 control-group">
                                            <select class="form-control form-control-sm" size="3" name="tags[]" multiple="multiple">
                                                @foreach($tags as $tag)
                                                    <option class="dropdown-item" value="{{$tag->id}}">{{$tag->name}}</option>
                                                @endforeach
                                            </select>
                                        @error('tag_id')
                                        <p class="help-block text-danger">{{$message}}</p>
                                        @enderror
                                    </div>
                                    <div class="col-sm-6 control-group">
                                        <textarea type="text" class="form-control p-4" name="short_content" placeholder="Qisqacha Mazmuni"/>{{old('short_content')}}</textarea>
                                        @error('short_content')
                                        <p class="help-block text-danger">{{$message}}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                            </div>
                            <div class="form-group">
                                <div class="control-group">
                                    <textarea class="form-control p-4" rows="6" name="content" placeholder="Maqola">{{old('content')}}</textarea>
                                    @error('content')
                                        <p class="help-block text-danger">{{$message}}</p>
                                    @enderror
                                </div>
                            </div>
                            <div>
                                <button class="btn btn-primary btn-block py-3 px-5" type="submit">Create Post</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Post Create End -->
</x-main>
