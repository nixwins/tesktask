	
<?php

defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Almaty');
?>

<body>
 	<div class="row">	
		<div class="col-xs-12">
			<?php if($page == 'index'){?>
			<?php foreach($news as $news_item):?>
				<div class="col-sm-6 col-md-4">
				    <div class="thumbnail">
				      <div class="caption">
				        <h3><a href="/news/<?php echo $news_item['id']?>"><?php echo $news_item['title']?></a></h3>
				        <p><?php echo $news_item['preview']?></p>
				        <p><a href="#" class="btn btn-primary" role="button">Читать дальше...</a></p>
				      </div>
				    </div>
				 </div>
			
			<?php endforeach;	?>
			<?php } else if($page == 'onenews'){ ?>
				
				<div class="col-xs-10"> 
					<h3> <?php echo $news[0]['title']; ?> </h3>
					<p> 
						<?php echo $news[0]['body']; 	?>
						
					</p>
					<div class="artInfo">Автор: <?php echo "Tester " ;?><span ><?php echo date('d-m-y', $news[0]['date']) . " Просмотров: " . $news[0]['count'] . " " ;?></span></div>
				
				</div>
			<?php } ?>
		</div>
		
  </div>	
	
      
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js">
    </script>
    <script src="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/js/bootstrap.min.js"></script>
    <script type="text/javascript">
    	$( document ).ready(function() {
  			//alert('dfsdf');	
		});
    </script>
</body>

</html>
