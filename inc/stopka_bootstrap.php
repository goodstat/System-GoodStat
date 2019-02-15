	<!-- automatic close alert -->
	<script type="text/javascript">
		$(".alert").fadeTo(8000, 500).slideUp(500, function(){
			$(".alert").slideUp(500);
		});
	</script>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    
   <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>	
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

	<!-- tooltip -->
	<script>
		$(document).ready(function(){
			$('[data-toggle="tooltip"]').tooltip(); 
		});
	</script>
	<script src="js/prism.js"></script>
	
	<script>
/*
		//animacja menu po najechaniu myszką
	  $('.navbar .dropdown').hover(function() {
		$(this).find('.dropdown-menu').first().stop(true, true).slideToggle(200);
		}, function() {
		$(this).find('.dropdown-menu').first().stop(true, true).slideToggle(200)
		});

*/
		// animacja menu po kliknieciu
		$('.dropdown').on('show.bs.dropdown', function(e){
			var $dropdown = $(this).find('.dropdown-menu');
			var orig_margin_top = parseInt($dropdown.css('margin-top'));
			$dropdown.css({'margin-top': (orig_margin_top + 10) + 'px', opacity: 0}).animate({'margin-top': orig_margin_top + 'px', opacity: 1}, 300, function(){
				$(this).css({'margin-top':''});
			});
		});

		$('.dropdown').on('hide.bs.dropdown', function(e){
			var $dropdown = $(this).find('.dropdown-menu');
			var orig_margin_top = parseInt($dropdown.css('margin-top'));
			$dropdown.css({'margin-top': orig_margin_top + 'px', opacity: 1, display: 'block'}).animate({'margin-top': (orig_margin_top + 10) + 'px', opacity: 0}, 300, function(){
				$(this).css({'margin-top':'', display:''});
			});
		});

	</script>
	
	<!-- top-link -->
	<span id="top-link-block" class="hidden">
		<a href="#top" class="btn well-sm top"  onclick="$('html,body').animate({scrollTop:0},'slow');return false;" title="przejdź na górę">
			<i class="material-icons">arrow_upward</i>
		</a>
	</span>	
	<script>
		if ( ($(window).height() + 100) < $(document).height() ) {
			$('#top-link-block').removeClass('hidden').affix({
			offset: {top:100}
		});
		}
	</script>
	<!--/ top-link -->	