@extends('layouts.app')

@section('content')
<div class="container">
    <div class="align-middle mx-auto mt-4 w-full lg:w-4/5 xl:w-4/5">

        <h2 class="text-2xl text-{{ Auth::user()->theme->value }}-500 font-bold tracking-widest uppercase font-mono mb-2 ml-4">Create a Post</h2>

        <div class="bg-white shadow-xl rounded-lg mt-2 px-8 pt-6 pb-8 mb-4">
            <ul class="flex flex-col md:flex-row lg:flex-row xl:flex-row items-center">
                <li class="flex-1 mt-1">
                    <button id="defaultOpen" class="tablinks px-24 md:px-16 lg:px-24 xl:px-24 text-center block border border-black rounded py-2 text-black focus:outline-none" onclick="openForm(event, 'image')">Image</button>
                </li>
                <li class="flex-1 mt-1">
                    <button class="tablinks px-24 md:px-16 lg:px-24 xl:px-24 text-center block border border-black rounded text-black py-2 focus:outline-none " onclick="openForm(event, 'audio')" >Audio</button>
                </li>
                <li class="flex-1 mt-1">
                    <button class="tablinks px-24 md:px-16 lg:px-24 xl:px-24 text-center block border border-black rounded text-black py-2 focus:outline-none " onclick="openForm(event, 'video')">Video</button>
                </li>
            </ul>
            
            <div id="image" class="row justify-content-center mt-4 tabcontent items-center">
                <form class="px-6 pt-6 pb-8 mb-4" method="POST" enctype="multipart/form-data" action="{{ route('image.createPost') }}">

                    @csrf

                    <div class="mb-4">

                        <label class="block text-gray-700 text-sm font-bold mb-2" for="title">
                            Title
                        </label>

                        <input id="title" type="text" class="shadow-md appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('title') bg-red-200 @enderror" name="title" value="{{ old('title') }}" required autocomplete="email" autofocus>

                        <div class="flex flex-col md:flex-row justify-between">
                            <div id="slugText">https://www.artillary.net/<span id="slugLink"></span></div>

                            <button type="button" class="text-{{ Auth::user()->theme->value }}-500" onclick="copyToClipboard('#slugText', '#slugLink')">Copy</button>
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

                        <input id="slug" type="text" class="shadow-md appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('slug') bg-red-200 @enderror" name="slug" value="{{ old('slug') }}" required autocomplete="slug" readonly autofocus>

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

                        <input id="mainImage" type="file" class="shadow-md appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('mainImage') bg-red-200 @enderror" name="mainImage" value="{{ old('image') }}" autofocus>

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
            </div>


            <div id="audio" class="row justify-content-center mt-4 tabcontent">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">Audio</div>

                        <div class="card-body text-green-500">
                            THIS IS THE AUDIO FORM
                        </div>
                    </div>
                </div>
            </div>


            <div id="video" class="row justify-content-center mt-4 tabcontent">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">Video</div>

                        <div class="card-body text-red-500">
                            THIS IS THE VIDEO FORM
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>
        
</div>

<script>

    document.getElementById("defaultOpen").click();

    function openForm(evt, formType) {
      // Declare all variables
      var i, tabcontent, tablinks;

      // Get all elements with class="tabcontent" and hide them
      tabcontent = document.getElementsByClassName("tabcontent");
      for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
      }

      // Get all elements with class="tablinks" and remove the class "active"
      tablinks = document.getElementsByClassName("tablinks");
      for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" bg-{{ Auth::user()->theme->value }}-500", "");
        tablinks[i].className = tablinks[i].className.replace(" text-white", "");
      }

      // Show the current tab, and add an "active" class to the button that opened the tab
      document.getElementById(formType).style.display = "block";
      evt.currentTarget.className += " bg-{{ Auth::user()->theme->value }}-500";
      evt.currentTarget.className += " text-white";
    }

    $(document).ready(function(){
        //tootltip bootstrap jquery
        $('[data-toggle="tooltip"]').tooltip(); 

        //hide/show sellable details
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
    //slug generator
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


@endsection