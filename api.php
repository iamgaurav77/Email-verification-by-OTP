<?php

  
  $api_url = 'https://api.nasa.gov/planetary/apod?api_key=zr1zBmBuBehN1QLa35ssmSaRYWZQlhN4aFr6JcML';
  $data =  file_get_contents($api_url);
  $obj = json_decode($data);
?>

<html>

<head>
	
	<style type="text/css">
		
		.heading{
			margin-left:580px;
			color:red;
		}

		.first{
			margin-left:500px;
		}

		.second{
			margin-left: 200px;
		}

	</style>

</head>

 <h1 class="heading">NASA blog</h1>	
 <h3> DATE:  <?php echo $obj->date;?> </h3>
 <h2 class="first"> TITLE:  <?php echo $obj->title;?> </h3>
<?php 
 echo '<img src= "'. $obj->url .'" class="second"/>'; ?>
<h2> INFO </h2> 
<h4><?php echo $obj->explanation;?></h4>
 <h3>
 	<p> By <?php echo $obj->copyright;?> </p>
    
 </h3>
</html>