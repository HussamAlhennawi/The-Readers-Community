<head>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.5/chosen.jquery.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.5/chosen.css" rel="stylesheet" type="text/css">
</head>

<form method="POST" action="{{ route('group.post',$group)}}">
{{--create new post }}--}}
    @csrf
    <input type="hidden" id="user_id" name="user_id" value={{Auth::user()->id}}>

    <div>
        <label>{{ ('POST TYPE') }}</label>
        <select class="type" id="type" name="type" class="form-control">
            <option disabled selected hidden value=""> select a type </option>
            <option value="review">Review</option>
            <option value="summary">Summary</option>
            <option value="quotation">Quotation</option>
            <option value="other">Other</option>
        </select>
        @error('type') <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong> </span>
        @enderror
    </div>

    <div>
        <label>{{ ('STATUS') }}</label>
        <select class="status" id="status" name="status" class="form-control">
            <option disabled selected hidden value=""> select a status </option>
            <option value="read">Read</option>
            <option value="to_read">Want To Read</option>
            <option value="reading">Reading</option>
        </select>
        @error('status') <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong> </span>
        @enderror
    </div>
    <span>you can add book/author as refernce to your post</span>
    <div>
        <label>{{ ('About (Book)') }}</label>
        <select class="books" name="books[]" multiple>
            @foreach($books as $book)
                <option value="{{$book->id}}">{{$book->title}}</option>
            @endforeach
        </select>
        @error('books') <span class="invalid-feedback" role="alert">  <strong>{{ $message }}</strong> </span>
        @enderror

        <label>{{ ('About (Author)') }}</label>
        <select class="authors" name="authors[]" multiple>
            @foreach($authors as $author)
                <option value="{{$author->id}}">{{$author->name}}</option>
            @endforeach
        </select>
        @error('authors') <span class="invalid-feedback" role="alert">  <strong>{{ $message }}</strong> </span>
        @enderror
    </div>

    <div>
        <label>{{ ('Text') }}</label>
        <input id="text" type="text" name="text" value="{{ old('description') }}">

        @error('text')
        <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong> </span>
        @enderror
    </div>

    <div>
        <button type="submit">
            {{ ('Post') }}
        </button>
    </div>
</form>

@foreach($posts as $post )
    <div style="border:1px solid black">
        <label style="border:1px solid black"> Post {{$post->id}} : {{$post->text}} </label>

        {{--add reaction to the post--}}
        <form method="POST" action="{{ route('post.reaction.store', $post) }}">
            @csrf
            <div>
                {{--get the reactions type and display them--}}
                @foreach($reactions as $reaction)
                <button name="reaction_id" value="{{$reaction->id}}" type="submit"> {{$reaction->name}} </button>
                    {{--get number or each reaction type for each post in this group --}}
                    @foreach($posts_reactions as $post_reactions)
                        @if($post->id == $post_reactions->post_id)
                            @if($reaction->id == $post_reactions->reaction_id)
                                <span>{{$post_reactions->total_reactions}}</span>
                            @endif
                        @endif
                    @endforeach
                @endforeach
            </div>
        </form>
        {{--comments show for each post--}}
        @foreach($comments as $comment)
            @if($post->id == $comment->post_comments['0']->id)
                <label style="border:1px solid black"> comment text: {{$comment->text}} </label>
            @endif
        @endforeach
        {{--add coment to the post--}}
        <form method="POST" action="{{ route('post.comment', $post) }}">
            @csrf
            <div>
                <label>{{ ('text') }}</label>
                <input id="text" type="text" name="text" value="{{ old('text') }}">
                @error('text')
                <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong> </span>
                @enderror
            </div>
            <div> <button type="submit"> {{ ('COMMENT') }} </button> </div>
        </form>
    </div>
@endforeach


<script type="text/javascript">
    $(document).ready(function () {

        $(".books").chosen({width: "200px"});

    });
</script>

<script type="text/javascript">
    $(document).ready(function () {

        $(".authors").chosen({width: "200px"});

    });
</script>
