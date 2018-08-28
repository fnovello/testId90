<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
	<?php 
		  $config = Config::singleton();
	?>
    <link href=<?php print($config->get('public') . '/css/app.css'); ?> rel="stylesheet">
    <link href=<?php print($config->get('public') . '/css/selectize.default.css'); ?> rel="stylesheet">
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
                        Login
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <ul class="nav navbar-nav">
                        &nbsp;
                    </ul>

                    <ul class="nav navbar-nav navbar-right">
                            <?php
                            if (!(isset($_SESSION['login']) && $_SESSION['login'] != '')) {
                    	 		  print('<li><a href="/index.php">Login</a></li>');
                            	
                            }else{
                    	 		  print('<li><a href="">Logout</a></li>');
                    	 	}
                    	 ?>
                          
                    </ul>
                </div>
            </div>
        </nav>
		


        <div class="container">
		    <!-- SECTION LOGIN  -->
		    <div class="row">
		        <div class="col-md-8 col-md-offset-2">
		            <div class="panel panel-default">
		                <div class="panel-heading">Login</div>

		                <div class="panel-body">
		                    <form class="form-horizontal" method="POST" action=<?php print($config->get('app')) .'/login?action=checkLogin'; ?>>
		                        <div class="form-group">
							    <?php $airlines = (isset($_SESSION['airlines'])) ? $_SESSION['airlines'] : [] ?>		
		                        <div class="form-group">
		                            <label for="session_airline" class="col-md-4 control-label">Airlines</label>
		                            <div class="col-md-6">
		                            	<select id="session_airline" name="session[airline]" class="demo-default selectized">
					                         <?php 
					                         		echo("<option id='init'>Select airline...</option>");
						                         	foreach($airlines as $key => $value) {
						                         		echo("<option id='" .$value->id. "'>".$value->display_name."</option>");
						                              }
					                         ?>
		                            	</select>
		                            </div>
		                        </div>
		                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>
		                            <div class="col-md-6">
		                                <input  class="form-control" id="session_username" placeholder="Enter your username" name="session[username]" value="" required autofocus>
		                            </div>
		                        </div>

		                        <div class="form-group">
		                            <label for="password" class="col-md-4 control-label">Password</label>
		                            <div class="col-md-6">
		                                <input id="session_password" placeholder="Enter your password here." type="password" class="form-control" name="session[password]" required>
		                            </div>
		                        </div>  

		                        <div class="form-group">
		                            <div class="col-md-6 col-md-offset-4">
		                                <div class="checkbox">
		                                    <label>
		                                        <input type="checkbox" value="1" name="session[remember_me]"> Remember Me
		                                    </label>
		                                </div>
		                            </div>
		                        </div>

		                        <div class="form-group">
		                            <div class="col-md-8 col-md-offset-4">
		                                <button type="submit" class="btn btn-primary">
		                                    Login
		                                </button>
		                            </div>
		                        </div>
		                    </form>
		                </div>
		            </div>
		        </div>
		    </div>
		</div>
    </div>

    <!-- Scripts -->
    <script src=<?php print($config->get('public') . "/js/jquery.min.js"); ?>  ></script>
    <script src=<?php print($config->get('public') . "/js/bootstrap.js"); ?>  ></script>
    <script src=<?php print($config->get('public') . "/js/selectize.js"); ?>  ></script>
    <script src=<?php print($config->get('public') . "/js/loginView.js"); ?>  ></script>
</body>
</html>


