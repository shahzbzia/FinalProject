@extends('layouts.app')

@section('content')
<div class="container">
    <div class="align-middle mx-auto mt-4 w-full lg:w-4/5 xl:w-4/5">

        <h2 class="text-2xl text-{{ Auth::user()->theme->value }}-500 font-bold tracking-widest uppercase font-mono mb-2 ml-4">Create a Post</h2>

        <div class="bg-white shadow-xl rounded-lg mt-2 px-8 pt-6 pb-8 mb-4">
            <ul class="flex flex-col md:flex-row lg:flex-row xl:flex-row items-center">
                <li class="flex-1 mt-1 lg:mr-10">
                    <button id="defaultOpen" class="tablinks px-24 md:px-24 lg:px-32 xl:px-32 text-center block border border-black rounded py-2 text-black focus:outline-none flex" onclick="openForm(event, 'image')">
                        <svg class="mr-2" xmlns="http://www.w3.org/2000/svg" width="23" height="23" viewBox="0 0 24 24"><path d="M5 4h-3v-1h3v1zm8 6c-1.654 0-3 1.346-3 3s1.346 3 3 3 3-1.346 3-3-1.346-3-3-3zm11-5v17h-24v-17h5.93c.669 0 1.293-.334 1.664-.891l1.406-2.109h8l1.406 2.109c.371.557.995.891 1.664.891h3.93zm-19 4c0-.552-.447-1-1-1s-1 .448-1 1 .447 1 1 1 1-.448 1-1zm13 4c0-2.761-2.239-5-5-5s-5 2.239-5 5 2.239 5 5 5 5-2.239 5-5z"/></svg>
                        <p>Image</p>
                    </button>
                </li>
                <li class="flex-1 mt-1">
                    <button class="tablinks px-24 md:px-24 lg:px-32 xl:px-32 text-center block border border-black rounded text-black py-2 focus:outline-none flex" onclick="openForm(event, 'video')">
                        <svg class="mr-2" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M16 16c0 1.104-.896 2-2 2h-12c-1.104 0-2-.896-2-2v-8c0-1.104.896-2 2-2h12c1.104 0 2 .896 2 2v8zm8-10l-6 4.223v3.554l6 4.223v-12z"/></svg>
        
                        <p>Video</p>
                </button>
                </li>

            </ul>
            
            <div id="image" class="row justify-content-center mt-4 tabcontent items-center">
                
                <x-imageform/>

            </div>

            <div id="video" class="row justify-content-center mt-4 tabcontent">
                
                <x-videoform/>

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



</script>

<script>

    //slug generator image
    $('#titleVid').change(function(e) {
        $.get('{{ route('posts.checkSlug') }}',
            {'title': $(this).val() },
            function(data){
                $('#slugVid').val(data.slug);
                $('#slugLinkVid').html(data.slug);
            }
        );
    });
</script>


@endsection