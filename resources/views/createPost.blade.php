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
                    <button class="tablinks px-24 md:px-16 lg:px-24 xl:px-24 text-center block border border-black rounded text-black py-2 focus:outline-none " onclick="openForm(event, 'video')">Video</button>
                </li>
                <li class="flex-1 mt-1">
                    <button class="tablinks px-24 md:px-16 lg:px-24 xl:px-24 text-center block border border-black rounded text-black py-2 focus:outline-none " onclick="openForm(event, 'audio')" >Audio</button>
                </li>
            </ul>
            
            <div id="image" class="row justify-content-center mt-4 tabcontent items-center">
                
                <x-imageform/>

            </div>

            <div id="video" class="row justify-content-center mt-4 tabcontent">
                
                <x-videoform/>

            </div>


            <div id="audio" class="row justify-content-center mt-4 tabcontent">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">Audio</div>

                        <div class="card-body text-red-500">
                            THIS IS THE AUDIO FORM
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

<script>
    // Copy to clipboard
    // function copyToClipboard(element1, element2) {
    //   var $temp = $("<input>");
    //   $("body").append($temp);
    //   $temp.val($(element1).text()).select();
    //   document.execCommand("copy");
    //   $temp.remove();
    // }

</script>


@endsection