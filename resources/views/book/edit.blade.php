<head>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.5/chosen.jquery.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.5/chosen.css" rel="stylesheet" type="text/css">
</head>

<form method="POST" action="{{route('book.update', $book->id)}}">
    @method('PUT')
    @csrf
    <input type="hidden" id="user_id" name="user_id" value={{Auth::user()->id}}>
    <div>
        <label>{{ ('Book Title') }}</label>
        <input id="title" type="text" name="title" value="{{ $book->title }}" disabled>
    </div>


    <div>
        <label>{{ ('Author') }}</label>
        <input id="author_id" type="text" name="author_id" value="{{ $author_name }}" disabled>
    </div>

    <div>
        <label>{{ ('publish_year') }}</label>
        <input id="publish_year" type="text" name="publish_year" value="{{ $book->publish_year }}" disabled>
    </div>

    <div>
        <label>{{ ('Categories') }}</label>
        <select class="categories" name="categories[]" multiple>
            @foreach($categories as $category)
                <option value="{{$category->id}}"
                        @foreach($book->book_category as $cat)
                        @if($category->id == $cat->id)
                        selected
                    @endif
                    @endforeach
                >{{$category->name}}</option>
            @endforeach
        </select>
    </div>




    <div>
        <label>{{ ('Age Range') }}</label>
        <select class="age_range" id="age_range" name="age_range">
            <option value="children"  {{ $book->age_range == 'children' ? 'selected' : '' }}>
                Children (3 ~ 12)
            </option>
            <option value="young adults" {{ $book->age_range == 'young adults' ? 'selected' : '' }}>
                Young Adults (13 ~ 23)
            </option>
            <option value="middle-aged & old adults" {{ $book->age_range == 'middle-aged & old adults' ? 'selected' : '' }}>
                Middle-aged (24 ~ 59) & Old Adults (60 ~ 99)
            </option>
        </select>

        @error('age_range') <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong> </span>
        @enderror
    </div>


    <div>
        <label>{{ ('description') }}</label>
        <input id="description" type="text" name="description" value="{{ $book->description }}">

        @error('description')
        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
        @enderror
    </div>

    <div>


        <label>{{ __('cover_image') }}</label>
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

        $(".age_range").chosen({width: "300px", disable_search_threshold: 10});

    });
</script>
