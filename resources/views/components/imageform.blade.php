<form class="px-6 pt-6 pb-8 mb-4" method="POST" enctype="multipart/form-data" action="{{ route('image.createPost') }}">

    @csrf

    <div class="mb-4">

        <label class="block text-gray-700 text-sm font-bold mb-2" for="title">
            Title
        </label>

        <input id="title" type="text" class="title shadow-md appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('title') bg-red-200 @enderror" name="title" value="{{ old('title') }}" required autocomplete="email" autofocus>

        <div class="flex flex-col md:flex-row justify-between">
            <div id="slugText" class="slugText">https://www.artillary.net/<span id="slugLink" class="slugLink"></span></div>

            <button type="button" class="text-{{ Auth::user()->theme->value }}-500" onclick="copyToClipboard('.slugText', '.slugLink')">Copy</button>
        </div>

        @error('email')
            <span class="text-red-500 text-xs italic" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror

    </div>

    <div class="mb-4 hidden">

        <label class="block text-gray-700 text-sm font-bold mb-2" for="slug">
            Slug
        </label>

        <input id="slug" type="text" class="slug shadow-md appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('slug') bg-red-200 @enderror" name="slug" value="{{ old('slug') }}" required autocomplete="slug" readonly autofocus>

        @error('slug')
            <span class="text-red-500 text-xs italic" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror

    </div>

    <div class="mb-4">

        <label class="block text-gray-700 text-sm font-semibold mb-2" for="description">

            Description

        </label>

        <textarea name="description" rows="2" cols="50" id="description" class="shadow-md appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('description') bg-red-200 @enderror" >{{ old('description') }} </textarea>

        @error('description')
            <span class="text-red-500 text-xs italic" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror

    </div>

    <div class="mb-4 w-full">

        <label class="block text-gray-700 text-sm font-bold mb-2" for="mainImage">
            Main Image
        </label>

        <input id="mainImage" type="file" class="shadow-md appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('mainImage') bg-red-200 @enderror" name="mainImage" value="{{ old('mainImage') }}" autofocus>

        @error('mainImage')
            <span class="text-red-500 text-xs italic" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror

    </div>

    <div class="mb-4 w-full ">

        <label class="block text-gray-700 text-sm font-bold mb-2" for="">
            Market Place
        </label>
        
        <input type="checkbox" id="sellable" name="sellable">
        <label for="sellable"> Would you like this post to be available on the market place?</label><br>

    </div>

    <div id="sellable_details">
        
        <div class="mb-4">

            <label class="block text-gray-700 text-sm font-bold mb-2" for="royaltyFee">
                Royalty Fee
            </label>

            <input id="royaltyFee" type="number" class="shadow-md appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('royaltyFee') bg-red-200 @enderror" name="royaltyFee" value="{{ old('royaltyFee') }}" required autocomplete="royaltyFee" autofocus>

            @error('royaltyFee')
                <span class="text-red-500 text-xs italic" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror

        </div>

        <div class="mb-4">

            <label class="block text-gray-700 text-sm font-bold mb-2" for="price">
                Price
            </label>

            <input id="price" type="number" class="shadow-md appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('price') bg-red-200 @enderror" name="price" value="{{ old('price') }}" required autocomplete="price" autofocus>

            @error('price')
                <span class="text-red-500 text-xs italic" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror

        </div>

        <div class="mb-4 w-full">

            <div class="flex">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="dContent">
                    Downloadable Content
                </label>

                <span data-toggle="tooltip" title="This is the place where you can put the downloadable content for the paying customers."><span class="bg-black rounded-full py-0 px-2 ml-2 text-white">?</span></span>
            </div>

            <input id="dContent" type="file" class="shadow-md appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('dContent') bg-red-200 @enderror" name="dContent" value="{{ old('dContent') }}" autofocus>

            @error('dContent')
                <span class="text-red-500 text-xs italic" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror

        </div>


    </div>

    

    <div class="flex items-center justify-between">

        <button class="hover:bg-gray-700 bg-black hover:text-gray-900 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
            Post
        </button>

    </div>

</form>

<script>
    $(document).ready(function(){
        //tootltip bootstrap jquery
        $('[data-toggle="tooltip"]').tooltip(); 

        //hide/show sellable details images
        $("#sellable_details").hide();
        $("#sellable_details :input").attr("disabled", true);

        $('#sellable').change(function() {
            if(this.checked) {
                $("#sellable_details").show();
                $("#sellable_details :input").attr("disabled", false);
            }else{
                $("#sellable_details").hide();
                $("#sellable_details :input").attr("disabled", true);
            }
        });
    });
</script>

<script>
    //slug generator image
    $('#title').change(function(e) {
        $.get('{{ route('posts.checkSlug') }}',
            {'title': $(this).val() },
            function(data){
                $('#slug').val(data.slug);
                $('#slugLink').html(data.slug);
            }
        );
    });
</script>

<script>
    // Copy to clipboard
    function copyToClipboard(element1, element2) {
      var $temp = $("<input>");
      $("body").append($temp);
      $temp.val($(element1).text()).select();
      document.execCommand("copy");
      $temp.remove();
    }

</script>