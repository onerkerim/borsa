<script src="http://weborsa.herokuapp.com:<?php echo $socketIoPort; ?>/socket.io/socket.io.js"></script>
<script src="assets/js/jquery-3.3.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js?v=1"></script>
<?php if(isset($ajaxContent)) 
{ 
	if(is_array($ajaxContent))
	{
	echo $ajaxContent[0];
	echo $ajaxContent[1];
	}
	else
	{
		echo $ajaxContent;
	}
} ?>
</body>
</html>