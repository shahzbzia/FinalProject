@extends('layouts.app')

@section('content')
<div class="container ">
    
    <div class="flex flex-wrap" id="lazyLoadedMarketPlace">
        
    </div>

</div>

<script>

    var page = 1;

    load_more(page);

    $(window).scroll(function() { 

      if($(window).scrollTop() + $(window).height() >= $(document).height()) {
          page++;
          load_more(page);
      }

    });     

    function load_more(page){

        $.ajax({

           url: '?page=' + page,
           type: "get",
           datatype: "html",

        })

        .done(function(data)
        {
            $("#lazyLoadedMarketPlace").append(data);      
            //console.log(data);
       })

       .fail(function(jqXHR, ajaxOptions, thrownError)
       {
          alert('No response from server. Please try again later.');
       });

    }

</script>
@endsection

