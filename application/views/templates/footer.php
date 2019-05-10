<!-- Bootstrap core JavaScript -->
    <script src="<?php echo base_url(); ?>/assets_front/vendor/jquery/jquery.min.js"></script>
    <script src="<?php echo base_url(); ?>/assets_front/vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Menu Toggle Script -->
    <script>
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
    });

    $(document).ready(function() {
	// get current URL path and assign 'active' class
	var home = 'http://encoderslab.com';
	var pathname = window.location.pathname;
	var pathname = home + pathname;
	console.log(pathname);
	$('.nav > li > a[href="'+pathname+'"]').parent().addClass('active');
})
    </script>

</body>

</html>