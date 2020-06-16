<div class="@auth w-full mb-6 @else w-full md:w-4/5 @endauth border h-full mt-8 rounded-lg align-middle mx-auto ">

	<div class="relative">
		<img src="images/summer-games.jpg" alt="">

		<div class="flex md:w-96 lg:w-156 items-center border-b-2 border-black py-2 absolute top-0 md:my-10 lg:my-24 ml-20 md:ml-44 lg:ml-83"> 
	        <input class="searchInput bg-transparent border-none w-full text-black mr-3 py-1 px-2 leading-tight focus:outline-none placeholder-black md:font-semibold md:text-base" name="nameSearch" id="postSearch" type="text" placeholder="Search for Posts and Products">
	        <div id="postList" class="dropdown-nameSearch text-base rounded-lg py-2"></div>
	   	</div>
	</div>
	
</div>

<script>
	$(document).ready(function(){

	var widthPostSearchBox = $('#postSearch').width();


    $('#postSearch').keyup(function(){
      //console.log('keyup');
      var query = $(this).val();
      if(query != '')
      {
        var _token = $('input[name="_token"]').val();
      }
      $.ajax({
        url:"{{ route('postSearch') }}",
        method: "POST",
        data: {query:query, _token:_token},
        success:function(data){
          $('#postList').width(widthPostSearchBox)
          $('#postList').fadeIn();
          $('#postList').html(data);
          $(document).on('click', function(e) {
            if ( ! $(e.target).closest('#postList').length ) {
              $('#postList').hide();
            }
          })
        }
      })

    });

  });
</script>