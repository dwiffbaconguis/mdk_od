<!DOCTYPE html>
<html>
<head>
   <title>MDK LIDO LOANS</title>
   {{ HTML::style('assets/css/bootstrap.min.css') }}
   {{ HTML::style('assets/css/jquery-ui.min.css') }}
   {{ HTML::style('assets/css/jquery.dataTables.min.css') }}
   {{ HTML::style('assets/css/style.css') }}
   {{ HTML::style('assets/TableTools/css/dataTables.tableTools.min.css')}}
</head>
<body>
	{{ HTML::script('assets/js/jquery.js') }}
	{{ HTML::script('assets/js/jquery-ui.min.js') }}
	{{ HTML::script('assets/js/jquery.dataTables.min.js') }}
	<div class='container'>
		<nav class="navbar navbar-default" role="navigation">
			@if(Auth::check())
			<div class="navbar-header">
			  <button type="button" class="navbar-toggle" data-toggle="collapse" 
			     data-target="#example-navbar-collapse">
			     <span class="sr-only">Toggle navigation</span>
			     <span class="icon-bar"></span>
			     <span class="icon-bar"></span>
			     <span class="icon-bar"></span>
			  </button>
			  <a class="navbar-brand" href="{{ URL::to('/') }}">MDK LIDO LOANS</a>
			</div>
			<div class="collapse navbar-collapse" id="example-navbar-collapse">
			  	<ul class="nav navbar-nav">
			     	<li><a href="{{ URL::to('client') }}">Client</a></li>
			     	<li><a href="{{ URL::to('employee') }}">Employee</a></li>
			    	<li class="dropdown">
				        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
				           Reports <b class="caret"></b>
				        </a>
				        <ul class="dropdown-menu">
				           <li><a href="{{ action('ClientController@detailedReport') }}">View Reports</a></li>
				           <li class="divider"></li>
				           <li><a href="#">Tentative</a></li>
				           <li class="divider"></li>
				           <li><a href="#">Tentative</a></li>
				        </ul>
			    	</li>
		        <li>
		        	@if(Session::has('message'))
			            <p class="alert">{{ Session::get('message') }}</p>
			        @endif
		        </li>
		        <li class="dropdown pull-right">
			        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
			           {{Auth::user()->firstname}} <b class="caret"></b>
			        </a>
			        <ul class="dropdown-menu">
			           <li><a href="{{ URL::to('logout') }}">Logout</a></li>
			        </ul>
		    	</li>
		        @if(Session::has('flash_notice'))
		        	<div id="flash_notice">{{ Session::get('flash_notice') }}</div>
		        @endif
		        </ul>
			@else
				<ul class="nav navbar-nav">
		        	<li><a href="{{ URL::to('login') }}">Login</a></li>
		        	<li>
		        		@if(Session::has('message'))
				            <p class="alert">{{ Session::get('message') }}</p>
				        @endif
		        	</li>
		        </ul>
		        @if(Session::has('flash_error'))
		            <div id="flash_error">{{ Session::get('flash_error') }}</div>
		        @endif
			</div>
			@endif	
		</nav>
		@yield('content')
	</div>
</body>
	{{ HTML::script('assets/js/bootstrap.min.js') }}
	{{ HTML::script('assets/js/custom.js') }}
</html>