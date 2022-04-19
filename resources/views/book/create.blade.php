<head>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.5/chosen.jquery.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.5/chosen.css" rel="stylesheet" type="text/css">
</head>
{{--1.6.4--}}
{{--<head>--}}
{{--    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>--}}

{{--    <!-- Chosen -->--}}
{{--    <link href="{{asset('chosen/chosen.css')}}"  type='text/css'>--}}
{{--    <script src="{{asset('chosen/chosen.jquery.js')}}" type='text/javascript'></script>--}}
{{--</head>--}}

<form method="POST" action="{{ route('book.store') }}">
    @csrf
    <input type="hidden" id="user_id" name="user_id" value={{Auth::user()->id}}>
    <div>
        <label>{{ ('Book Title') }}</label>
        <input id="title" type="text" name="title" value="{{ old('title') }}" autofocus>
        @error('title')
        <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong> </span>
        @enderror
    </div>

    <div>
        <label>{{ ('Author') }}</label>
        <select class="author" name="author_id" id="author_id">
            @foreach($authors as $author)
                <option value="{{$author->id}}">{{$author->name}}</option>
            @endforeach
        </select>
        @error('author_id') <span class="invalid-feedback" role="alert">  <strong>{{ $message }}</strong> </span>
        @enderror
    </div>




    <div>
        <label>{{ ('Publish Year') }}</label>
        <input id="publish_year" type="text" name="publish_year" value="{{ old('publish_year') }}">
        @error('publish_year') <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong> </span>
        @enderror
    </div>

    <div>
        <label>{{ ('Categories') }}</label>
        <select class="categories" name="categories[]" multiple>
            @foreach($categories as $category)
                <option value="{{$category->id}}">{{$category->name}}</option>
            @endforeach
        </select>
        @error('categories') <span class="invalid-feedback" role="alert">  <strong>{{ $message }}</strong> </span>
        @enderror
    </div>

    <div>
        <label>{{ ('Age Range') }}</label>
        <select class="age_range" id="age_range" name="age_range" class="form-control">
            <option value="children">Children (3 ~ 12)</option>
            <option value="young adults">Young Adults (13 ~ 23)</option>
            <option value="middle-aged & old adults">Middle-aged (24 ~ 59) & Old Adults (60 ~ 99)</option>
        </select>
        @error('age_range') <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong> </span>
        @enderror
    </div>


    <div>
        <label>{{ __('Description') }}</label>
        <input id="description" type="text" name="description" value="{{ old('description') }}">

        @error('description')
        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
        @enderror
    </div>

    <div>


        <label>{{ __('Cover Image') }}</label>
        <input id="cover_image" type="file" accept=".jpg" name="cover_image" value="{{ old('cover_image') }}">

        @error('cover_image')
        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
        @enderror
    </div>

    <div>
        <button type="submit">
            {{ __('Register') }}
        </button>
    </div>

</form>

<script type="text/javascript">
    $(document).ready(function () {

        $(".categories").chosen({width: "300px"});

    });
</script>

<script type="text/javascript">
    $(document).ready(function () {

        $(".author").chosen({width: "300px"});

    });
</script>

<script type="text/javascript">
    $(document).ready(function () {

        $(".age_range").chosen({width: "300px", disable_search_threshold: 10});

    });
</script>





