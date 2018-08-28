<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Hotels</title>
	<?php 
		  $config = Config::singleton();
	?>
    <link href=<?php print($config->get('public') . '/css/app.css'); ?> rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">

                    
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                  
                    <a class="navbar-brand" href='/'">
                        search
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                   
                    <ul class="nav navbar-nav">
                        &nbsp;
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                    	  <?php
                            if (!(isset($_SESSION['login']) && $_SESSION['login'] != '')) {
                    	 		 header ("Location: login.php");
                            }else{
                            	 $url = ($config->get('app'));
                            	 echo "<li><a href='".$config->get('app')."?action=logout'>Logout</a></li>";
                    	 	}
                    	 ?>
                    </ul>
                </div>
            </div>
        </nav>
        <div class="container">
		    <!-- SECTION SEARCH HOTEL  -->
		    <div class="row">
				<div class="panel panel-info">
					  <div class="panel-heading">
					    <h3 class="panel-title">Filters</h3>
					  </div>
					  <div class="panel-body">
					  	<div class="container">
					  		<form id="frm_searchHotel" method="GET" action=<?php print($config->get('app')); ?>>
					  		   <input type="hidden" name="action" value="searchHotel">
					  		   <input type="hidden" name="controller" value="hotel">
						       <div class="col-md-2">
									<label>Guests</label>
								</div>
								<div class="col-md-3">
									<input type="text" class="form-control" id="guests" name="guests" value=<?php if(isset($_GET['guests'])){echo htmlentities($_GET['guests']);}  ?> >
								</div>
								<div class="col-md-2">
									<label>Destination</label>
								</div>
								<div  class="col-md-3">
									<input type="text" class="form-control" id="destination" name="destination" value=<?php if(isset($_GET['destination'])){echo htmlentities($_GET['destination']);}  ?>>
								</div>
						  	</div>	

						  	<div class="container" style="margin-top: 20px;">
						       <div class="col-md-2">
									<label>Ckeck-in</label>
								</div>
								<div class="col-md-3">
									<input type="text" class="form-control" id="checkin" name="checkin" value=<?php if(isset($_GET['checkin'])){echo htmlentities($_GET['checkin']);}  ?>>
								</div>
								<div class="col-md-2">
									<label>Ckeck-out</label>
								</div>
								<div  class="col-md-3">
									<input type="text" class="form-control" id="checkout" name="checkout" value=<?php if(isset($_GET['checkout'])){echo htmlentities($_GET['checkout']);}  ?>>
								</div>
						  	</div>	
							
						  	<div class="container" style="margin-top: 20px;">
								<?php  
									if (isset($_SESSION['meta'])) {
										$meta = $_SESSION['meta']; 
									}
								?>
								<div class="col-md-3">
									<input type="hidden" name="page" id="page" value='1' />
									<input type="hidden" name="sort_criteria" id="sort_criteria" value="Overall" />
									<input type="hidden" name="sort_order" id="sort_order" value="desc" />
									<input type="hidden" name="longitude" id="longitude" />
									<input type="hidden" name="latitude" id="latitude" />
						  			<input type="hidden" name="keyword" id="keyword" class="form-control">
								</div>
						  	</div>	
							<button type="submit"  class="btn btn-success pull-right">Search</button>
						  </div>
						</form>
		    		</div>

		    		<div class="container" id="resultSearch">
		    			<?php 
		    			if (isset($_SESSION['hotels'])) {
			    			$hotels = $_SESSION['hotels'];
			    			if (count($hotels) == 0) {
			    					echo '<div class="alert alert-info" role="alert">No results</div></div>';
			    				}else{
			    					foreach ($hotels as $key => $value) {
			    						print(
			    							"<div class='row' style='padding-top: 10px;' >".
				    							"<div class='col-md-2'>". 
				    								"<img src='" .$value->image."' width='150' height='150' alt='Smiley face'>"
				    							.'</div>'.
				    							'<div class="col-md-10" >' 
					    							.$value->name . '<br>'
					    							. $value->description . 
				    							'</div>'.
			    							'</div>'
			    							);
			    					}//end foreach	


			    					print('<div class="container">
											  <ul class="pagination">');
			    						for($i = 1; $i <= $meta->total_pages ; $i++) {
			    								if ($meta->page == $i) {
			    									print('<li class="active"><a onclick=changePage('.$i.')>'.$i.'</a></li>');
			    								}else{
			    									print('<li><a onclick=changePage('.$i.')>'.$i.'</a></li>');
			    								}
			    						}
									print('		</ul>
											</div>');

			    				}	
			    			}			    			
		    			?>
		    			
		    		</div>
    		</div>

    <!-- Scripts -->
    <script src=<?php print($config->get('public') . "/js/jquery.min.js"); ?>  ></script>
    <script src=<?php print($config->get('public') . "/js/bootstrap.js"); ?>  ></script>
    <script src=<?php print($config->get('public') . "/js/searchHotelView.js"); ?>  ></script>
</body>
</html>

