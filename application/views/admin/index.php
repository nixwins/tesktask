<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once BASEPATH . '/helpers/url_helper.php';
?>

<!doctype html>
<html>
	<head>
		<title> <?php //echo $titlePage; ?></title>
		<link href="<?php echo base_url("assets/css/bootstrap.min.css"); ?>" rel="stylesheet"  />
		<link href="<?php echo base_url("assets/css/main.css"); ?>" rel="stylesheet"  />
		<script type="text/javascript">
			function deleteNewsById(){}
		</script>
	</head>
	
	<body>
		<div class="container">
			<div class="row">	
				<div class="col-xs-4">
					<ul class="nav nav-pills nav-stacked">
  						<li class="active"><a href="<?php echo base_url('admin')?>">Главная</a></li>
  						<li><a href="/admin/show/add/newsform">Добавить новость</a></li>
  						<li><a href="/admin/show/add/userform">Добавить пользователя</a></li>
					</ul>
				</div>
				<div class="col-xs-8">
					
					<?php if($page == 'index') {?>
						
					<h2> Список новостей</h2>
					 <table class="table table-hover ">
			  		
			  			<tr>
			  				<th>Загаловок</th>
			  				<th>Текст</th>
			  				<th>Редактировать</th>
			  			</tr>
			  			
			  			<?php foreach($news as $news_item):?>
			  				
			  			<tr>
			  				<td> <?php echo $news_item['title']; ?></td>
			  				<td><?php echo $news_item['preview']; ?></td>
			  				<td class="edittd">
								<button id="delete_btn<?php echo $news_item['id']; ?>" type="button" onclick="deleteNewsById(this)" class="btn btn-danger" value="<?php echo $news_item['id']; ?>">Удалить</button>
			  					<a  class="btn btn-warning" href="/admin/showupdate/news/<?php echo $news_item['id']; ?>">Редактировать</a>
			  				</td>
			  				
			  			</tr>
			  			
			  			<?php endforeach; ?>
			  			
					</table>
					
					<?php
						} else if($page == 'updatenews'){
							$news = $news[0];
							$attr_preview = array(
							        'name'          => 'preview',
							        'id'            => 'preview',
							        'value'         => $news['preview'],
							        'class'         => 'form-control',
							        'rows'			=>	2	
							);
							$attr_title = array(
									'name'          => 'title',
							        'id'            => 'title',
							        'value'         => $news['title'],
							        'class'         => 'form-control title',
							        'rows'			=>	2	
							);
							$attr_saveBtn = array(
									'name'          => 'saveBtn',
							        'id'            => 'saveBtn',
							        'value'         => 'Сохранить',
							        'class'         => 'btn btn-success',
							        
							);
							//$hidden = array('news_id' => $news['id']);
							echo "<h2>Редактировать новость</h2>";
							echo form_open(base_url('admin/update/news'), '');
							echo form_hidden('news_id', $news['id']);
							echo '<div class="form-group">';
							echo form_input($attr_title);
							echo '</div>';
							echo '<div class="form-group">';
							echo form_textarea($attr_preview);
							echo '</div>';
							echo '<div class="form-group">';
							echo $this->ckeditor->editor("newsbody", $news['body'], ['id'=>'newsbody', 'class'=>'newsbody']);
							echo '</div>';
							echo '<div class="text-success" id="successSaving" "></div>';
							echo '	<div class="text-danger" id="errorSaving"></div>';
							echo '<div class="form-group">';
							echo form_button($attr_saveBtn, 'Сохранить');
							echo '</div>';
							echo form_close();
							
					} else if($page == 'adduser'){
						
							$attr_username = array(
									'name'          => 'username',
							        'id'            => 'username',
							        'class'         => 'form-control title'
							 
							);
							$attr_email = array(
									'name'          => 'email',
							        'id'            => 'email',
							        'class'         => 'form-control title'
							 
							);
							$attr_password= array(
									'name'          => 'password',
							        'id'            => 'password',
							        'class'         => 'form-control title'
							 
							);
							$attr_saveBtn = array(
									'name'          => 'addUserBtn',
							        'id'            => 'addUserBtn',
							        'value'         => 'Добавить',
							        'class'         => 'btn btn-success',
							        
							);
							
							echo form_open();
							echo '<label for="username">Имя пользователя</label>';
							echo form_input($attr_username);
							echo '<label for="email">Email адресс</label>';
							echo form_input($attr_email);
							echo '<label for="password">Пароль</label>';
							echo form_password($attr_password);
							echo '<div class="text-success" id="successSaving" "></div>';
							echo '	<div class="text-danger" id="errorSaving"></div>';
							echo form_button($attr_saveBtn, 'Сохранить');
							echo form_close();
					} else if($page == 'addnews')
					{
						
							$attr_preview = array(
							        'name'          => 'preview',
							        'id'            => 'preview',
							        'value'         => '',
							        'class'         => 'form-control',
							        'rows'			=>	2	
							);
							$attr_title = array(
									'name'          => 'title',
							        'id'            => 'title',
							        'value'         =>  '',
							        'class'         => 'form-control title',
							        'rows'			=>	2	
							);
							$attr_saveBtn = array(
									'name'          => 'addNewsBtn',
							        'id'            => 'addNewsBtn',
							        'value'         => 'Сохранить',
							        'class'         => 'btn btn-success',
							        
							);
							//$hidden = array('news_id' => $news['id']);
							echo "<h2>Добавить новость</h2>";
							echo form_open(base_url('admin/update/news'), '');
							echo '<div class="form-group">';
							echo form_input($attr_title);
							echo '</div>';
							echo '<div class="form-group">';
							echo form_textarea($attr_preview);
							echo '</div>';
							echo '<div class="form-group">';
							echo $this->ckeditor->editor("newsbody", '', ['id'=>'newsbody', 'class'=>'newsbody']);
							echo '</div>';
							echo '<div class="text-success" id="successSaving" "></div>';
							echo '	<div class="text-danger" id="errorSaving"></div>';
							echo '<div class="form-group">';
							echo form_button($attr_saveBtn, 'Сохранить');
							echo '</div>';
							echo form_close();
					}		
					
					?>
				
					
				</div>	
			</div>
			
			
		</div>
		
		<script type="text/javascript" src="<?php base_url('/asset/ckeditor/ckeditor.js');?>"></script>
		<script type="text/javascript" src="<?php base_url('/asset/ckfinder/ckfinder.js');?>"></script>
		<script type="text/javascript" src="<?php echo base_url("assets/js/jquery-2.1.4.min.js"); ?>"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js" type="text/javascript"></script>
		<script type="text/javascript" src="<?php echo base_url("assets/js/bootstrap.min.js"); ?>"></script>
		
		<script type="text/javascript">
		$('#addNewsBtn').click(function() {
			
			var title 	  	= $("#title").val();
			var preview  	= $("#preview").val();
    		var textBody	= CKEDITOR.instances.newsbody.getData();
    		var route		= '<?php echo base_url("admin/add/news"); ?>';
    		var errorUpdate	= document.getElementById( "errorSaving" );
		  	var printSuccess 	    = document.getElementById( "successSaving" );
		  	
    		$.ajax({
    			url:route,
    			type:'POST',
    			data:{title:title, preview:preview, textBody:textBody},
    			success:function(data){
    				
    				errorUpdate.innerHTML = '';
			  		printSuccess.innerHTML = 'Новость добавлен';
			  		$("#successSaving").show();
			  		//$( "#successSaving" ).css('position', 'absolute', 'bottom', '500px', 'right', '25px');
			  		setTimeout(function() { $("#successSaving").hide('slow'); }, 2000);
    			},
    			error: function(xhr,err){
						 			
				   alert("readyState: "+xhr.readyState+"\nstatus: "+xhr.status);
				   	alert("responseText: "+xhr.responseText);
				    printSuccess.innerHTML = '';
		  			errorUpdate.innerHTML = 'Что-то произашло не так';
				}
    		});
    		
   			console.log(title);
		});
		$('#addUserBtn').click(function() {
			
			var username			=  $('#username').val();
			var email 				= $('#email').val();
			var password			=  $('#password').val();
    		var route				= '<?php echo base_url("admin/add/user"); ?>';
    		var errorAddinguser		= document.getElementById( "errorSaving" );
		  	var printSuccess 	    = document.getElementById( "successSaving" );
		  	console.log(username + password + email);
		
    		$.ajax({
    			url:route,
    			type:'POST',
    			dataType:'json',
    			data:{username:username, email:email, password:password},
    			success:function(data){
    				
    				if(data.username == true)
    				{
    				
    					errorAddinguser.innerHTML = 'Имя пользователя занять';
			  		
			  			
    				}else if(data.email == true)
    				{
    					
    					errorAddinguser.innerHTML = 'Email адресс занять';
			  		
    				}else if(data.mustFill == true)
    				{
    					errorAddinguser.innerHTML = 'все поля обязательно должны заполнены';
    				}
    				else if(data.added == true)
    				{
	    				$("#username").value = '';
	    				errorAddinguser.innerHTML = '';
				  		printSuccess.innerHTML = 'Пользователь добавлен';
				  		$("#successSaving").show();
				  		//$( "#successSaving" ).css('position', 'absolute', 'bottom', '500px', 'right', '25px');
				  		setTimeout(function() { $("#successSaving").hide('slow'); }, 1000);
			  		}
			  		console.log(data);
    			},
    			error: function(xhr,err){
						 			
				   alert("readyState: "+xhr.readyState+"\nstatus: "+xhr.status);
				    alert("responseText: "+xhr.responseText);
				    printSuccess.innerHTML = '';
		  			errorAddinguser.innerHTML = 'Что-то произашло не так';
				}
    		});
    		
   			//console.log(title);
		});
		$('#saveBtn').click(function() {
			
			var news_id		= $("input[name=news_id]").val();
			var title 	  	= $("#title").val();
			var preview  	= $("#preview").val();
    		var textBody	= CKEDITOR.instances.newsbody.getData();
    		var route		= '<?php echo base_url("admin/update/news"); ?>';
    		var errorUpdate	= document.getElementById( "errorSaving" );
		  	var printSuccess 	    = document.getElementById( "successSaving" );
		  	
    		$.ajax({
    			url:route,
    			type:'POST',
    			data:{news_id:news_id, title:title, preview:preview, textBody:textBody},
    			success:function(data){
    				
    				errorUpdate.innerHTML = '';
			  		printSuccess.innerHTML = 'Новость обнавлен';
			  		$("#successSaving").show();
			  		//$( "#successSaving" ).css('position', 'absolute', 'bottom', '500px', 'right', '25px');
			  		setTimeout(function() { $("#successSaving").hide('slow'); }, 1000);
    			},
    			error: function(xhr,err){
						 			
				   // alert("readyState: "+xhr.readyState+"\nstatus: "+xhr.status);
				    //alert("responseText: "+xhr.responseText);
				    printSuccess.innerHTML = '';
		  			errorUpdate.innerHTML = 'Что-то произашло не так';
				}
    		});
    		
   			console.log(title);
		});
		
		function deleteNewsById(clickedBtn){
			
			var cat_id 		=  clickedBtn.value;
			var route 		= "http://test.loc/admin/delete/news" + "/" + cat_id;
			console.log(clickedBtn.value);
			$.ajax({
			  url: route,
			  type: 'GET',
			  success:  function(data){
			  	
					console.log('clickedBtn');
					deleteRow = clickedBtn;
					deleteRow.closest('tr').remove();
				 	 
		 		},
		 		error: function(xhr,err){
						 			
				    alert("readyState: "+xhr.readyState+"\nstatus: "+xhr.status);
				    alert("responseText: "+xhr.responseText);
				}
			 
			});
		}		


		
		
		
	</script>
	</body>
	
</html>