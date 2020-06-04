@extends('layouts.app')

@section('content')
<div class="container">

	<ul class="flex flex-col md:flex-row lg:flex-row xl:flex-row items-center">
	    <li class="flex-1 mt-1 lg:mr-10 lg:ml-5">
	        <button id="defaultOpenIssues" class="issue-tab-links px-32 md:px-32 lg:px-40 xl:px-40 text-center block border border-black rounded py-2 text-black focus:outline-none flex bg-{{ Auth::user()->theme->value }}-500" onclick="openIssue(event, 'unresolved')">
		  	  <p>Open Issues</p>
		  </button>

	    </li>
	    <li class="flex-1 mt-1">
	    	<button class="issue-tab-links px-32 md:px-32 lg:px-40 xl:px-40 text-center block border border-black rounded py-2 focus:outline-none bg-{{ Auth::user()->theme->value }}-500 text-black" onclick="openIssue(event, 'resolved')"> 
		  	<p>Resolved Issues</p>
	  </button>
	    </li>

	</ul>

	<div id="unresolved" class="issue-tab-content">
		@foreach ($issuesNotResolved as $issue)
			<a href="{{ route('issue.details', $issue->id) }}" class="hover:no-underline hover:text-black">
				<div class="h-100 w-full flex justify-center bg-teal-lightest font-sans">
					<div class="bg-white rounded shadow p-6 m-4 w-full lg:w-full">
				        <div class="mb-4 flex">
							
							@if (!$issue->resolved_at)
								<div class="mr-2">
					            	<svg class="fill-current text-red-500" viewBox="0 0 16 16" version="1.1" width="22" height="22" aria-hidden="true"><path fill-rule="evenodd" clip-rule="evenodd" d="M8 1.5C6.27609 1.5 4.62279 2.18482 3.40381 3.40381C2.18482 4.62279 1.5 6.27609 1.5 8C1.5 9.72391 2.18482 11.3772 3.40381 12.5962C4.62279 13.8152 6.27609 14.5 8 14.5C9.72391 14.5 11.3772 13.8152 12.5962 12.5962C13.8152 11.3772 14.5 9.72391 14.5 8C14.5 6.27609 13.8152 4.62279 12.5962 3.40381C11.3772 2.18482 9.72391 1.5 8 1.5ZM0 8C0 5.87827 0.842855 3.84344 2.34315 2.34315C3.84344 0.842855 5.87827 0 8 0C10.1217 0 12.1566 0.842855 13.6569 2.34315C15.1571 3.84344 16 5.87827 16 8C16 10.1217 15.1571 12.1566 13.6569 13.6569C12.1566 15.1571 10.1217 16 8 16C5.87827 16 3.84344 15.1571 2.34315 13.6569C0.842855 12.1566 0 10.1217 0 8ZM9 11C9 11.2652 8.89464 11.5196 8.70711 11.7071C8.51957 11.8946 8.26522 12 8 12C7.73478 12 7.48043 11.8946 7.29289 11.7071C7.10536 11.5196 7 11.2652 7 11C7 10.7348 7.10536 10.4804 7.29289 10.2929C7.48043 10.1054 7.73478 10 8 10C8.26522 10 8.51957 10.1054 8.70711 10.2929C8.89464 10.4804 9 10.7348 9 11ZM8.75 4.75C8.75 4.55109 8.67098 4.36032 8.53033 4.21967C8.38968 4.07902 8.19891 4 8 4C7.80109 4 7.61032 4.07902 7.46967 4.21967C7.32902 4.36032 7.25 4.55109 7.25 4.75V8.25C7.25 8.44891 7.32902 8.63968 7.46967 8.78033C7.61032 8.92098 7.80109 9 8 9C8.19891 9 8.38968 8.92098 8.53033 8.78033C8.67098 8.63968 8.75 8.44891 8.75 8.25V4.75Z"></path></svg>
					            </div>

					        @else
					        	<div class="mr-2">
					            	<svg class="fill-current text-green-600" viewBox="0 0 16 16" version="1.1" width="22" height="22" aria-hidden="true"><path fill-rule="evenodd" clip-rule="evenodd" d="M1.50001 8C1.49997 6.76578 1.85131 5.55706 2.51296 4.51518C3.1746 3.47331 4.1192 2.64134 5.2363 2.11656C6.35339 1.59179 7.59681 1.39591 8.82113 1.55182C10.0455 1.70774 11.2001 2.209 12.15 2.997C12.3034 3.11947 12.4987 3.1769 12.694 3.15698C12.8893 3.13706 13.069 3.04137 13.1945 2.89045C13.3201 2.73953 13.3814 2.54541 13.3654 2.34976C13.3494 2.15412 13.2574 1.97254 13.109 1.844C11.7815 0.74289 10.1337 0.100288 8.41121 0.0119901C6.68873 -0.0763082 4.98384 0.394426 3.5507 1.35402C2.11755 2.31361 1.0329 3.71067 0.458436 5.33693C-0.116025 6.96318 -0.149533 8.73155 0.36291 10.3784C0.875352 12.0253 1.9063 13.4624 3.30207 14.4756C4.69783 15.4888 6.38366 16.0238 8.10825 16.0008C9.83284 15.9778 11.5038 15.3981 12.8721 14.3481C14.2404 13.298 15.2326 11.8339 15.701 10.174C15.755 9.98251 15.7307 9.77743 15.6334 9.60386C15.5362 9.4303 15.374 9.30247 15.1825 9.2485C14.991 9.19453 14.7859 9.21883 14.6124 9.31607C14.4388 9.41331 14.311 9.57551 14.257 9.767C13.8316 11.2788 12.8732 12.5854 11.5591 13.4454C10.2449 14.3053 8.66385 14.6603 7.1082 14.4449C5.55254 14.2294 4.12751 13.458 3.09656 12.2732C2.06562 11.0885 1.49848 9.57051 1.50001 8V8ZM8.00001 12C8.26523 12 8.51958 11.8946 8.70712 11.7071C8.89466 11.5196 9.00001 11.2652 9.00001 11C9.00001 10.7348 8.89466 10.4804 8.70712 10.2929C8.51958 10.1054 8.26523 10 8.00001 10C7.7348 10 7.48044 10.1054 7.29291 10.2929C7.10537 10.4804 7.00001 10.7348 7.00001 11C7.00001 11.2652 7.10537 11.5196 7.29291 11.7071C7.48044 11.8946 7.7348 12 8.00001 12ZM8.00001 4C8.19893 4 8.38969 4.07902 8.53034 4.21967C8.671 4.36032 8.75001 4.55109 8.75001 4.75V8.25C8.75001 8.44891 8.671 8.63968 8.53034 8.78033C8.38969 8.92098 8.19893 9 8.00001 9C7.8011 9 7.61034 8.92098 7.46968 8.78033C7.32903 8.63968 7.25001 8.44891 7.25001 8.25V4.75C7.25001 4.55109 7.32903 4.36032 7.46968 4.21967C7.61034 4.07902 7.8011 4 8.00001 4ZM12.78 8.28L15.78 5.28C15.9125 5.13782 15.9846 4.94978 15.9812 4.75548C15.9778 4.56118 15.899 4.37579 15.7616 4.23838C15.6242 4.10096 15.4388 4.02225 15.2445 4.01882C15.0502 4.0154 14.8622 4.08752 14.72 4.22L12.25 6.69L11.28 5.72C11.2114 5.64631 11.1286 5.58721 11.0366 5.54622C10.9446 5.50523 10.8452 5.48318 10.7445 5.48141C10.6438 5.47963 10.5438 5.49816 10.4504 5.53588C10.357 5.5736 10.2722 5.62974 10.201 5.70096C10.1298 5.77218 10.0736 5.85701 10.0359 5.9504C9.99817 6.04379 9.97965 6.14382 9.98142 6.24452C9.9832 6.34522 10.0052 6.44454 10.0462 6.53654C10.0872 6.62854 10.1463 6.71134 10.22 6.78L11.72 8.28C11.8606 8.42045 12.0513 8.49934 12.25 8.49934C12.4488 8.49934 12.6394 8.42045 12.78 8.28V8.28Z"></path></svg>
					            </div>
							@endif

							<h1 class="text-black font-semibold text-lg">{{ $issue->subject }}</h1>
				        </div>
				        <div>
				        	<div class="flex mb-1 items-center">
				                <p class="w-full text-grey-darkest"><strong>Issue raised by: </strong>{{ $issue->user->firstName }} {{ $issue->user->lastName }} ({{ $issue->user->email }})</p>
				            </div>
				            <div class="flex mb-1 items-center">
				                <p class="w-full text-grey-darkest"><strong>Post Id: </strong>{{ $issue->post_id }}</p>
				            </div>
				            <div class="flex mb-1 items-center">
				                <p class="w-full text-grey-darkest"><strong>Order Id: </strong>{{ $issue->order_id }}</p>
				            </div>
				            <div class="flex mb-1 items-center">
				                <p class="w-full text-grey-darkest"><strong>Charge / Invoice Id: </strong>{{ $issue->charge_id }}</p>
				            </div>
				        </div>
				    </div>
				</div>
			</a>
		@endforeach

		<div class="flex justify-center">
			{{ $issuesNotResolved->links() }}
		</div>
	</div>

	<div id="resolved" class="issue-tab-content">
		@foreach ($issuesResolved as $issue)
			<a href="{{ route('issue.details', $issue->id) }}" class="hover:no-underline hover:text-black">
				<div class="h-100 w-full flex justify-center bg-teal-lightest font-sans">
					<div class="bg-white rounded shadow p-6 m-4 w-full lg:w-full">
				        <div class="mb-4 flex">
							
							@if (!$issue->resolved_at)
								<div class="mr-2">
					            	<svg class="fill-current text-red-500" viewBox="0 0 16 16" version="1.1" width="22" height="22" aria-hidden="true"><path fill-rule="evenodd" clip-rule="evenodd" d="M8 1.5C6.27609 1.5 4.62279 2.18482 3.40381 3.40381C2.18482 4.62279 1.5 6.27609 1.5 8C1.5 9.72391 2.18482 11.3772 3.40381 12.5962C4.62279 13.8152 6.27609 14.5 8 14.5C9.72391 14.5 11.3772 13.8152 12.5962 12.5962C13.8152 11.3772 14.5 9.72391 14.5 8C14.5 6.27609 13.8152 4.62279 12.5962 3.40381C11.3772 2.18482 9.72391 1.5 8 1.5ZM0 8C0 5.87827 0.842855 3.84344 2.34315 2.34315C3.84344 0.842855 5.87827 0 8 0C10.1217 0 12.1566 0.842855 13.6569 2.34315C15.1571 3.84344 16 5.87827 16 8C16 10.1217 15.1571 12.1566 13.6569 13.6569C12.1566 15.1571 10.1217 16 8 16C5.87827 16 3.84344 15.1571 2.34315 13.6569C0.842855 12.1566 0 10.1217 0 8ZM9 11C9 11.2652 8.89464 11.5196 8.70711 11.7071C8.51957 11.8946 8.26522 12 8 12C7.73478 12 7.48043 11.8946 7.29289 11.7071C7.10536 11.5196 7 11.2652 7 11C7 10.7348 7.10536 10.4804 7.29289 10.2929C7.48043 10.1054 7.73478 10 8 10C8.26522 10 8.51957 10.1054 8.70711 10.2929C8.89464 10.4804 9 10.7348 9 11ZM8.75 4.75C8.75 4.55109 8.67098 4.36032 8.53033 4.21967C8.38968 4.07902 8.19891 4 8 4C7.80109 4 7.61032 4.07902 7.46967 4.21967C7.32902 4.36032 7.25 4.55109 7.25 4.75V8.25C7.25 8.44891 7.32902 8.63968 7.46967 8.78033C7.61032 8.92098 7.80109 9 8 9C8.19891 9 8.38968 8.92098 8.53033 8.78033C8.67098 8.63968 8.75 8.44891 8.75 8.25V4.75Z"></path></svg>
					            </div>

					        @else
					        	<div class="mr-2">
					            	<svg class="fill-current text-green-600" viewBox="0 0 16 16" version="1.1" width="22" height="22" aria-hidden="true"><path fill-rule="evenodd" clip-rule="evenodd" d="M1.50001 8C1.49997 6.76578 1.85131 5.55706 2.51296 4.51518C3.1746 3.47331 4.1192 2.64134 5.2363 2.11656C6.35339 1.59179 7.59681 1.39591 8.82113 1.55182C10.0455 1.70774 11.2001 2.209 12.15 2.997C12.3034 3.11947 12.4987 3.1769 12.694 3.15698C12.8893 3.13706 13.069 3.04137 13.1945 2.89045C13.3201 2.73953 13.3814 2.54541 13.3654 2.34976C13.3494 2.15412 13.2574 1.97254 13.109 1.844C11.7815 0.74289 10.1337 0.100288 8.41121 0.0119901C6.68873 -0.0763082 4.98384 0.394426 3.5507 1.35402C2.11755 2.31361 1.0329 3.71067 0.458436 5.33693C-0.116025 6.96318 -0.149533 8.73155 0.36291 10.3784C0.875352 12.0253 1.9063 13.4624 3.30207 14.4756C4.69783 15.4888 6.38366 16.0238 8.10825 16.0008C9.83284 15.9778 11.5038 15.3981 12.8721 14.3481C14.2404 13.298 15.2326 11.8339 15.701 10.174C15.755 9.98251 15.7307 9.77743 15.6334 9.60386C15.5362 9.4303 15.374 9.30247 15.1825 9.2485C14.991 9.19453 14.7859 9.21883 14.6124 9.31607C14.4388 9.41331 14.311 9.57551 14.257 9.767C13.8316 11.2788 12.8732 12.5854 11.5591 13.4454C10.2449 14.3053 8.66385 14.6603 7.1082 14.4449C5.55254 14.2294 4.12751 13.458 3.09656 12.2732C2.06562 11.0885 1.49848 9.57051 1.50001 8V8ZM8.00001 12C8.26523 12 8.51958 11.8946 8.70712 11.7071C8.89466 11.5196 9.00001 11.2652 9.00001 11C9.00001 10.7348 8.89466 10.4804 8.70712 10.2929C8.51958 10.1054 8.26523 10 8.00001 10C7.7348 10 7.48044 10.1054 7.29291 10.2929C7.10537 10.4804 7.00001 10.7348 7.00001 11C7.00001 11.2652 7.10537 11.5196 7.29291 11.7071C7.48044 11.8946 7.7348 12 8.00001 12ZM8.00001 4C8.19893 4 8.38969 4.07902 8.53034 4.21967C8.671 4.36032 8.75001 4.55109 8.75001 4.75V8.25C8.75001 8.44891 8.671 8.63968 8.53034 8.78033C8.38969 8.92098 8.19893 9 8.00001 9C7.8011 9 7.61034 8.92098 7.46968 8.78033C7.32903 8.63968 7.25001 8.44891 7.25001 8.25V4.75C7.25001 4.55109 7.32903 4.36032 7.46968 4.21967C7.61034 4.07902 7.8011 4 8.00001 4ZM12.78 8.28L15.78 5.28C15.9125 5.13782 15.9846 4.94978 15.9812 4.75548C15.9778 4.56118 15.899 4.37579 15.7616 4.23838C15.6242 4.10096 15.4388 4.02225 15.2445 4.01882C15.0502 4.0154 14.8622 4.08752 14.72 4.22L12.25 6.69L11.28 5.72C11.2114 5.64631 11.1286 5.58721 11.0366 5.54622C10.9446 5.50523 10.8452 5.48318 10.7445 5.48141C10.6438 5.47963 10.5438 5.49816 10.4504 5.53588C10.357 5.5736 10.2722 5.62974 10.201 5.70096C10.1298 5.77218 10.0736 5.85701 10.0359 5.9504C9.99817 6.04379 9.97965 6.14382 9.98142 6.24452C9.9832 6.34522 10.0052 6.44454 10.0462 6.53654C10.0872 6.62854 10.1463 6.71134 10.22 6.78L11.72 8.28C11.8606 8.42045 12.0513 8.49934 12.25 8.49934C12.4488 8.49934 12.6394 8.42045 12.78 8.28V8.28Z"></path></svg>
					            </div>
							@endif

							<h1 class="text-black font-semibold text-lg">{{ $issue->subject }}</h1>
				        </div>
				        <div>
				        	<div class="flex mb-1 items-center">
				                <p class="w-full text-grey-darkest"><strong>Issue raised by: </strong>{{ $issue->user->firstName }} {{ $issue->user->lastName }} ({{ $issue->user->email }})</p>
				            </div>
				            <div class="flex mb-1 items-center">
				                <p class="w-full text-grey-darkest"><strong>Post Id: </strong>{{ $issue->post_id }}</p>
				            </div>
				            <div class="flex mb-1 items-center">
				                <p class="w-full text-grey-darkest"><strong>Order Id: </strong>{{ $issue->order_id }}</p>
				            </div>
				            <div class="flex mb-1 items-center">
				                <p class="w-full text-grey-darkest"><strong>Charge / Invoice Id: </strong>{{ $issue->charge_id }}</p>
				            </div>
				        </div>
				    </div>
				</div>
			</a>
		@endforeach

		<div class="flex justify-center">
			{{ $issuesResolved->links() }}
		</div>
	</div>

</div>

<script>
document.getElementById("defaultOpenIssues").click();

function openIssue(evt, issueType) {
  // Declare all variables
  var i, issuetabcontent, issuetablinks;

  // Get all elements with class="issuetabcontent" and hide them
  issuetabcontent = document.getElementsByClassName("issue-tab-content");
  for (i = 0; i < issuetabcontent.length; i++) {
    issuetabcontent[i].style.display = "none";
  }

  // Get all elements with class="issuetablinks" and remove the class "active"
  issuetablinks = document.getElementsByClassName("issue-tab-links");
  for (i = 0; i < issuetablinks.length; i++) {
    issuetablinks[i].className = issuetablinks[i].className.replace(" bg-{{ Auth::user()->theme->value }}-500", "");
    issuetablinks[i].className = issuetablinks[i].className.replace(" text-white", "");
  }

  // Show the current tab, and add an "active" class to the button that opened the tab
  document.getElementById(issueType).style.display = "block";
  evt.currentTarget.className += " bg-{{ Auth::user()->theme->value }}-500";
  evt.currentTarget.className += " text-white";
}
</script>
@endsection