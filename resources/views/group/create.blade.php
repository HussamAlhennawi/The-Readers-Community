<head>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.5/chosen.jquery.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.5/chosen.css" rel="stylesheet" type="text/css">
</head>

<form method="POST" action="{{ route('group.store') }}">
    @csrf
    <input type="hidden" id="user_id" name="user_id" value={{Auth::user()->id}}>
    <div>
        <label>{{ ('GROUP Title') }}</label>
        <input id="title" type="text" name="title" value="{{ old('title') }}" autofocus>
        @error('title')
        <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong> </span>
        @enderror
    </div>


    <div>
        <label>{{ ('GROUP Privacy') }}</label>
        <select class="privacy" id="privacy" name="privacy" class="form-control">
            <option value="public">Public (seen by all readers)</option>
            <option value="private">Private (only members can see group content)</option>
        </select>
        @error('privacy') <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong> </span>
        @enderror
    </div>


    <div>
        <label>{{ ('Description') }}</label>
        <input id="description" type="text" name="description" value="{{ old('description') }}">
        @error('description')
        <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong> </span>
        @enderror
    </div>

    <div>

        <label>{{ ('Cover Image') }}</label>
        <input id="cover_image" type="file" accept=".jpg" name="cover_image" value="{{ old('cover_image') }}">

        @error('cover_image')
        <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong> </span>
        @enderror
    </div>

    <div>
        <button type="submit">
            {{ ('ADD') }}
        </button>
    </div>

</form>

<script type="text/javascript">
    $(document).ready(function () {

        $(".privacy").chosen({width: "300px", disable_search_threshold: 10});

    });
</script>
