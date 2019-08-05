@extends('layouts.app')

@section('content')
<div class="container">
	<h1>Laravel 5.7 AJAX Pagination Example</h1>

	<div id="tag_container">
	    @include('presult')
	</div>
</div>
@endsection

@push('custom_script')
<script>
	$(window).on('hashchange', function() { // Execute a JavaScript when the anchor part has been changed
		if(window.location.hash) {
			var page = window.location.hash.replace('#', '');

			if(page == Number.NaN || page <= 0) {
				return false
			}else {
				getData(page)
			}
		}
	});

	$(document).ready(function () {
		$(document).on('click', '.pagination a', function(event) {
			event.preventDefault()

			$('li').removeClass('active')
			$(this).parent('li').addClass('active')

			var myurl = $(this).attr('href')
			var page = $(this).attr('href').split('page=')[1]

			getData(page)
		})
	})

	function getData(page) {
		$.ajax({
			url:'?page=' + page,
			type:'get',
			dataType:'html'
		}).done(function(data) {
			$('#tag_container').empty().html(data)
			location.hash = page
		}).fail(function(jqXHR, ajaxOptions, thrownError) {
			alert('No response from server')
		})
	}
</script>
@endpush