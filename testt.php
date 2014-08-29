
<!DOCTYPE html>
<html lang="en">
  <head prefix="og: http://ogp.me/ns# fb: http://ogp.me/ns/fb# website: http://ogp.me/ns/website#">
	<meta charset="utf-8">
	<title>Level Editor | Gamefroot</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<meta name="author" content="">

	<meta property="og:type" content="website">
	<meta property="og:url" content="http://gamefroot.com/leveleditor/">
	<meta property="og:image" content="http://gamefroot.com/wp-content/files/2012/04/fruit.png">
	<meta property="og:title" content="Gamefroot - Level Editor">
	<meta property="og:description" content="Make your own game using our easy-to-use level editor!">

	<!-- Le styles -->			<!-- elsewhere -->
		<link href="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.1/css/bootstrap-combined.min.css" rel="stylesheet">
		<link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
		<link href="http://gamefroot.com/js/colorbox-resources/colorbox.css?v=release-1.28" rel="stylesheet">
	<link href="http://gamefroot.com/js/jquery-ui-fileinput/css/enhanced.css?v=release-1.28" rel="stylesheet">
	<link href="http://gamefroot.com/css/bootstrap.popover-plus.css?v=release-1.28" rel="stylesheet">
	<link href="http://gamefroot.com/leveleditor/css/leveleditor.css?v=release-1.28" rel="stylesheet">
	<link href="http://gamefroot.com/wp-content/plugins/da-stash/da-stash.css" rel="stylesheet">
	<style>
	  body {
		padding-top: 60px; /* 60px to make the container go all the way to the bottom of the topbar */
	  }
	</style>
	<!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
	<!--[if lt IE 9]>
	  <script src="http://html5shim.googlecode.com/svn/trunk/html5.js?v=release-1.28"></script>
	<![endif]-->

	<!-- Le fav and touch icons -->
	<link rel="shortcut icon" href="../favicon.ico?v=release-1.28">
	<link rel="apple-touch-icon-precomposed" sizes="144x144" href="ico/apple-touch-icon-144-precomposed.png?v=release-1.28">
	<link rel="apple-touch-icon-precomposed" sizes="114x114" href="ico/apple-touch-icon-114-precomposed.png?v=release-1.28">
	<link rel="apple-touch-icon-precomposed" sizes="72x72" href="ico/apple-touch-icon-72-precomposed.png?v=release-1.28">
	<link rel="apple-touch-icon-precomposed" href="ico/apple-touch-icon-57-precomposed.png?v=release-1.28">
  </head>

  <body>
  	<div id="fb-root"></div>
  	<!--- loading -->
  	<div id="whiteloading">
  		<div id="loadingModal">
  			<div id="centerContentLoading">
	  			<h1>Loading Gamefroot...</h1>
	  			<img src="img/loading-pac-7c7c7c.gif" alt="loading..."/>
  			</div>
  		</div> 	
  	</div>  	
  	<!-- end loading -->
  	<div id="maincontainer">
		<div id="topbar">
			<div id="tool-toggles">
				<!-- preview button -->
				<h1><a href="/"><span id="logo_pixel" title="Return to Gamefroot"></span></a></h1>
				<div class="pull-right profile-Nav">
					<div class="navbar pull-right">
						<ul id="header-menu-loading" class="nav pull-right">
							<li>
								<a href="#"><div class="loading inline black"></div> Loading...</a>
							</li>
						</ul>
						<ul id="header-menu-logged-in" class="nav pull-right" style="display: none;">
							<li class="dropdown">
								<a class="dropdown-toggle" id="mini-menu" data-toggle="dropdown" href="#"><img id="header-menu-logged-in-avatar-mini" class="profile-picture" height="30" width="30" alt=""> <b class="caret"></b></a>
								<ul class="dropdown-menu">
									<li><a id="header-menu-logged-in-author-page" href=""><img id="header-menu-logged-in-avatar-menu" class="profile-picture" height="40" width="40" alt=""><span class="username"></span></a></li>
									<li><a href="/edit-profile/" class="editprofile">Edit My Profile</a></li>
									<li class="divider"></li>
									<li class="dropdown-submenu langaugeDropDown">
										<a id="menu" href="#"></span>Language</a>
										<ul class="dropdown-menu">
											<li><a href="/leveleditor/"><i class="flag en"></i>English</a></li>
											<li><a href="?lang=sp_ES"><i class="flag es"></i>Spanish</a></li>
											<li class="divider"></li>
											<li><a href="http://gamefroot.com/help-us-translate-gamefroot/" target="_blank">Help Us Translate</a></li>

										</ul>
									</li>
									<li class="divider langaugeDropDown"></li>
									<li><a id="header-menu-logout" href="#">Log Out</a></li>
								</ul>
							</li>
						</ul>
						<ul id="header-menu-no-user" class="nav pull-right" style="display: none;">
							<li>
								<a id="header-menu-no-user-btn-log-in" href="#">Log in...</a>
							</li>
						</ul>
					</div>
				</div>
				<div class="pull-right" id="rightButtons">
					
					<div class="pull-right" id="preview-game-menu">					
						<button id="preview-game" class="btn btn-success"><i class="glyphicon glyphicon-white glyphicon-play"></i> Play</button>	
					</div>	
					
					<div class="pull-right" id="assetManagerButton">
						<button id="btn-toggle-asset-manager" class="btn btn-info" href="#">My Resources</button>							
					</div>
					
					<div class="pull-right">
						<button id="notifications" class="pull-right btn">0</button>							
					</div>
					
					<div class="pull-right">
						<button id="newScript" class="btn pull-right"><i class="glyphicon glyphicon-share-alt"></i>Script Edit Mode</button>							
					</div>	
					
					
													
				</div>
				<div id="topbar-level-name-container"><span id="topbar-level-name">Untitled Level</span> <span id="topbar-level-type">Platform Level</span></div>
				<ul class="nav nav-pills">
					<!-- save btn -->
					<li><a id="btn-save-map" href="#"><i class="glyphicon glyphicon-circle-arrow-down"></i> Save</a></li>
					<!-- file menu -->
					<li class="dropdown" id="file-menu"><a class="dropdown-toggle" data-toggle="dropdown" href="#">File <b class="caret"></b></a>
						<ul class="dropdown-menu">
							<li class="dropdown-submenu">
								<a href="#"><i class="glyphicon glyphicon-file"></i> New Level...</a>
								<ul class="dropdown-menu sub-menu">
									<li><a id="menu-file-new-template" href="#">From Template...</a>
									<li class="divider"></li>
									<li><a id="menu-file-new-platform" href="#">Platform Level</a></li>
									<li><a id="menu-file-new-topdown" href="#">Top-Down Level <strong><em>alpha</em></strong></a></li>
								</ul></li>
							<li class="divider"></li>
							<li><a id="menu-file-open-level" href="#"><i class="glyphicon glyphicon-folder-open"></i> Open Level...</a></li>
							<li class="divider"></li>
							<li><a id="menu-file-save" href="#"><i class="glyphicon glyphicon-circle-arrow-down"></i> Save Level...</a></li>
							<li><a id="menu-file-save-as" href="#"><i class="glyphicon glyphicon-asterisk"></i> Save Level As...</a></li>
							<li class="divider"></li>
							<li><a id="menu-file-level-properties" href="#"><i class="glyphicon glyphicon-info-sign"></i> Level Properties...</a></li>
							<li class="divider"></li>
							<li><a id="menu-file-publish-to-gamefroot" href="#"><i class="glyphicon glyphicon-globe"></i> Publish to Gamefroot...</a></li>
							<li><a id="menu-file-share-published-game" href="#"><i class="glyphicon glyphicon-share"></i> Share/Unpublish Game...</a></li>
						</ul>
					</li>
					<li class="dropdown" id="edit-menu"><a href="#" class="dropdown-toggle" data-toggle="dropdown">Edit <b class="caret"></b></a>
						<ul class="dropdown-menu">
							<li><a href="#" id="undo-menu-button"><i class="icon-undo"></i> Undo </a></li>
							<li><a href="#" id="redo-menu-button"><i class="icon-repeat"></i> Redo </a></li>
						</ul>
					</li>
					<!-- view menu -->
					<li class="dropdown" id="view-menu"><a class="dropdown-toggle" data-toggle="dropdown" href="#">View <b class="caret"></b></a>
						<ul class="dropdown-menu">
							<li><a href="#" id="toggle-asset-manager" class="checked"><i class="glyphicon glyphicon-ok if-checked"></i> My Resources</a></li>
							<li><a href="#" id="toggle-palette"><i class="glyphicon glyphicon-ok if-checked"></i> Palette</a></li>
							<li><a href="#" id="toggle-tools-panel"><i class="glyphicon glyphicon-ok if-checked"></i> Navigator</a></li>
							<li class="divider"></li>
							<li><a href="#" id="toggle-grid" class="checked"><i class="glyphicon glyphicon-ok if-checked"></i> Grid</a></li>
							<li class="dropdown-submenu">							
								<a href="#">Screen Size Mask</a>
								<ul class="dropdown-menu">
									<li><a href="#" class="sizeDisplay">Do not display</a></li>
									<li class="divider"></li>
									<li><a href="#" class="sizeDisplay" data-size="768x512">Web Browser (768 x 512)</a></li>
									<li><a href="#" class="sizeDisplay" data-size="960x480">Iphone 4 (960 x 480)</a></li>
									<li><a href="#" class="sizeDisplay" data-size="1136x480">Iphone 5 (1136 x 480)</a></li>	
									<li><a href="#" class="sizeDisplay" data-size="1280x800">Galaxy Note (1280 x 800)</a></li>									
								</ul>
							</li>
						</ul>
					</li>
					<!--  help menu -->
					<li class="dropdown" id="help-menu"><a class="dropdown-toggle" data-toggle="dropdown" href='#'>Help <b class="caret"></b></a>
						<ul class="dropdown-menu">
							<li><a href="#" id="help-about"><i class="icon"></i>About Gamefroot</a></li>
							<li class="divider"></li>
							<li><a href="https://gamefroot.zendesk.com/categories/20052076-knowledgebase"><i class="icon"></i>Support Docs</a></li>
							<li class="divider"></li>
							<li><a href="#" id="report-a-bug"><i class="icon"></i>Report a Bug</a></li>

						</ul>
					</li>					
				</ul>
			</div>
		</div>
		
		
		
		<!-- NOTIFICATIONS -->
		
		<div id="notificationsModal" class="modal">
		  <div class="modal-header">		    
		    <h4>Latest Blog Posts</h4>
		  </div>
		  <div class="modal-body">
		  
		  </div>
		  <div class="modal-footer">
		    	<a href="#">View all blog posts </a>
		  </div>
		</div>

		<!-- Connection banners -->
		<div class="connectionError">
			<div class="close"><i class="fa fa-times"></i></div>
			<p> You have been disconnected, we will try to automatically connect in <span class="timer"> 5 </span> seconds </p>
		</div>

		<div class="connectionSuccess">
			<div class="close"><i class="fa fa-times"></i></div>
			<p> Connected! </p>
		</div>

		<div class="connectionUpdated">
			<div class="close"><i class="fa fa-times"></i></div>
			<p> Gamefroot is updating <span class="connectionTimer"></span></p>
		</div>

		<div class="connectionUpdatedMsg">
			<div class="close"><i class="fa fa-times"></i></div>
			<p></p>
		</div>

		
		<!-- SIDEBAR -->
		<ul id="sidebar-selector">
			<li id="sidebar-terrain"><a href="#" data-asset-type="terrain"><div class="icon icon-terrain"></div><br>Terrain</a></li>
			<li id="sidebar-items" class="current"><a href="#" data-asset-type="items"><div class="icon icon-items"></div><br>Items</a></li>
			<li id="sidebar-characters"><a href="#" data-asset-type="characters"><div class="icon icon-characters"></div><br>Characters</a></li>
			<li id="sidebar-marketplace"><a href="#" data-asset-type="marketplace"><div class="icon icon-marketplace"></div><br>Marketplace</a></li>
			<li id="sidebar-behaviours"><a href="#" data-asset-type="behaviours"><div class="icon icon-scripts"></div><br>Behaviours</a></li>
			<li id="sidebar-da-stash"><a href="#" data-asset-type="da-stash"><div class="icon icon-da-stash"></div><br>Sta.sh</a></li>
		</ul>
		<div id="sidebar-indicator" class="animated" style="top: 208px;">
			<div class="indicator-border"></div>
			<div class="indicator-fill"></div>
		</div>
		<div id="sidebar-corner"><div class="outer-shading"></div><div class="curve"></div></div>



		<!-- PALETTE PANEL -->
		
<div id="palette-panel" class="animated platform">
	
	<div id="palette-panel-title">
			<div class="btn-group pull-right">
				<a id="palette-panel-button-create" class="upload-menu btn btn-small btn-info dropdown-toggle" data-toggle="dropdown" href="#">
					<i class="glyphicon glyphicon-plus icon-white"></i>
					Create new...				</a>
				<ul class="dropdown-menu">
					<li class="characters"><a id="palette-character-creator">with Character Creator...</a></li>
					<li class="characters"><a id="palette-character-sprite">with your sprite sheet...</a></li>
					<li class="items"><a id="palette-item-upload">Upload Item...</a></li>
					<li class="items"><a id="palette-item-animate">Animated Item...</a></li>
					<li class="items"><a id="palette-item-zip">Upload Zip...</a></li>
					<li class="terrain"><a id="palette-terrain-upload">Upload tiles...</a></li>
					<li class="behaviours"><a id="palette-panel-button-new-robot">Create new script...</a></li>
				</ul>
			</div>
			<span class="heading">Loading...</span>
	</div>
	<div id="current-selection">
		Current Player		<ul id="palette-panel-current-player">
			<li><p>No player placed.</p></li>
		</ul>
	</div>
	<div id="palette-assets">
		<p class="alert alert-info">
			This is the content from asset packs that you have <strong>added</strong> to this game		</p>
	
		<!-- behaviours -->
		
<ul id="palette-behaviours">
	<li class="loading"></li>
</ul>
	</div>

	<!-- MARKETPLACE -->
	
<div id="palette-marketplace" style="display: none;">
	<p>A place where you can buy and sell assets, such as characters, items, behaviours and music to other Gamefroot users.</p>

	<ul id="palette-marketplace-packs" class="packs clearfix" style=""></ul>	
	<a href="#" id="palette-marketplace-buy-credits">Buy more credits...</a>
</div>

	<!-- DEVIANTART STASH -->
	
<div id="palette-da-stash" style="display: none; padding: 8px; width: 250px;">
	<div id="palette-da-stash-loading">
		<div class="loading"></div>
	</div>
	<div id="palette-da-stash-connect" style="display:none; text-align: center;">
		<p>Import your artwork from your deviantART Sta.sh.</p>
		<button id="da-stash-connect" class="da-stash-connect da-stash-button">Connect to deviantART</button>
	</div>
	<div id="palette-da-stash-view" style="display:none;">
		<ul id="palette-da-stash-view-list" class="da-stash-list clearfix">
		</ul>
		<hr>
		<div id="palette-da-stash-view-user">
			<p>Connected as <span class="symbol"></span><span class="username"></span></p>
			<button class="da-stash-disconnect da-stash-button">Disconnect from deviantART</button>
		</div>
	</div>
	<div id="palette-da-stash-error" style="display:none;">
		<p>Oops. There was an error talking to Sta.sh. </p>
	</div>
</div>


</div>

		<!-- TOOLS PANE -->
		
<div id="tools-panel-container" class="animated">
	<div id="tools-panel" class="well">
		<div id="minimap-panel" class="clearfix">
			<div id="minimap-container">
				<canvas id="minimap" width="160" height="125"></canvas>
				<div id="screen-outline"></div>
			</div>
			<div id="minimap-controls">
				<div id="zoom-factor" class="pull-right">100%</div>
				<a id="zoom-in" href="#" title="Zoom In"><i class="glyphicon glyphicon-plus"></i></a>
				<a id="zoom-reset" href="#" title="100% Zoom"><i class="glyphicon glyphicon-search"></i></a>
				<a id="zoom-out" href="#" title="Zoom Out"><i class="glyphicon glyphicon-minus"></i></a>
				<div id="cursor-coordinates">(0,0)</div>
			</div>
		</div>
		<hr>
		<div id="toolsLayersContainer">
			    <a class="toolsHeader" href="#"><span>Layers</span><i class="caret"></i></a>
			        <div data-type="" id="selectedLayer" class="layer expanded">
						<a class="toggle-layer-visibility" href="#" title="Toggle Layer Visibility"><i class="glyphicon glyphicon-eye-open"></i></a>
						<span class="layer-icon glyphicon glyphicon-tree-deciduous"></span>
						<span class="layer-name">Foreground</span>
					</div>
			    	
			      <div class="toolsInnerToggle">		    
						<div id="layers-panel" class="clearfix">
							<div data-type="wiring" class="layer wiring">
								<a class="toggle-layer-visibility" href="#" title="Toggle Layer Visibility"><i class="glyphicon glyphicon-eye-open"></i></a>
								<span class="layer-name">Wiring</span>
							</div>
							<div data-type="terrain" data-layer="foreground" id="foreground-layer" class="layer terrain">
								<a class="toggle-layer-visibility" href="#" title="Toggle Layer Visibility"><i class="glyphicon glyphicon-eye-open"></i></a>
								<span class="layer-icon glyphicon glyphicon-tree-deciduous"></span>
								<span class="layer-name">Foreground</span>
							</div>
							<div data-type="character" class="layer characters">
								<a class="toggle-layer-visibility" href="#" title="Toggle Layer Visibility"><i class="glyphicon glyphicon-eye-open"></i></a>
								<span class="layer-icon glyphicon glyphicon-user"></span>
								<span class="layer-name">Characters</span>
							</div>
							<div data-type="item" data-layer="foreground" class="layer items">
								<a class="toggle-layer-visibility" href="#" title="Toggle Layer Visibility"><i class="glyphicon glyphicon-eye-open"></i></a>
								<span class="layer-icon glyphicon glyphicon-star"></span>
								<span class="layer-name">Items</span>
							</div>
							<div data-type="terrain" data-layer="terrain" id="terrain-layer" class="layer active terrain">
								<a class="toggle-layer-visibility" href="#" title="Toggle Layer Visibility"><i class="glyphicon glyphicon-eye-open"></i></a>
								<span class="layer-icon glyphicon glyphicon-tree-deciduous"></span>
								<span class="layer-name">Terrain</span>
							</div>
							<div data-type="terrain" data-layer="background" class="layer terrain">
								<a class="toggle-layer-visibility" href="#" title="Toggle Layer Visibility"><i class="glyphicon glyphicon-eye-open"></i></a>
								<span class="layer-icon glyphicon glyphicon-tree-deciduous"></span>
								<span class="layer-name">Background</span>
							</div>
							 	<div data-type="item" data-layer="background" class="layer items">
								<a class="toggle-layer-visibility" href="#" title="Toggle Layer Visibility"><i class="glyphicon glyphicon-eye-open"></i></a>
								<span class="layer-icon glyphicon glyphicon-star"></span>
								<span class="layer-name">BG Items</span>
							</div>
						</div>
			      </div>
			        <a class="toolsHeader" href="#"><span>Select An Item</span><i class="caret"></i></a>
				    <div class="toolsInnerToggle">		    
							<p>Please Select a game <br /> item </p>				    </div>	
			  </div>
		</div>	   
</div>		   
		<!-- TOOLBAR -->
		<div id="toolbar" class="animated">
<div class="handle"></div>
<ul id="toolbar-buttons">
	<li id="toolbar-buttons-move" data-behaviour="move"><a href="#" rel="tooltip" title="Move&nbsp;Tool&nbsp;(v)"><i class="toolbar-icon move-tool glyphicon glyphicon-mouse"></i></a></li>
	<li id="toolbar-buttons-brush" data-behaviour="brush" class="active"><a href="#" rel="tooltip" title="Brush&nbsp;Tool&nbsp;(b)"><i class="toolbar-icon brush-tool glyphicon glyphicon-pencil"></i></a></li>
	<li id="toolbar-buttons-marquee" data-behaviour="marquee"><a href="#" rel="tooltip" title="Drag&nbsp;to&nbsp;fill&nbsp;"><i class="toolbar-icon marquee-tool icon-resize-full"></i></a></li>
	<li id="toolbar-buttons-erase" data-behaviour="erase"><a href="#" rel="tooltip" title="Eraser&nbsp;Tool&nbsp;(e)"><i class="toolbar-icon eraser-tool glyphicon glyphicon-trash"></i></a></li>
	<li id="toolbar-buttons-hand" data-behaviour="hand"><a href="#" rel="tooltip" title="Hand&nbsp;Tool&nbsp;(h)"><i class="toolbar-icon hand-tool glyphicon glyphicon-move"></i></a></li>
	<li id="toolbar-buttons-properties" data-behaviour="properties"><a href="#" rel="tooltip" title="Properties&nbsp;Tool (right-click)"><i class="toolbar-icon properties-tool glyphicon glyphicon-wrench"></i></a></li>	
</ul>
</div>
		<!-- LEVEL EDITOR -->
		<div id="level-editor" class="animated">
			<canvas id="background-items"></canvas>
			<canvas id="background"></canvas>
			<canvas id="stage"></canvas>
			<canvas id="items"></canvas>
			<canvas id="characters"></canvas>
			<canvas id="foreground"></canvas>
			<canvas id="icons"></canvas>
			<img id="tile-cursor" alt=""/>
			<img id="player" alt="Player"/>
			<div id="lines" class="editor-layer same"></div>
			<img id="mouse-cursor" alt=""/>
			<div id="overlay" class="editor-layer grid-on" ></div>

		</div>

		<!-- POP OVER -->
		
<div id="popover-container" class="animated concealed">
	<div id="popover">
		<div class="buttons pull-right">
			<button class="btn btn-small btn-inverse">Cancel</button>
		</div>
		<div class="message">
			Please provide a message for this popover.
		</div>
	</div>
</div>

		<!-- ASSET MANAGER -->
		
<div id="asset-manager-container" class="animated" style="display: none;">
	<div id="asset-manager">
		<div class="asset-pane animated" id="asset-manager-packs-pane" style="height: 100%;">
			<div class="asset-pane-contents packs-view-pane">
				<button class="close">×</button>
				<div class="filter-bar">
					<h4>Asset Manager</h4>
					<p class="alert alert-info">
						Click on a pack to view its contents, and click <strong>Add Pack to Game</strong> to make them usable.						Check out the <strong>Marketplace</strong> to find more packs.					</p>
				</div>
				<!-- <div class="filter-bar btn-group" data-toggle="buttons-radio">
					<a class="btn active" href="#">All</a>
					<a class="btn" href="#">My Packs</a>
					<a class="btn" href="#">Core</a>
					<a class="btn" href="#">Purchased</a>
					<a class="btn" href="#">Sponsored</a>
					<a class="btn" href="#">My Games</a>
				</div>-->
				<div class="packs-view">
					<ul class="packs">
						<li id="new-pack" class="new-pack">
							<a href="#">
								<div class="pack-icon">
									<div class="pack-icon-label"><i class="glyphicon glyphicon-arrow-down new-pack"></i><br />Click to create a new pack.</div>
								</div>
								<div class="pack-name">New Pack</div>
							</a>
						</li>
					</ul>
				</div>
			</div>
		</div>
		<div class="asset-pane animated" id="asset-manager-contents-pane" style="height: 0%;">
			<div class="asset-pane-contents assets-view-pane">
				<button class="close">×</button>

	<!--
				<div class="pack-sidebar">
	-->
					<!-- <button class="btn back-to-packs"><i class="icon-arrow-left"></i> Back to Packs</button> -->
	<!-- 				<ul class="packs">
						<li class="user-pack"><a href="#"><div class="pack"><div class="pack-icon"></div></div><div class="pack-name">Royal Society</div><span class="pack-contents-line"><i class="asset-icon terrain"></i><i class="asset-icon items"></i><i class="asset-icon music"></i><i class="asset-icon sounds"></i></span></a></li>
					</ul>
					<a href="#" class="btn">Add All to Game</a>
					<div class="btn-group">
						<a class="btn" href="#">Pack Info</a>
						<a class="btn" href="#">Purchase</a>
					</div>
				</div>
	-->
				<div class="assets-view">
					<div class="filter-bar">
						<div id="asset-manager-create-new-assets" class="pull-right" style="margin-right: 30px;">
							<a href="#" id="asset-manager-button-open-pack-properties" class="btn pull-right" rel="tooltip" title="Pack Properties"><i class="glyphicon glyphicon-cog"></i></a>
							<div class="btn-group pull-right" style="margin: 0 5px;">
								<a class="btn dropdown-toggle" data-toggle="dropdown" href="#"><i class="glyphicon glyphicon-circle-arrow-up"></i> Create New Assets <span class="caret"></span></a>
								<ul class="dropdown-menu">
									<li><a href="#" id="upload-terrain-assets">Terrain...</a></li>
									<li><a href="#" id="upload-item-assets">Items...</a></li>
									<li class="dropdown-submenu pull-left">
										<a href="#">Animated Item...</a>
										<ul class="dropdown-menu">
											<li><a href="#" id="upload-animated-item-assets">Animation Editor...</a></li>
											<li><a href="#" id="upload-import-item-assets">Import From Zip...</a></li>
										</ul>
									</li>
									<li><a href="#" id="upload-character-asset">Characters...</a></li>
									<li class="divider"></li>
									<li><a href="#" id="upload-music-asset">Background Music...</a></li>
									<li><a href="#" id="upload-sound-asset">Sound Effects...</a></li>
									<li><a href="#" id="upload-weapon-asset">Weapon...</a></li>
									<li><a href="#" id="upload-bullet-asset">Bullet...</a></li>
									<li><a href="#" id="upload-background-asset">Background...</a></li>
								</ul>
							</div>
							<a id="asset-manager-button-marketplace-publish" class="btn" href="#"><i class="glyphicon glyphicon-tag"></i> Add to Marketplace</a>
							<div class="pull-right" style="margin-top: 7px;" id="asset-manager-button-marketplace-status"></div>
						</div>
						<h4 class="pack-name"></h4>
						<button id="asset-manager-pack-view-add" class="btn btn-primary btn-small"><i class="glyphicon glyphicon-plus glyphicon-white"></i>&nbsp;Add Pack to Game</button>
						<p id="add-notification">This pack will not be usable until it has been added.</p>
					</div>
					<div class="assets">
						<div class="asset-pack">
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div id="modal-create-new-pack" class="colorbox">
	<div class="modal-header">
		<h3>Create New Pack</h3>
	</div>
	<div class="modal-body">
		<div id="level-list">
			<div class="form-vertical">
				<div class="control-group">
					<label class="control-label" for="modal-create-new-pack-field-pack-name">Pack Name</label>
					<div class="controls">
						<input type="text" style="width: 490px;" id="modal-create-new-pack-field-pack-name">
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="modal-footer">
		<div class="pull-right">
			<button id="modal-create-new-pack-btn-cancel" class="btn close-modal">Cancel</button>
			<button id="modal-create-new-pack-btn-create" class="btn btn-primary"><i class="icon icon-white icon-ok"></i> Create Pack</button>
		</div>
	</div>
</div>

<div id="modal-pack-properties" class="colorbox">
	<div class="modal-header">
		<h3>Pack Properties</h3>
	</div>
	<div class="modal-body">
		<div class="form-vertical">
			<div class="control-group">
				<label class="control-label" for="modal-pack-properties-field-pack-name">Pack Name</label>
				<div class="controls">
					<input type="text" style="width: 490px;" id="modal-pack-properties-field-pack-name">
				</div>
			</div>

			<div class="control-group in-marketplace-options">
				<label class="control-label" for="modal-pack-properties-field-pack-description">Pack Description</label>
				<div class="controls">
					<textarea style="width: 490px;" id="modal-pack-properties-field-pack-description" rows="3"></textarea>
				</div>
			</div>
			<div class="control-group clearfix" style="margin-bottom: 10px;">
				<div style="float: left; margin-top: 5px;">
					<ul class="packs">
						<li>
							<a href="#">
								<div class="pack">
									<div class="pack-icon" id="modal-pack-properties-icon-container"></div>
								</div>
								<div id="modal-pack-properties-form-pack-name" class="pack-name">Pack Name Here</div>
							</a>
						</li>
					</ul>
				</div>
				<div class="controls" style="margin-left: 150px;">
					<p><strong>Pack Icon</strong></p>
					<form class="control-group" id="modal-pack-properties-form-pack-icon" action="/?pack-handler-api=1&amp;type=upload-pack-icon" method="post" enctype="multipart/form-data">
						<input class="input-file" id="modal-pack-properties-field-pack-icon" name="uploaded-file" type="file">
						<p style="margin-top: 10px;">
							<button type="submit" class="btn btn-mini" id="modal-pack-properties-button-upload-pack-icon">Upload Pack Icon</button>
						</p>
						<p class="help-block">The icon must be an 81x81 transparent PNG. The crate pattern will show through any transparent areas.</p>
					</form>
				</div>
			</div>
			<div class="in-marketplace-options">
				<p><strong>Pack Pricing</strong></p>
				<p class="small">Selling for a price requires an active Master subscription. <a href="#">Upgrade to Master</a></p>
				<div style="margin-left: 20px">
					<table width="100%"><tr><td width="50%" valign="top">
						<label class="radio">
							<input type="radio" name="pack-pricing" id="modal-pack-properties-pack-pricing-free" value="free" checked>
							Available for Free						</label>
					</td><td width="50%" valign="top">
						<div id="modal-pack-properties-form-price-points">
						</div>
					</td></tr></table>
				</div>
			</div>
		</div>
	</div>
	<div class="modal-footer">
		<div class="pull-right">
			<button id="modal-pack-properties-btn-cancel" class="btn close-modal">Cancel</button>
			<button id="modal-pack-properties-btn-save" class="btn btn-primary"><i class="icon icon-white icon-ok"></i> Save</button>
		</div>
	</div>
</div>

<div id="modal-create-new-pack-creating" class="colorbox">
	<div class="modal-header">
		<h3>Create New Pack</h3>
	</div>
	<div class="modal-body" style="text-align: center;">
		<h2 id="modal-create-new-pack-creating-status">Creating Pack...</h2>
		<div class="progress progress-striped active"><div class="bar" style="width: 100%;"></div></div>
		<p id="modal-create-new-pack-creating-message"></p>
	</div>
	<div class="modal-footer">
		<button id="modal-create-new-pack-creating-btn-close" class="btn close-modal pull-right" style="display: none;">Close</button>
	</div>
</div>

	</div>
	
	<!-- PACKMAN LOADER -->
	<div id="loading" class="colorbox">
		<h3>Loading Gamefroot...</h3>
		<img src="img/loading-pac-7c7c7c.gif" height="24" width="24" alt="Loading"/>
	</div>


	

	

	<!-- CONTEXT MENU -->
	
<div id="context-menu" class="dropdown">
	<div class="contextHolder">
		<a id="activate-context-menu" class="dropdown-toggle" data-toggle="dropdown" data-target="#"></a>
		<ul class="dropdown-menu">
		</ul>
	</div>
</div>
	<!-- LEVEL PROPERTIES MODAL -->
	<div id="modal-level-properties" class="colorbox">
	<div class="modal-header" style="padding-bottom: 0; border-bottom: none">
		<h3 style="margin-bottom: 10px;">Level Properties</h3>
		<ul class="nav nav-tabs" style="margin-bottom: 0;">
			<li class="active"><a href="#modal-level-properties-tab-level" data-toggle="tab">Level</a></li>
			<li><a href="#modal-level-properties-tab-environment" data-toggle="tab">Environment</a></li>
			<li><a href="#modal-level-properties-tab-gameplay" data-toggle="tab">Gameplay</a></li>
			<li id="modal-level-properties-tabbtn-menu-editor"><a href="#modal-level-properties-tab-menu-editor" data-toggle="tab">Game Menu</a></li>
		</ul>
	</div>
	<div class="modal-body">
		<div class="tab-content" style="min-height: 400px;" >
			<div class="tab-pane active" id="modal-level-properties-tab-level">

				<div class="form-vertical">
					<div class="control-group">
						<label class="control-label" for="modal-level-properties-field-level-name">Level Name</label>
						<div class="controls">
							<input type="text" style="width: 490px;" id="modal-level-properties-field-level-name">
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="modal-level-properties-field-description">Level Description</label>
						<div class="controls">
							<textarea type="text" style="width: 490px;" id="modal-level-properties-field-description" rows="3"></textarea>
						</div>
					</div>
					<div class="control-group" id="modal-level-properties-fieldset-url-slug">
						<label class="control-label" for="modal-level-properties-field-url-slug">Game URL</label>
						<div class="controls">
							<div class="input-prepend">
								<span class="add-on">http://gamefroot.com/games/</span><input type="text" style="width: 250px;" id="modal-level-properties-field-url-slug">
								<span id="modal-level-properties-badge-url-slug"></span>
							</div>
							<p class="help-block">The Game URL will only work once the game is published, and cannot be changed once published.</p>
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="modal-level-properties-field-promo-graphic">Promo Graphic</label>
						<div class="control-group error"><span id="modal-level-properties-img-promo-graphic-disabled" class="help-inline" style="display: none;">Save your game for the first time to enable the promo graphic for it.</span></div>
						<div id="modal-level-properties-img-promo-graphic"></div>
						<div style="margin-left: 135px;">
							<div class="controls">
								<form id="modal-level-properties-form-promo-graphic" action="/?gamemakers_api=1&amp;type=upload_promo_graphic" method="post" enctype="multipart/form-data">
									<input class="input-file" id="modal-level-properties-field-promo-graphic" name="promographic" type="file"><br>
									<input type="hidden" name="game_id" id="modal-level-properties-field-game_id" value="" />
									<p class="help-block">Promo graphic must be a 643x256 opaque PNG.</p>
									<button type="submit" class="btn btn-mini" id="modal-level-properties-button-upload-promo-graphic">Upload Promo Graphic</button>
									<button type="submit" class="btn btn-mini" id="modal-level-properties-button-remove-promo-graphic">Remove Existing File</button>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="tab-pane" id="modal-level-properties-tab-environment">
				<div class="form-horizontal">
					<h4>Dimensions</h4>
					<div class="control-group">
						<label class="control-label" for="modal-level-properties-field-level-dimensions-x">Level Dimensions</label>
						<div class="controls">
							<input type="text" class="input-mini" id="modal-level-properties-field-level-dimensions-x"> tiles wide <em>by</em>
							<input type="text" class="input-mini" id="modal-level-properties-field-level-dimensions-y"> tiles high<br>
						</div>
					</div>
					<div id="modal-level-properties-help-level-dimensions"></div>
				</div>
				<div class="form-horizontal">
					<h4>Level Lighting</h4>
					<div class="control-group">
						<label class="control-label" for="modal-level-properties-field-level-light">Level Light:</label>
						<div class="controls">
							<input type="text" class="input-mini" id="modal-level-properties-field-level-light"> 
						</div>
					</div>
					<div id="modal-level-properties-help-level-dimensions"></div>
				</div>
				<div class="form-vertical">
					<h4>Level Backdrop</h4>
					<div class="control-group">
						<div class="controls">
							<div id="modal-level-properties-backdrop-frame">
								<input type="hidden" id="modal-level-properties-backdrop" value="0">
								<ul id="modal-level-properties-backdrop-selector"></ul>
							</div>
						</div>
					</div>
					<div class="control-group">
						<!--label class="control-label" for="modal-level-properties-field-custom-backdrop">Upload Custom Backdrop Graphic</label>
						<div class="controls">
							<form id="modal-level-properties-form-custom-backdrop" action="/?gfdl_api=1&amp;type=add-background-file" method="post" enctype="multipart/form-data">
								<input class="input-file" id="modal-level-properties-field-custom-backdrop" name="uploaded-file" type="file">
								<button class="btn" id="modal-level-properties-button-upload-custom-backdrop">Upload Backdrop</button>
								<p class="help-block">Backdrop must be a 768x512 PNG (jpg or gif also accepted)</p>
							</form>
						</div-->
						<p class="help-block">
							Only packs that are available in game can be seen here.							Please go to My Resources to create a new background.						</p>
					</div>
				</div>
				<div class="form-horizontal" style="clear: both;">
					<h4>Background Music</h4>
					<label class="control-label" for="modal-level-properties-field-background-music">Initial Music</label>
					<div class="controls">
						<select id="modal-level-properties-field-background-music" style="width: 290px">
							<option value="-1">No music</option>
						</select> <button id="modal-level-properties-button-audition-music" class="btn"><i class="icon icon-play"></i></button>
					</div>
					<p class="help-block">You can change background music during the game by using advanced scripting.</p>
				</div>
			</div>

			<div class="tab-pane" id="modal-level-properties-tab-gameplay">
				<div class="form-horizontal">
					<h4>Time Limit</h4>
					<!--
					<div class="control-group">
						<label class="control-label" for="modal-level-properties-field-timelimit-enabled">Time limit enabled?</label>
						<div class="controls">
							<label class="checkbox">
								<input type="checkbox" id="modal-level-properties-field-timelimit-enabled" value="enabled"> Time limit countdown begins when level starts
							</label>
						</div>
					</div>
					-->
					<div class="control-group">
						<label class="control-label" for="modal-level-properties-field-timelimit-seconds">Count down from</label>
						<div class="controls">
							<!--<input type="number" min="0" max="15" step="1" class="input-mini" id="modal-level-properties-field-timelimit-minutes" value="1"> minutes -->
							<input type="number" min="0" step="5" class="input-mini" id="modal-level-properties-field-timelimit-seconds" value="30"> seconds							<p class="help-block">Remember: you can place items that grant time when picked up.</p>
						</div>
					</div>

						<!-- PLAYER props here -->

					<h4>Player</h4>
					<div class="control-group">
						<label class="control-label" for="modal-level-properties-field-starting-health">Starting Health </label>
						<div class="controls">
							<input type="number" min="5" max="500" step="5" class="input-mini" id="modal-level-properties-field-starting-health" value="100"> hitpoints						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="modal-level-properties-field-starting-lives">Starting Lives </label>
						<div class="controls">
							<input type="number" min="1" max="10" step="1" class="input-mini" id="modal-level-properties-field-starting-lives" value="3"> lives						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="modal-level-properties-field-starting-weapon">Starting Weapon</label>
						<div class="controls">
							<select id="modal-level-properties-field-starting-weapon" style="width: 320px">
								<option value="-1">No Weapon</option>
								<option value="4" selected>AK-47 (quick reload, mid-high damage)</option>
								<option value="0">Pistol (quick reload, low damage)</option>
								<option value="5">M60 (quick reload, high damage)</option>
								<option value="6">Rocket Propelled-Grenade (slow reload, mega damage)</option>
								<option value="1">Auto-Shotgun (quick reload, 3 low damage bullets)</option>
								<option value="2">Laser (fast reload, mid damage)</option>
								<option value="3">Musket (slow reload, big damage)</option>
							</select>
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="modal-level-properties-field-max-walking-speed">Max Walking Speed</label>
						<div class="controls">
							<input type="number" min="0" max="10" step=".05" class="input-mini" id="modal-level-properties-field-max-walking-speed" value="4"> pixels per second						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="modal-level-properties-field-infinite-jetpack">Jetpack</label>
						<div class="controls">
							<label class="checkbox">
								<input type="checkbox" id="modal-level-properties-field-infinite-jetpack" value="enabled"> Player starts with unlimited jetpack							</label>
						</div>
					</div>

					<div class="well" style="min-height: 150px; margin-bottom: 0; padding: 12px;">
						<div class="form-horizontal">
							<h4>Player Hit box</h4>
							<div style="background-color: #0CF; float: right;">
								<canvas id="modal-player-hitbox-canvas-preview" width="150" height="117" ></canvas>
							</div>
							<div style="width: 320px;" class="modal-player-hitboxes-config">
								<p class="help-block">Drag the hitbox around, or enter numbers below.<br><br></p>
								<div class="control-group" id="modal-player-offset-point">
									<!--<div class="nudge-indicator"><i class="icon icon-chevron-right"></i></div> -->
									<label class="control-label" for="modal-player-offset-point-x">offset points:</label>
									<div class="controls">
										<input type="number" id="modal-player-offset-point-x" value=45 style="width: 50px;"> <em>x</em>
										<input type="number" id="modal-player-offset-point-y" value=45 style="width: 50px;">
									</div>
								</div>
								<div class="control-group" id="modal-player-dimensions">
								<!--	<div class="nudge-indicator" style="display: none;"><i class="icon icon-chevron-right"></i></div> -->
									<label class="control-label" for="modal-player-dimensions-width">Width and height</label>
									<div class="controls">
										<input type="number" id="modal-player-dimensions-width" value=30 style="width: 50px;"> <em>x</em>
										<input type="number" id="modal-player-dimensions-height" value=95 style="width: 50px;">
									</div>
								</div>
							</div>
						</div>
					</div>

				<!--	<div class="well well-small">

						<div class="control-group">
							<label class="control-label" for="topdown-character-width">Sprite Size:</label>
							<div class="controls">
								<input type="number" min="0" step="5" class="input-mini" id="topdown-character-width" value="30"> - width  </input>
								&nbsp;&nbsp;
								<input type="number" min="0" step="5" class="input-mini" id="topdown-character-height" value="50"> - height</input>
							</div>
						</div>

						<div class="control-group">
							<label class="control-label" for="topdown-character-x-offset">Offset dimensions:</label>
							<div class="controls">
								<input type="number" min="0" step="5" class="input-mini" id="topdown-character-x-offset" value="55"> - x offset </input>
								<em> </em>
								<input type="number" min="0" step="5" class="input-mini" id="topdown-character-y-offset" value="70"> - y offset  </input>
							</div>
						</div>
					</div>

					-->

				</div>
			</div>

			<div class="tab-pane" id="modal-level-properties-tab-menu-editor">

				<p><button id="modal-level-properties-btn-menu-editor" class="btn btn-large btn-primary" style="width: 100%; height: 80px;">Open Menu Editor</button></p>

				<p>The <strong>Menu Editor</strong> is an uber powerful way to create an awesome opening screen for your game. </p>
				<ul>
					<li>Easy to use</li>
					<li>Make your game</li>
				</ul>
				<p><a href="/the-menu-editor/" target="_blank">Find out more <i class="icon icon-chevron-right"></i></a></p>

			</div>
		</div>
	</div>
	<div class="modal-footer">
		<span id="modal-level-properties-levelid" style="color: #f5f5f5;"></span>
		<div class="pull-right">
			<button id="modal-level-properties-cancel" class="btn close-modal">Cancel</button>
			<button id="modal-level-properties-save-changes" class="btn btn-primary"><i class="icon icon-white icon-ok"></i> Save Changes</button>
		</div>
	</div>
</div>
	<!-- PUBLISH MODAL -->
	<div id="modal-publish">

<div id="modal-publish-checklist" class="colorbox">
	<div class="modal-header">
		<h3>Publish Game</h3>
	</div>
	<div class="modal-body">
		<p>You think your game is ready to share with the world? Here's the bare essentials we need of your game before we begin.</p>
		<ul>
			<li id="modal-publish-checklist-player-character">
				<span class="badge badge-success"><i class="icon icon-white icon-ok"></i></span> <p>Game has a player character.</p>
			</li>
			<li id="modal-publish-checklist-endpoint">
				<span class="badge badge-warning"><i class="icon icon-white icon-remove"></i></span> <p>Game has an end-point. <a id="modal-publish-checklist-endpoint-help" href="#">Why?</a></p>
			</li>
			<li id="modal-publish-checklist-level-name">
				<span class="badge badge-success"><i class="icon icon-white icon-ok"></i></span> <p>Game has a name.<!-- <a id="modal-publish-checklist-level-name-change" href="#">Change Name</a> --></p>
				<p class="game-name"><strong>Name:</strong> <span class="level-name">Level Name</span></p>
			</li>
			<li id="modal-publish-checklist-level-description">
				<span class="badge badge-success"><i class="icon icon-white icon-ok"></i></span> <p>Game has a Description <!-- <a id="modal-publish-checklist-level-description-change" href="#">Change Description</a> --></p>
				<p class="game-description"><strong>Description:</strong> <span class="level-description">Level Description</span></p>
			</li>
		</ul>
		<div id="modal-publish-checklist-error" class="alert alert-error">
			<p><strong>There are things yet to be done.</strong> Please correct the above problems to continue publishing your game.</p>
		</div>
		<div id="modal-publish-checklist-success" class="alert alert-success" style="display: none;">
			<p>Good work. <em class="level-name">Level Name</em> is now publishable.</p>
			<p><strong>Note:</strong> your game is technically ready, but is it a good game? <a href="http://gamefroot.com/blog/how-to-make-good-games/" target="_blank">Find out more...</a></p>
		</div>
	</div>
	<div class="modal-footer">
		<button class="btn close-modal">Return to Editor</button>
		<div class="pull-right">
			<button id="modal-publish-checklist-btn-next" class="btn btn-primary">Next <i class="icon icon-white icon-chevron-right"></i></button>
		</div>
	</div>
</div>

<div id="modal-publish-brand" class="colorbox">
	<div class="modal-header">
		<h3>Publish Game</h3>
	</div>
	<div class="modal-body">
		<div class="control-group">
			<h4>Game Page URL</h4>
			<p>Your game should have a nice human-readable URL for you to share.</p>
			<p>
				<div class="input-prepend">
				<span class="add-on">http://gamefroot.com/games/</span><input type="text" style="width: 250px;" id="modal-publish-brand-field-url-slug" />
				<span id="modal-publish-brand-badge-url-slug"></span>
				</div>
			</p>
			<p>
				<span class="help-block">This URL will not work until the game is published. Once published, this cannot be changed.</span>
			</p>
		</div>
		<div class="control-group clearfix" style="margin-bottom: 10px;">
			<h4>Promo Graphic</h4>
			<div id="modal-publish-brand-img-promo-graphic" style="float: left; margin-top: 5px;"></div>
			<div style="margin-left: 135px;">
				<p>People might need to pick your game out in a crowd. How will your game look on the website?</p>
				<a id="modal-publish-brand-promo-graphic-change" href="#">Change Promo Graphic...</a>
			</div>
		</div>
		<div class="control-group clearfix">
			<h4>Set permissions for this game</h4>
			<label for="modal-publish-no-remix" class="checkbox">
				<input type="checkbox" id="modal-publish-no-remix" />
				Disable remix feature on this game				<a id="modal-publish-upgrade-no-remix" href='/go-pro/' target="_blank">Upgrade to access</a>
			</label>
		</div>
		
		<p>Once you're happy with the above, go ahead and publish your game.</p>
	</div>
	<div class="modal-footer">
		<button class="btn close-modal">Return to Editor</button>
		<div class="pull-right">
		<button id="modal-publish-brand-btn-back" class="btn btn-inverse"><i class="icon icon-white icon-chevron-left"></i> Back</button>
		<button id="modal-publish-brand-btn-next" class="btn btn-primary">Save and Publish Game <i class="icon icon-white icon-chevron-right"></i></button>
		</div>
	</div>
</div>

<div id="modal-publish-publishing" class="colorbox">
	<div class="modal-header">
		<h3>Publish Game</h3>
	</div>
	<div class="modal-body" style="text-align: center;">
		<h2 id="modal-publish-publishing-status">Publishing Game...</h2>
		<div class="progress progress-striped active"><div class="bar" style="width: 100%;"></div></div>
		<p id="modal-publish-publishing-message"></p>
	</div>
	<div class="modal-footer">
		<button id="modal-publish-publishing-btn-close" class="btn close-modal pull-right" style="display: none;">Close</button>
	</div>
</div>

<div id="modal-publish-share" class="colorbox">
	<div class="modal-header">
		<h3>Publish Game</h3>
	</div>
	<div class="modal-body" style="text-align: center;">
		<h2>Game Published!</h2>
		<p>Now get people playing it! Share it with your friends!</p>
		<p><input name="modal-publish-share-url" id="modal-publish-share-url" type="text" value="...fetching url..." style="width: 85%; text-align: center;"></p>
		<div>
			<a id="modal-publish-share-btn-facebook" class="btn btn-primary" href="#">Post to Facebook</a>
			<span id="modal-publish-share-btn-twitter"></span>
		</div>
	</div>
	<div class="modal-footer">
		<button id="modal-publish-share-btn-unpublish" class="btn btn-inverse">Unpublish...</button>
		<div class="pull-right">
		<button id="modal-publish-share-btn-next" class="btn close-modal">Done</button>
		</div>
	</div>
</div>

</div>
	<!-- LOAD LEVEL MODAL -->
	<div id="modal-open-level" class="colorbox">
	<div class="modal-header">
		<h3>Open Level</h3>
	</div>
	<div class="modal-body">
		<div id="modal-open-level-upgrading" class="alert">
			<img src="img/upgrading-older-games.gif" height="53" width="95" alt="" />
			<p>
				<strong>Some of your games are being upgraded.</strong>
				Don't worry, we're taking good care of them!				Come back in a few minutes			</p>
		</div>
		<div id="modal-open-level-list">

		</div>
	</div>
	<div class="modal-footer">
		<div class="pull-right">
			<button id="modal-open-level-cancel" class="btn close-modal">Cancel</button>
		</div>
	</div>
</div>
	<!-- SAVE LEVEL MODAL -->
	<div id="modal-save-level" class="colorbox">
	<div class="modal-header">
		<h3>Save Level</h3>
	</div>
	<div class="modal-body">
		<div id="level-list">
			<div class="form-vertical">
				<div class="control-group">
					<label class="control-label" for="modal-save-level-field-level-name">Level Name</label>
					<div class="controls">
						<input type="text" style="width: 490px;" id="modal-save-level-field-level-name">
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="modal-footer">
		<div class="pull-right">
			<button id="modal-save-level-cancel" class="btn close-modal">Cancel</button>
			<button id="modal-level-properties-btn-save" class="btn btn-primary"><i class="icon icon-white icon-ok"></i> Save</button>
		</div>
	</div>
</div>

<div id="modal-save-level-saving" class="colorbox">
	<div class="modal-header">
		<h3>Save Game</h3>
	</div>
	<div class="modal-body" style="text-align: center;">
		<h2 id="modal-save-level-saving-status">Saving Game...</h2>
		<div class="progress progress-striped active"><div class="bar" style="width: 100%;"></div></div>
		<p id="modal-save-level-saving-message"></p>
	</div>
	<div class="modal-footer">
		<button id="modal-save-level-saving-btn-close" class="btn close-modal pull-right" style="display: none;">Close</button>
	</div>
</div>

<div id="modal-save-level-previewing" class="colorbox">
	<div class="modal-header">
		<h3>Preview Game</h3>
	</div>
	<div class="modal-body" style="text-align: center;">
		<h2 id="modal-save-level-previewing-status">Building Preview...</h2>
		<div class="progress progress-striped active"><div class="bar" style="width: 100%;"></div></div>
		<p id="modal-save-level-previewing-message"></p>
	</div>
	<div class="modal-footer">
		<button id="modal-save-level-previewing-btn-close" class="btn close-modal pull-right" disabled="disabled">Close</button>
	</div>
</div>

	<!-- User LEVEL MODAL -->
	
<div id="login-modal" class="colorbox">
	<h2>So you want to make a game?</h2>
	<p>Make online and iPhone games and share them with your friends.</p>
	<div class="hr-seal"><img src="img/hr-seal.png" alt="" height="22" width="23" /></div>
	<div id="login-modal-login-options">
		<h3>Log in to start making games</h3>
		<div id="facebook-login">
			<!--FB Connect-->
			<div id="fb-holder"></div>
			<button id="fb-our-button" class="fb_our_button"></button>
		</div>
		<div id="login-modal-gamefroot-login-box">
			<div id="login-modal-gamefroot-login-button"></div>
			<div id="login-modal-wp-login-form" style="display:none;">
				<form id="login-modal-login-form" class="form-inline" action="/wp/wp-login.php" method="post">
					<div class="control-group"><input type="text" name="log" id="login-modal-field-user-login" class="input-medium" placeholder="Username" value=""/></div>
					<div class="control-group"><input type="password" name="pwd" id="login-modal-field-user-pass" class="input-medium" placeholder="Password" value=""/></div>
					<div id="login-modal-gamefroot-login-alerts"></div>
					<div class="control-group"><label class="checkbox"><input name="rememberme" type="checkbox" id="login-modal-field-rememberme" value="forever"> Remember me</label> <button type="submit" class="btn btn-primary" name="wp-submit" id="login-modal-btn-wp-login">Sign in</button></div>
					<div class="control-group">
						<a id="login-register" href="#">Register</a> |
						<span id="login-lost-password"><a href="/wp/wp-login.php?action=lostpassword">Lost your password</a></span>
					</div>
				</form>
			</div><!--#login-modal-login-form-->
		</div><!--#login-modal-gamefroot-login-box-->
		<p class="or">or</p>
	</div><!--#login-options-->
	<div id="login-modal-oldbrowsers" style="display: none;">
		<h3>Aww snap! Gamefroot needs a more modern web browser to run.</h3>
		<p>Please upgrade this browser to its latest version,<br> or get and use another browser to start making games.</p>
		<ul>
			<li class="browser-chrome">
				<a href="https://www.google.com/chrome/">Google Chrome</a>
			</li>
			<li class="browser-safari">
				<a href="http://www.apple.com/safari/">Safari</a>
			</li>
			<li class="browser-firefox">
				<a href="http://www.mozilla.com/en-US/firefox/firefox.html">Firefox</a>
			</li>
			<li class="browser-ie">
				<a href="http://windows.microsoft.com/en-US/internet-explorer/products/ie/home">Internet Explorer</a>
			</li>
		</ul>
	</div>
</div><!--#login-->

<div id="login-modal-register" class="colorbox" ><!-- action="/wp/wp-login.php?action=register"-->
	<div class="modal-header">
		<h3>Create a Gamefroot Account</h3>
	</div>
	<div class="modal-body">
		<p>So you want to make games huh? Alll you have to do is create a user account by completing the following form, once you have an account you'll be ready to make, play, and share your games</p>
		<div class="form-horizontal">
			<div class="control-group">
				<label class="control-label" for="login-modal-register-field-username">User Name</label>
				<div class="controls">
					<input class="span3" type="text" id="login-modal-register-field-username" placeholder="username" name="signup_username" />
					<span class="help-inline"></span>
				</div>
			</div>
			<div class="control-group">
				<label class="control-label" for="login-modal-register-field-email">Email Address</label>
				<div class="controls">
					<input class="span3" type="email" id="login-modal-register-field-email" placeholder="your@email.com" name="signup_email" />
					<span class="help-inline"></span>
				</div>
			</div>
			<div class="control-group">
				<label class="control-label" for="login-modal-register-field-password">Password</label>
				<div class="controls controls-row">
					<input class="span2" type="password" id="login-modal-register-field-password" placeholder="your password" name="signup_password" />
					<input class="span2" type="password" id="login-modal-register-field-password-confirm" placeholder="confirm password" name="signup_password_confirm" />
					<span class="help-inline"></span>
				</div>
			</div>
			<div id="login-modal-register-server-errors" class="control-group error" style="display: none;">
				<span class="help-inline">There would be an error here.</span>
			</div>			
		</div>
	</div>
	<div class="modal-footer">
		<button id="login-modal-register-btn-cancel" class="btn close-modal">
			Cancel		</button>
		<div class="pull-right">
			<button id="login-modal-register-btn-register" class="btn btn-primary" data-loading-text="Creating..." data-created-text="Created!" >
				Create My Account			</button>
		</div>
	</div>
</div><!--#register-->

	<!-- TERRAIN PROPERTIES MODAL -->
	<div id="terrain-properties" class="colorbox">
	<div class="modal-header">
		<h3>Terrain Properties</h3>
	</div><!--.modal-header-->
	<div class="modal-body">
		<div id="terrain-properties-container">
			<div class="form-item radio">
				<input id="properties-background" type="radio" name="terrain-type" value="TERRAIN_BACKGROUND"/>
				<label for="properties-background">Background</label>
			</div>
			<div class="form-item radio">
				<input id="properties-solid" type="radio" name="terrain-type" value="TERRAIN_SOLID"/>
				<label for="properties-solid">Solid</label>
			</div>
			<div class="form-item radio">
				<input id="properties-cloud" type="radio" name="terrain-type" value="TERRAIN_CLOUD"/>
				<label for="properties-cloud">Cloud</label>
			</div>
			<div class="form-item radio">
				<input id="properties-spike" type="radio" name="terrain-type" value="TERRAIN_SPIKE"/>
				<label for="properties-spike">Spike</label>
			</div>
			<div class="form-item radio hidden">
				<input id="properties-ice" type="radio" name="terrain-type" value="TERRAIN_ICE"/>
				<label for="properties-ice">Ice</label>
			</div>
			<div class="form-item radio hidden">
				<input id="properties-destructable" type="radio" name="terrain-type" value="TERRAIN_DESTRUCTABLE"/>
				<label for="properties-destructable">Destructable</label>
			</div>
		</div><!--#terrain-properties-container-->
		<div id="terrain-properties-description">
			<p>
				A <strong>background tile</strong> can be travelled through.			</p>
			<p>
				A <strong>solid tile</strong> blocks the character from travelling through it.			</p>
			<p>
				A <strong>cloud tile</strong> can be travelled past, but can also be walked on.			</p>
			<p>
				A <strong>spike tile</strong> is solid and kills the player when it is touched.			</p>
		</div>
	</div><!--.modal-body-->
	<div class="modal-footer">
		<div class="pull-right">
			<div id="cancel-terrain-properties" class="btn">
				Cancel			</div>
			<div id="save-terrain-properties" class="btn btn-primary">
				Save			</div>
		</div>
	</div>
</div><!-- #tile-properties -->
	<!-- ITEM PROPERTIES MODAL -->
	<div id="item-properties" class="colorbox">
	<div class="modal-header" style="padding-bottom:0; border-bottom: none;">
		<img class="item-image">
		<h3 style="margin-bottom:10px;"><span class="item-name">Item</span> Behaviour</h3>
		<div id="modal-item-properties-info-change-all-instances" style="display: none;">
			<h4>Change <em>ALL</em> Instances of this item</h4>
			<p>Any changes you make here will be made to all instances of this item.</p>
		</div>
		<div id="modal-item-properties-info-change-only-this-instance">
			<h4>Change only <em>THIS</em> instance</h4>
			<p>Any changes you make here will be made ONLY the instance you are editing.</p>
		</div>

		<ul class="nav nav-tabs" style="margin-bottom:0;" >
			<li class="active"><a id="item-simple-properties-tabbtn-simple" href='#item-simple-properties' data-toggle="tab">Simple</a></li>
			<li><a id="item-simple-properties-tabbtn-advanced" href='#item-advanced-properties' data-toggle="tab">Advanced</a></li>
		</ul>
	</div>
	<div class="modal-body tab-content" style="min-height: 370px;">
		<div id="item-simple-properties" class="tab-pane active">
			<div class="tabbable tabs-left">
				<ul class="nav nav-tabs" id="modal-item-properties-tabs-simple-behaviour" style="width: 106px;">
					<li data-behaviour-id="0"><a href="#modal-item-properties-tab-add-score" data-toggle="tab">Score<span class="current-behaviour"> • </span></a></li>
					<li data-behaviour-id="1"><a href="#modal-item-properties-tab-add-health" data-toggle="tab">Health<span class="current-behaviour"> • </span></a></li>
					<li data-behaviour-id="2"><a href="#modal-item-properties-tab-add-time" data-toggle="tab">Time<span class="current-behaviour"> • </span></a></li>
					<li data-behaviour-id="6"><a href="#modal-item-properties-tab-add-life" data-toggle="tab">Life<span class="current-behaviour"> • </span></a></li>
					<li data-behaviour-id="3"><a href="#modal-item-properties-tab-change-weapon" data-toggle="tab">Weapon<span class="current-behaviour"> • </span></a></li>
					<li class="divider"></li>
					<li data-behaviour-id="4"><a href="#modal-item-properties-tab-show-message" data-toggle="tab">Story Point<span class="current-behaviour"> • </span></a></li>
					<li data-behaviour-id="7"><a href="#modal-item-properties-tab-checkpoint" data-toggle="tab">Checkpoint<span class="current-behaviour"> • </span></a></li>
					<li data-behaviour-id="100"><a href="#modal-item-properties-tab-finish-level" data-toggle="tab">Finish Level<span class="current-behaviour"> • </span></a></li>
					<!--
					<li data-behaviour-id="5"><a href="#modal-item-properties-tab-" data-toggle="tab">Add Money</a></li>
					<li data-behaviour-id="8"><a href="#modal-item-properties-tab-" data-toggle="tab">God Mode</a></li>
					<li data-behaviour-id="9"><a href="#modal-item-properties-tab-" data-toggle="tab">Jet Pack</a></li>
					<li data-behaviour-id="10"><a href="#modal-item-properties-tab-" data-toggle="tab">Speed Boost</a></li>
					<li data-behaviour-id="11"><a href="#modal-item-properties-tab-" data-toggle="tab">Health Boost</a></li>
					<li data-behaviour-id="12"><a href="#modal-item-properties-tab-" data-toggle="tab">Jump Boost</a></li>
					<li data-behaviour-id="13"><a href="#modal-item-properties-tab-" data-toggle="tab">Armor Boost</a></li>
					<li data-behaviour-id="14"><a href="#modal-item-properties-tab-" data-toggle="tab">Add Artifact</a></li>
					<li data-behaviour-id="15"><a href="#modal-item-properties-tab-" data-toggle="tab">Random Effect</a></li>
					-->
				</ul>
				<div class="tab-content">
					<div id="modal-item-properties-tab-add-score" class="tab-pane active form-horizontal">
						<fieldset>
							<legend>Add Score</legend>
							<div class="control-group">
								<label class="control-label" for="modal-item-properties-field-add-score">Points to add</label>
								<div class="controls">
									<input type="number" class="input-mini" data-behaviour-id="0" id="modal-item-properties-field-add-score" min="-100000" max="100000" value="10" step="10">
									<p class="help-block">Positive to give points, negative to take points.</p>
								</div>
							</div>
						</fieldset>
					</div>
					<div id="modal-item-properties-tab-add-health" class="tab-pane form-horizontal">
						<fieldset>
							<legend>Add Health</legend>
							<div class="control-group">
								<label class="control-label" for="modal-item-properties-field-add-health">Health Points to add</label>
								<div class="controls">
									<input type="number" class="input-mini" data-behaviour-id="1" id="modal-item-properties-field-add-health" min="-100000" max="100000" value="25" step="5">
									<p class="help-block">Positive to give health, negative to cause damage.</p>
								</div>
							</div>
						</fieldset>
					</div>
					<div id="modal-item-properties-tab-add-time" class="tab-pane form-horizontal">
						<fieldset>
							<legend>Add Time</legend>
							<div class="control-group">
								<label class="control-label" for="modal-item-properties-field-add-time">Seconds to add</label>
								<div class="controls">
									<input type="number" class="input-mini" data-behaviour-id="2" id="modal-item-properties-field-add-time" min="-100000" max="100000" value="15" step="5">
									<p class="help-block">Positive to give seconds, negative to take seconds.</p>
								</div>
							</div>
						</fieldset>
					</div>
					<div id="modal-item-properties-tab-change-weapon" class="tab-pane form-horizontal">
						<fieldset>
							<legend>Change Weapon</legend>
							<div class="control-group">
								<label class="control-label" for="modal-item-properties-field-change-weapon">Give player a</label>
								<div class="controls">
									<select data-behaviour-id="3" id="modal-item-properties-field-change-weapon" style="width: 200px;">
										<option value="-1" selected="selected">-- Please select a weapon --</option>
										<option value="5">AK-47 (quick reload, mid-high damage)</option>
										<option value="1">Pistol (quick reload, low damage)</option>
										<option value="6">M60 (quick reload, high damage)</option>
										<option value="7">Rocket Propelled-Grenade (slow reload, mega damage)</option>
										<option value="2">Auto-Shotgun (quick reload, 3 low damage bullets)</option>
										<option value="3">Laser (fast reload, mid damage)</option>
										<option value="4">Musket (slow reload, big damage)</option>
									</select>
									<p class="help-block">If the player already has this weapon, they get an additional 75 ammo for that weapon.</p>
								</div>
							</div>
						</fieldset>
					</div>
					<div id="modal-item-properties-tab-add-life" class="tab-pane form-horizontal">
						<fieldset>
							<legend>Add Life</legend>
							<div class="control-group">
								<label class="control-label" for="modal-item-properties-field-add-life">Lives to add</label>
								<div class="controls">
									<input type="number" class="input-mini" data-behaviour-id="6" id="modal-item-properties-field-add-life" min="-10" max="10" value="1" step="1">
									<p class="help-block">Positive to give lives, negative to take lives.</p>
								</div>
							</div>
						</fieldset>
					</div>
					<div id="modal-item-properties-tab-show-message" class="tab-pane">
						<fieldset>
							<legend>Show Message</legend>
							<div class="control-group">
								<label class="control-label" for="modal-item-properties-field-show-message">Message to show the player</label>
								<div class="controls">
									<textarea data-behaviour-id="4" id="modal-item-properties-field-show-message" style="width: 360px; height: 90px;"></textarea>
									<p class="help-block">Use <strong>{slow} {talk} {fast} {pause}</strong> to control text display speed.</p>
								</div>
							</div>
						</fieldset>
					</div>
					<div id="modal-item-properties-tab-checkpoint" class="tab-pane">
						<fieldset>
							<legend>Checkpoint</legend>
							<div class="control-group">
								<div class="controls">
									<label class="checkbox">
										<input type="checkbox" data-behaviour-id="7" id="modal-item-properties-field-checkpoint" value="checkpoint">
										Record a checkpoint when this item is touched.									</label>
									<p class="help-block">When the player dies, they will respawn back at the last checkpoint they activated.</p>
								</div>
							</div>
						</fieldset>
					</div>
					<div id="modal-item-properties-tab-finish-level" class="tab-pane">
						<fieldset>
							<legend>Finish Level / Goal</legend>
							<div class="control-group">
								<div class="controls">
									<label class="checkbox">
										<input type="checkbox" data-behaviour-id="100" id="modal-item-properties-field-finish-level" value="finishlevel">
										Complete the game when this item is touched.									</label>
									<p class="help-block">You can use the advanced behaviour tools to take players to other levels, and display custom messages.</p>
								</div>
							</div>
						</fieldset>
					</div>

					<div style="text-align: center;"><button id="modal-item-properties-btn-make-active-behaviour" class="btn btn-success">Make this the active behaviour</button></div>
				</div>
			</div>
			<p class="help-block">The simple editor will only let you add one behavior per item. To add more, use the advanced tab.</p>
		</div><!--#item-simple-properties-->

		<div id="item-advanced-properties" class="tab-pane">
			<div id="item-advanced-properties-no-script">
				<p><button id="item-properties-add-script" class="btn btn-large btn-primary" style="width: 100%; height: 100px;">Add Advanced Behaviour</button>
				<p><strong>Advanced Behaviours</strong> are an uber-powerful way to extend your game by creating custom behaviours for your games.</p>
				<ul>
					<li>Easy &amp; fun to use</li>
					<li>Make your game unique</li>
					<li>Script your game to do almost anything</li>
				</ul>
				<p><a href="/the-advanced-behavior-editor/" target="_blank">Find out more <i class="icon icon-chevron-right"></i></a></p>
			</div> <!--#no-script-->

			<div id="item-advanced-properties-script" style="display: none;">
				<div id="item-advanced-properties-script-meta">
					<h3 id="item-advanced-properties-script-meta-name">...</h3>
					<p id="item-advanced-properties-script-meta-description">...</p>
					<button id="item-advanced-properties-script-edit" class="btn btn-primary"><i class="icon icon-white icon-wrench"></i> Edit Behaviour Script</button>
					<button id="item-advanced-properties-script-discard" class="btn btn-danger"><i class="icon icon-white icon-trash"></i> Remove</button>
					<div style="clear: both;">
						<div id="item-advanced-properties-script-instance-properties">
							<hr />
							<h4>Instance Properties</h4>
							<div id="item-advanced-properties-script-properties-data" class="form-horizontal">
							</div>
						</div>
					</div>
				</div>
			</div> <!--#script-->
		</div><!--#item-advanced-properties-->

	</div><!--.modal-body-->
	<div class="modal-footer">
		<div class="pull-right">
			<button id="modal-item-properties-btn-close" class="btn">Cancel</button>
			<button id="modal-item-properties-btn-save" data-unique-text="Change only this item" data-common-text="Change all of these items" class="btn btn-primary">Change all of these items</button>
		</div>
	</div><!--.modal-footer-->
</div><!-- #item-properties -->
	<!-- CHARATER PROPERTIES MODAL -->
	<div id="character-properties" class="colorbox">
	<div class="modal-header">
		<h2>Character Properties</h2>
	</div>
	<div class="modal-body">
		<div class="form-horizontal">
			<div class="control-group">
				<label class="control-label" for="character-name">Character name</label>
				<div class="controls">
					<input id="character-name" type="text">
				</div>
			</div>
			<div class="control-group">
				<label class="control-label" for="character-health">Health</label>
				<div class="controls">
					<input type="number" min="1" max="500" step="1" class="input-mini" id="character-health" maxlength="5"> hit points				</div>
			</div>
			<div class="control-group">
				<label class="control-label" for="character-speed">Walk Speed</label>
				<div class="controls">
					<input type="number" min="0" max="10000" step="1" class="input-mini" id="character-speed"> pixels per frame				</div>
			</div>

			<div class="control-group">
				<label class="control-label" for="character-speed">Enemy Behaviour</label>
				<div class="controls">
				
					<div class="btn-group" data-toggle="buttons-checkbox">
						<button id="character-walking" class="btn">Walk</button>
						<button id="character-shooting" class="btn">Shoot</button>
						<button id="character-jumping" class="btn">Jump</button>
					<!--	<button id="character-sight" class="btn">Line of Sight</button> -->
					</div>
				</div>
			</div>
			
		</div>
		<div class="form-inline">
			<h4>Collision Attacks</h4>
			<p class="help-block">When the player touches or is touched by this enemy...</p>
			<div class="control-group">
					<label class="control-label" for="character-collide-take">When touched by Player: Take</label>
					<input type="number" min="0" max="500" step="1" class="input-mini" id="character-collide-take" maxlength="5"> hp and 					<label class="control-label" for="character-collide-damage">deal Player </label>
					<input type="number" min="0" max="500" step="1" class="input-mini" id="character-collide-damage" maxlength="5"> hp			</div>
		</div>
		<div class="form-horizontal">
			<h4>Projectile Attacks</h4>
			<div class="control-group">
				<label class="control-label" for="character-bullet-type">Bullet Type</label>
				<div class="controls">
					<select id="character-bullet-type">
					</select>
				</div>
			</div>
			<div class="control-group">
				<label class="control-label" for="character-shot-delay">Salvo</label>
				<div class="controls">
					Every <input type="number" min="10" max="10000" step="1" class="input-mini" id="character-shot-delay"> ms shoot  <input type="number" min="0" max="10" step="1" class="input-mini" id="character-multishot"> bullets				</div>
			</div>
			<div class="control-group">
				<label class="control-label" for="character-bullet-damage">Bullet Damage</label>
				<div class="controls">
					<input type="number" min="0" max="500" step="1" class="input-mini" id="character-bullet-damage"> hit points				</div>
			</div>
			<div class="control-group">
				<label class="control-label" for="character-multishot-delay">Bullet Trigger Rate</label>
				<div class="controls">
					<input type="number" min="10" max="1000" step="1" class="input-mini" id="character-multishot-delay"> ms				</div>
			</div>
		</div>

	</div><!--.modal-body-->
	<div class="modal-footer">
		<div class="pull-right">
			<div id="cancel-character-properties" class="btn">
				Cancel			</div>
			<div id="save-character-properties" class="btn btn-primary">
				Save			</div>
		</div>
	</div><!--.modal-footer-->
</div><!-- #character-properties -->
	<!-- TOPDOWN CHARACTER PROPERTIES MODAL -->
	<div id="character-properties-topdown" class="colorbox">
	<div class="modal-header">
		<h2>Character Properties</h2>
	</div>
	<div class="modal-body">
		<div class="form-horizontal">
			<h4>Basic properties:</h4>
			<div class="well well-small">
				<div class="control-group">
				<label class="control-label" for="topdown-character-health">Character Health:</label>
					<div class="controls">
						<input type="number" min="0" step="5" class="input-mini" id="topdown-character-health" value="100"/> HP
					</div>
				</div>
				<div class="control-group">
				<label class="control-label" for="topdown-character-speed">Max walking speed:</label>
					<div class="controls">
						<input type="number" min="0" step="5" class="input-mini" id="topdown-character-speed" value="160"/>
					</div>
				</div>
				<div class="control-group">
				<label class="control-label" for="topdown-multishot">Multi shot number:</label>
					<div class="controls">
						<input disabled="disabled" type="number" min="0" step="1" class="input-mini" id="topdown-multishot" value="0"/>
					</div>
				</div>
				<div class="control-group">
				<label class="control-label" for="topdown-bullet-damage">Bullet Damage:</label>
					<div class="controls">
						<input disabled="disabled" type="number" min="0" step="5" class="input-mini" id="topdown-bullet-damage" value="0"/>
					</div>
				</div>
				<div class="control-group">
				<label class="control-label" for="topdown-collide-deal">Collide deal damage:</label>
					<div class="controls">
						<input type="number" min="0" step="5" class="input-mini" id="topdown-collide-deal" value="0"/>
					</div>
				</div>
				<div class="control-group">
				<label class="control-label" for="topdown-collide-take">Collide take damage:</label>
					<div class="controls">
						<input type="number" min="0" step="5" class="input-mini" id="topdown-collide-take" value="0"/>
					</div>
				</div>
				<div class="control-group">
				<label class="control-label" for="topdown-range">Perception range:</label>
					<div class="controls">
						<input type="number" min="0" step="5" class="input-mini" id="topdown-range" value="200"/> in px
					</div>
				</div>
				<div class="control-group">
				<label class="control-label" for="topdown-character-bullet-type">Bullet type:</label>
					<div class="controls">
						<select disabled="disabled" id="topdown-character-bullet-type" style="width: 150px">
								<option value="gun">Bullet</option>
								<option value="laser">Laser</option>
								<option value="ray">Ray</option>
								<option value="rocket">Rocket</option>
								<option value="homing">Homing Missile</option>	
						</select>
					</div>
				</div>
			</div>
			
			<h4>Sprite sizes</h4>
			<div class="well well-small">
				<div class="control-group">
					<label class="control-label" for="topdown-character-x-offset">Offset dimensions:</label>
					<div class="controls">
						<input type="number" min="0" step="5" class="input-mini" id="topdown-character-x-offset" value="55"/> - 
						x offset						<em> </em>
						<input type="number" min="0" step="5" class="input-mini" id="topdown-character-y-offset" value="70"/> - 
						y offset					</div>
				</div>

				<div class="control-group">
					<label class="control-label" for="topdown-character-width">Sprite Size:</label>
					<div class="controls">
						<input type="number" min="0" step="5" class="input-mini" id="topdown-character-width" value="30"/> - 
						width						&nbsp;&nbsp;
						<input type="number" min="0" step="5" class="input-mini" id="topdown-character-height" value="50"/> -
						height					</div>
				</div>

			</div>
		</div>
		
		<div class="form-horizontal">
			<div class="row-fluid">
				<h4>Flags and Movement:</h4>	
				
				<div class="span5">
 					<div class="well" style="height: 270px">
 						<div class="control-group">
 							Below you can select basic character behavior for this NPC. 						</div>
 						<label class="control-label" for="topdown-basic-behavior1" style="text-align: left">Primary Behaviour:</label>
 						<div class="control-group">
								<select id="topdown-basic-behavior1" style="width: 150px; align: left">
									<option value="ignore">None</option>
									<option value="flee">Flee from Player</option>
									<option value="chase">Chase Player</option>
									<option value="moveLeft">Move Left</option>
									<option value="moveRight">Move Right</option>
									<option value="moveUp">Move Up</option>
									<option value="moveDown">Move Down</option>
									<option value="ww_runRight">ww_runRight</option>
									<option value="ww_runLeft">ww_runLeft</option>
									
								</select>
						
						</div>
						<label class="control-label" for="topdown-basic-behavior2" style="text-align: left">Secondary Behavior:</label>
 						<div class="control-group">
								<select id="topdown-basic-behavior2" style="width: 150px; align: left">
									<option value="ignore">None</option>
									<option value="flee">Flee from Player</option>
									<option value="chase">Chase Player</option>
									<option value="moveLeft">Move Left</option>
									<option value="moveRight">Move Right</option>
									<option value="moveUp">Move Up</option>
									<option value="moveDown">Move Down</option>
									<option value="ww_runRight">ww_runRight</option>
									<option value="ww_runLeft">ww_runLeft</option>
								
								</select>
						
						</div>
						<label class="control-label" for="topdown-basic-behavior3" style="text-align: left">Tertiary Behavior:</label>
 						<div class="control-group">
								<select id="topdown-basic-behavior3" style="width: 150px; align: left">
									<option value="ignore">None</option>
									<option value="flee">Flee from Player</option>
									<option value="chase">Chase Player</option>
									<option value="moveLeft">Move Left</option>
									<option value="moveRight">Move Right</option>
									<option value="moveUp">Move Up</option>
									<option value="moveDown">Move Down</option>
									<option value="ww_runRight">ww_runRight</option>
									<option value="ww_runLeft">ww_runLeft</option>
								</select>
						
						</div>
 						
 						
 					</div>
 				</div>
				
  				<div class="span6">
  					<div class="well" style="height: 270px">
  					
  							<label class="checkbox">
	  							<input type="checkbox" id="topdown-can-jump" value="player_face">
	  							Can jump (applies to platform games only)	  						</label>
	  						<label class="checkbox">
	  							<input type="checkbox" id="topdown-cannot-attack" value="attack">
	  							Cannot attack	  						</label>
	  						<label class="checkbox">
	  							<input type="checkbox" id="topdown-backsight" value="back_look" checked="checked">
	  							Can see backwards	  						</label>
	  						<label class="checkbox">
	  							<input type="checkbox" id="topdown-regen-health" value="health_regen">
	  							Regenerates Healths	  						</label>
	  						<label class="checkbox">
	  							<input type="checkbox" id="topdown-robot-interact" value="interact">
	  							Can interact with robots	  						</label>
	  						<label class="checkbox">
	  							<input type="checkbox" id="topdown-god-mode" value="god_mode">
	  							Cannot be damaged	  						</label>
	  						<label class="checkbox">
	  							<input type="checkbox" id="topdown-can-roam" value="roam">
	  							Character has random movement	  						</label>
	  						<label class="checkbox">
	  							<input type="checkbox" id="topdown-nudge" value="nudge">
	  							Character can be nudged	  						</label>
	  						
  					</div>
  				</div>
  				
			</div>
		</div>
		
	</div>
	
	<div class="modal-footer">
		<div class="pull-right">
			<div id="cancel-character-properties-topdown" class="btn">
				Cancel			</div>
			<div id="save-character-properties-topdown" class="btn btn-primary">
				Save Changes			</div>
		</div>
	</div><!--.modal-footer-->
</div><!-- #character-properties -->
	<!-- WEAPONS MODAL -->
	
<div id="modal-weapons" class="colorbox">
	<div class="modal-header" style="padding-bottom: 0; border-bottom: none">
		<h3>Create New Weapon</h3>
		<ul class="nav nav-tabs" style="margin-bottom: 0;">
			<li class="active"><a href="#modal-weapons-tab-weapon" data-toggle="tab" data-tabid="weapon">Weapon</a></li>
			<li><a href="#modal-weapons-tab-bullet" data-toggle="tab" data-tabid="bullet">Bullet</a></li>
		</ul>
	</div><!--.modal-header-->
	<div class="modal-body" style="min-height: 400px;">

		<div class="tab-content">
			<div class="tab-pane active" id="modal-weapons-tab-weapon">
				<div class="control-group">
					<label class="control-label" for="modal-weapons-field-weapon-name">Weapon Name</label>
					<div class="controls">
						<input type="text" style="width: 490px;" id="modal-weapons-field-weapon-name">
					</div>
				</div>
				<form id="modal-weapons-form-weapon-graphic-upload" action="/?gamemakers_api=1&amp;type=upload_weapon_graphic" method="post" enctype="multipart/form-data">
					<div class="control-group">
						<label class="control-label" for="modal-weapons-field-weapon-graphic">Upload Custom Weapon Graphic</label>
						<div class="controls">
							<input class="input-file" id="modal-weapons-field-weapon-graphic" name="uploaded-file" type="file">
							<button class="btn" id="modal-weapons-button-upload-weapon-graphic" data-loading-text="Uploading...">Upload Weapon</button><br>
							<p class="help-block">Weapon must be a transparent PNG-32 no bigger than 117x150.</p>
						</div>
					</div>
				</form>
			</div>
			<div class="tab-pane" id="modal-weapons-tab-bullet">
				<div class="form-horizontal">
					<div class="control-group">
						<label class="control-label" for="modal-weapons-field-bullet">Bullet animation</label>
						<div class="controls">
							<select id="modal-weapons-field-bullet">
							</select>
						</div>
					</div>
					<form id="modal-weapons-form-bullet-graphic-upload" action="/?gfdl_api=1&amp;type=add-bullet" method="post" enctype="multipart/form-data">
						<div class="control-group">
							<label class="control-label" for="modal-weapons-field-bullet-graphic">Or Upload Custom Bullet Graphic</label>
							<div class="controls">
								<input class="input-file" id="modal-weapons-field-bullet-graphic" name="file" type="file">
								<button class="btn" id="modal-weapons-button-upload-bullet-graphic" data-loading-text="Uploading...">Upload Bullet</button><br>
								<p class="help-block">Bullet must be a transparent PNG-32 no bigger than 117x150.</p>
								<p id="modal-weapons-bullet-upload-required" class="help-block"><span class="text-warning">Please upload the bullet.</span></p>
							</div>
						</div>
					</form>
					<div class="control-group">
						<label class="control-label" for="modal-weapons-field-salvo-behaviour">Salvo Behaviour</label>
						<div class="controls">
							<select id="modal-weapons-field-salvo-behaviour">
								<option value="1">One Bullet</option>
								<option value="2">3-Bullet Spread</option>
								<option value="3">5-Bullet Spread</option>
								<option value="4">Double Tap (two shots quickly)</option>
								<option value="5">Double Barrel (two shots simultaneously)</option>
							</select> every <input type="number" min="10" max="5000" step="50" class="input-mini" id="modal-weapons-field-salvo-frequency"> ms
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="modal-weapons-field-bullet-speed">Bullet Speed</label>
						<div class="controls">
							<input type="number" min="1" max="300" step="1" class="input-mini" id="modal-weapons-field-bullet-speed" value="500"> pixels per second						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="modal-weapons-field-bullet-damage">Bullet Damage</label>
						<div class="controls">
							<input type="number" min="0" max="1000" step="5" class="input-mini" id="modal-weapons-field-bullet-damage" value="100"> hit points						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="well" style="min-height: 150px; margin-bottom: 0; padding: 12px;">
			<div class="form-horizontal">
				<h4>Weapon Positioning</h4>
				<div style="background-color: #0CF; float: right;">
					<canvas id="modal-weapons-canvas-preview" width="150" height="117" ></canvas>
				</div>
				<div style="float: left; width: 320px;">
					<p class="help-block">Drag the weapon and bullet around, or enter numbers below.<br><br></p>
					<div class="control-group" id="modal-weapons-fieldgroup-hand">
						<div class="nudge-indicator"><i class="icon icon-chevron-right"></i></div>
						<label class="control-label" for="modal-weapons-field-hand-point-x">Weapon Hand Point</label>
						<div class="controls">
							<input type="number" id="modal-weapons-field-hand-point-x" style="width: 50px;" value="10"> <em>x</em>
							<input type="number" id="modal-weapons-field-hand-point-y" style="width: 50px;" value="10">
						</div>
					</div>
					<div class="control-group" id="modal-weapons-fieldgroup-bullet">
						<div class="nudge-indicator" style="display: none;"><i class="icon icon-chevron-right"></i></div>
						<label class="control-label" for="modal-weapons-field-bullet-point-x">Bullet Spawn Point</label>
						<div class="controls">
							<input type="number" id="modal-weapons-field-bullet-point-x" style="width: 50px;" value="15"> <em>x</em>
							<input type="number" id="modal-weapons-field-bullet-point-y" style="width: 50px;" value="10">
						</div>
					</div>
				</div>
			</div>
		</div>

	</div><!--.modal-body-->
	<div class="modal-footer">
		<div class="pull-right">
			<button class="btn close-modal">
				Cancel			</button>
			<button id="modal-weapons-btn-save" class="btn btn-primary" data-loading-text="Saving..." data-saved-text="Saved!" >
				Save			</button>
		</div>
	</div>
</div>	
	<!-- ANIMATIONS MODAL -->
	
<!-- Terrain and Items -->
<form id="modal-upload-animation" class="colorbox" action="/?gfdl_api=1&amp;type=add-animation" method="post" enctype="multipart/form-data">
	<div class="modal-header">
		<h3>Upload animation from ZIP</h3>
	</div>
	<div class="modal-body">
		<div class="form-horizontal" id="modal-upload-animation-form">
			<div class="control-group">
				<label class="control-label" for="modal-upload-animation-zip">Zip File:</label>
				<div class="controls">
					<input class="input-file" id="modal-upload-animation-zip" name="animation" type="file">
					<p class="help-block">Zip files need to be:</p>
					<ul class="help-block">
						<li>Under 10MB in size (recommended under 1MB).</li>
						<li>Have the naming convention "&lt;sequenceName&gt;\&lt;sequenceName&gt;_&lt;number&gt;.png".</li>
						<li>Must have an idle sequence.</li>
					</ul>
				</div>
			</div>
			<input type="hidden" name="asset-type" value="item" />
		</div>
	</div>
	<div class="modal-footer">
		<div class="pull-right">
			<button class="btn close-modal">
				Cancel			</button>
			<button id="modal-upload-animation-btn-save" class="btn btn-primary" 
				data-loading-text="Uploading..." 
				data-saved-text="Uploaded!" 
				data-default-text="Upload" >
				Upload			</button>
		</div>
	</div>
</form>
	<!-- UPLOAD FORMS -->
	
<!-- Terrain and Items -->
<div id="modal-upload" class="colorbox">
	<div id="modal-upload-form-multi">
		<div class="modal-header" style="height: 45px;">
			<h3>Upload New Terrain</h3>
			<div id="modal-upload-status">No files queued for upload.</div>
		</div>
		<div class="modal-body" id="modal-upload-drop-target" style="min-height: 400px;">
			<div id="modal-upload-hints" style="text-align: center;padding-top: 140px;">
				<h3>Add Terrain Assets</h3>
				<p class="upload-instructions">Add multiple 48x48 Transparent PNG or GIF terrain tiles below.</p>
			</div>
			<div id="modal-upload-file-list"></div>
		</div>
		<div class="modal-footer">
			<a id="modal-upload-btn-browse" class="btn btn-primary"><i class="icon icon-white icon-plus"></i> Add Multiple Files</a>
			<button id="modal-upload-btn-upload" class="btn btn-success" disabled><i class="icon icon-white icon-ok-sign"></i> Start Upload</button>
			<span id="modal-upload-span-bytes-per-second"></span>
			<div class="pull-right">
				<button id="modal-upload-btn-done" class="btn close-modal" data-done-text="Done">Close</button>
			</div>
		</div>
	</div>
</div>

<!-- Characters -->
<div id="modal-upload-character" class="colorbox">
	<form id="modal-upload-character-form" action="/?uploadcharacter" method="post" enctype="multipart/form-data" style="margin-bottom: 0;">
		<input type="hidden" name="pack_id" id="modal-upload-character-field-pack_id" value="" />
		<input type="hidden" name="game_type" id="modal-upload-character-field-game_type" value="" />
		<div class="modal-header">
			<h3>Upload New Character</h3>
		</div>
		<div class="modal-body">
			<div class="control-group">
				<label class="control-label" for="modal-upload-character-field-character-graphic">Character Spritesheet</label>
				<div class="controls">
					<input class="input-file" id="modal-upload-character-field-character-graphic" name="charfile" type="file" accept="image/png">
					<div id="modal-upload-character-fieldhelp-character-graphic-platform">
						<p class="help-block">Characters must be a 1200x234 transparent PNG.</p>
						<p class="help-block">Artists: Only include weapons in your enemy character spritesheets. We dynamically add weapon graphics to player characters.</p>
					</div>
					<div id="modal-upload-character-fieldhelp-character-graphic-topdown">
						<p class="help-block">Characters must be a 1650x468 transparent PNG.</p>
					</div>
				</div>
			</div>
			<div id="modal-upload-character-group-enemy-weapon" class="control-group">
				<label class="control-label" for="modal-upload-character-field-enemy-weapon">When used as an enemy character, draw them with</label>
				<div class="controls">
					<select id="modal-upload-character-field-enemy-weapon" name="chosen-weapon" style="width: 320px">
						<option value="none" selected>No Weapon / Already drawn with weapon</option>
						<option value="4">AK-47 (quick reload, mid-high damage)</option>
						<option value="0">Pistol (quick reload, low damage)</option>
						<option value="5">M60 (quick reload, high damage)</option>
						<option value="6">Rocket Propelled-Grenade (slow reload, mega damage)</option>
						<option value="1">Auto-Shotgun (quick reload, 3 low damage bullets)</option>
						<option value="2">Laser (fast reload, mid damage)</option>
						<option value="3">Musket (slow reload, big damage)</option>
					</select>
				</div>
			</div>
		</div>
		<div class="modal-footer">
			<button id="modal-upload-character-btn-charcreator" class="btn btn-inverse">Character Creator</button>
			<div class="pull-right">
				<button class="btn close-modal">
					Cancel				</button>
				<button id="modal-upload-character-btn-save" class="btn btn-primary" data-loading-text="Saving..." data-saved-text="Saved!" >
					Save				</button>
			</div>
		</div>
	</form>
</div>

<!-- Music -->
<div id="modal-upload-music" class="colorbox">
	<form id="modal-upload-music-form" action="/?gamemakers_api=1&amp;type=add_bgmusic" method="post" enctype="multipart/form-data" style="margin-bottom: 0;">
		<input type="hidden" name="pack_id" id="modal-upload-music-field-pack_id" value="" />
		<div class="modal-header">
			<h3>Upload New Background Music</h3>
		</div>
		<div class="modal-body">
			<div class="control-group">
				<label class="control-label" for="modal-music-field-music-name">Track Title</label>
				<div class="controls">
					<input type="text" style="width: 490px;" id="modal-music-field-music-name" name="title">
				</div>
			</div>
			<div class="control-group">
				<label class="control-label" for="modal-upload-music-field-music-graphic">MP3 File</label>
				<div class="controls">
					<input class="input-file" id="modal-upload-music-field-music-graphic" name="file" type="file" accept="audio/mp3">
					<p class="help-block">File must be an MP3 smaller than 2MB in size. (Files up to 10MB are accepted, but not recommended)</p>
					<p class="help-block">Recommended encoding settings: Mono-channel MP3 128kbps Constant Bitrate (CBR) with 22,050Hz or 44,100Hz sample rate. Make your file as short and small as it can be, so that it downloads to gamers' devices quickly. Be sure our game engine loops your music as you intend.</p>
					<p class="help-block">Please only upload music that you have been granted legal permission to create with.</p>
				</div>
			</div>
		</div>
		<div class="modal-footer">
			<div class="pull-right">
				<button class="btn close-modal">
					Cancel				</button>
				<button id="modal-upload-music-btn-save" class="btn btn-primary" data-loading-text="Saving..." data-saved-text="Saved!" >
					Save				</button>
			</div>
		</div>
	</form>
</div>


<!-- Sound Effects -->
<div id="modal-upload-sound" class="colorbox">
	<form id="modal-upload-sound-form" action="/?gamemakers_api=1&amp;type=add_sound" method="post" enctype="multipart/form-data" style="margin-bottom: 0;">
		<input type="hidden" name="pack_id" id="modal-upload-sound-field-pack_id" value="" />
		<div class="modal-header">
			<h3>Upload New Sound Effect</h3>
		</div>
		<div class="modal-body">
			<div class="control-group">
				<label class="control-label" for="modal-sound-field-sound-name">Track Title</label>
				<div class="controls">
					<input type="text" style="width: 490px;" id="modal-sound-field-sound-name" name="title">
				</div>
			</div>
			<div class="control-group">
				<label class="control-label" for="modal-upload-sound-field-sound-file">MP3 File</label>
				<div class="controls">
					<input class="input-file" id="modal-upload-sound-field-sound-file" name="file" type="file" accept="audio/mp3">
					<p class="help-block">File must be an MP3 smaller than 2MB in size. (Files up to 10MB are accepted, but not recommended)</p>
					<p class="help-block">Recommended encoding settings: Mono-channel MP3 128kbps Constant Bitrate (CBR) with 22,050Hz or 44,100Hz sample rate. Make your file as short and small as it can be, so that it downloads to gamers' devices quickly. </p>
					<p class="help-block">Please only upload audio that you have been granted legal permission to create with.</p>
				</div>
			</div>
		</div>
		<div class="modal-footer">
			<div class="pull-right">
				<button class="btn close-modal">
					Cancel				</button>
				<button id="modal-upload-sound-btn-save" class="btn btn-primary" data-loading-text="Saving..." data-saved-text="Saved!" >
					Save				</button>
			</div>
		</div>
	</form>
</div>

<!-- Bullets -->
<div id="modal-upload-bullet" class="colorbox">
	<form id="modal-upload-bullet-form" action="/?gfdl_api=1&amp;type=add-bullet" method="post" enctype="multipart/form-data">
		<input type="hidden" name="pack_id" id="modal-upload-bullet-field-pack_id" value="" />
		<div class="modal-header">
			<h3>Upload New Bullet</h3>
		</div>
		<div class="modal-body">
			<div class="control-group">
				<label class="control-label" for="modal-bullet-field-bullet-name">Bullet Name</label>
				<div class="controls">
					<input type="text" id="modal-bullet-field-bullet-name" name="title">
				</div>
			</div>
			<div class="control-group">
				<label class="control-label" for="modal-upload-bullet-field-bullet-file">Bullet image</label>
				<div class="controls">
					<input class="input-file" id="modal-upload-bullet-field-bullet-file" name="file" type="file" accept="image/*">
					<p class="help-block">File must be an image smaller than 2MB in size (Files up to 10MB are accepted, but not recommended). Transparent PNG's work best, but GIF's and jpeg's are accepted</p>
					<p class="help-block">Please only upload images that you have been granted legal permission to create with.</p>
				</div>
			</div>
		</div>
		<div class="modal-footer">
			<div class="pull-right">
				<button class="btn close-modal">
					Cancel				</button>
				<button id="modal-upload-bullet-btn-save" class="btn btn-primary" data-loading-text="Saving..." data-saved-text="Saved!" >
					Save				</button>
			</div>
		</div>
	</form>
</div>

	<!-- MARKETPLACE -->
	<div id="modal-marketplace" class="colorbox">
	<div class="modal-header">
		<h3>World War II: Characters</h3>
	</div>
	<div class="modal-body" style="height: 280px;">
			<div id="modal-marketplace-pack-contents" class="asset-pack">

			</div>
	</div>
	<div class="modal-footer" style="height: 122px;">
		<div class="pull-right" style="width: 150px; margin-left: 20px">
			<button id="modal-marketplace-buy-now" class="btn btn-block btn-primary">25 Credits</button>
			<small>This pack contains:</small>
			<p style="font-size: 85%;" id="modal-marketplace-contents-list"></p>
		</div>
		<div id="modal-marketplace-pack-description" class="description" style="max-height: 125px; overflow-y: scroll;"></div>
	</div>
</div>	<div id="modal-marketplace-publish">

<div id="modal-marketplace-publish-checklist" class="colorbox">
	<div class="modal-header">
		<h3>Publish Asset Pack</h3>
	</div>
	<div class="modal-body">
		<p><strong>BETA FEATURE</strong></p>
		<p>We can list your pack on the marketplace for all Gamefroot game designers to use in their games.</p>
		<p>There are some things that we need you to be aware of:</p>
		<ul>
			<li>You allow Gamefroot to SHARE the pack contents with other users for their use.</li>
			<li>You allow Gamefroot users to CREATE new works using the pack contents.</li>
			<li>You MUST hold the legal rights to GRANT these permissions for the pack contents.</li>
			<li>This is PERMANENT. A pack can be removed from the marketplace, but this people who obtain a pack can continue to use its contents.</li>
			<li>Content that is offensive (according to our terms of service) will be removed by Gamefroot.</li>
		</ul>
		<p>Continue only if you agree to the above.</p>
	</div>
	<div class="modal-footer">
		<button class="btn close-modal">Return to Editor</button>
		<div class="pull-right">
			<button id="modal-marketplace-publish-checklist-btn-next" class="btn btn-primary">Next <i class="icon icon-white icon-chevron-right"></i></button>
		</div>
	</div>
</div>

<div id="modal-marketplace-publish-describe" class="colorbox">
	<div class="modal-header">
		<h3>Publish Asset Pack</h3>
	</div>
	<div class="modal-body form-horizontal">
		<h4>Asset Pack Details</h4>
		<p>Describe your pack well so it can be found easily. Be sure to use correct spelling and capitalisation.</p>
		<div class="control-group">
			<label class="control-label" for="modal-marketplace-publish-describe-field-pack-name">Pack Name</label>
			<div class="controls">
				<input type="text" style="width: 320px;" id="modal-marketplace-publish-describe-field-pack-name">
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="modal-marketplace-publish-describe-field-pack-description">Pack Description</label>
			<div class="controls">
				<textarea type="text" style="width: 320px;" id="modal-marketplace-publish-describe-field-pack-description" rows="3"></textarea>
			</div>
		</div>
		<div class="control-group clearfix" style="margin-bottom: 10px;">
			<div style="float: left; margin-top: 5px;">
				<ul class="packs">
					<li>
						<a href="#">
							<div class="pack">
								<div class="pack-icon" id="modal-marketplace-publish-describe-icon-container"></div>
							</div>
							<div id="modal-marketplace-publish-form-pack-name" class="pack-name">Pack Name Here</div>
						</a>
					</li>
				</ul>
			</div>
			<div class="controls">
				<h4>Pack Icon</h4>
				<form class="control-group" id="modal-marketplace-publish-form-pack-icon" action="/?pack-handler-api=1&amp;type=upload-pack-icon" method="post" enctype="multipart/form-data">
					<input type="hidden" name="pack_id" id="modal-marketplace-publish-field-pack_id" value="" />
					<input class="input-file" id="modal-marketplace-publish-field-pack-icon" name="uploaded-file" type="file">
					<p style="margin-top: 10px;">
						<button type="submit" class="btn btn-mini" id="modal-marketplace-publish-button-upload-pack-icon">Upload Pack Icon</button>
					</p>
					<p class="help-block">The icon must be an 81x81 transparent PNG. The crate pattern will show through any transparent areas.</p>
				</form>
			</div>
		</div>
	</div>
	<div class="modal-footer">
		<button class="btn close-modal">Return to Editor</button>
		<div class="pull-right">
			<button id="modal-marketplace-publish-describe-btn-back" class="btn btn-inverse"><i class="icon icon-white icon-chevron-left"></i> Back</button>
			<button id="modal-marketplace-publish-describe-btn-next" class="btn btn-primary">Next <i class="icon icon-white icon-chevron-right"></i></button>
		</div>
	</div>
</div>

<div id="modal-marketplace-publish-price" class="colorbox">
	<div class="modal-header">
		<h3>Publish Asset Pack</h3>
	</div>
	<div class="modal-body form-horizontal">
		<h4>Price Your Pack</h4>
		<p>We can sell your asset pack to other Gamefroot users, and you can get paid!</p>
		<table width="100%" cellpadding="0" cellspacing="0">
			<tr>
				<td width="50%" valign="top">
					<label class="radio">
						<input type="radio" name="pack-pricing" id="modal-marketplace-publish-price-pack-pricing-free" value="free" checked>
						Available for Free					</label>
				</td>
				<td width="50%" valign="top">
				<div id="modal-marketplace-publish-price-form-price-points">
					<p>Selling for a price requires an active Master subscription. <!-- <a href="#">Upgrade to Master</a> --> </p>
				</td>
			</tr>
		</table>
	</div>
	<div class="modal-footer">
		<button class="btn close-modal">Return to Editor</button>
		<div class="pull-right">
			<button id="modal-marketplace-publish-price-btn-back" class="btn btn-inverse"><i class="icon icon-white icon-chevron-left"></i> Back</button>
			<button id="modal-marketplace-publish-price-btn-next" class="btn btn-primary">Publish <i class="icon icon-white icon-chevron-right"></i></button>
		</div>
	</div>
</div>



<div id="modal-marketplace-publish-publishing" class="colorbox">
	<div class="modal-header">
		<h3>Publish Asset Pack</h3>
	</div>
	<div class="modal-body" style="text-align: center;">
		<h2 id="modal-marketplace-publish-publishing-status">Publishing Pack...</h2>
		<div class="progress progress-striped active"><div class="bar" style="width: 100%;"></div></div>
		<p id="modal-marketplace-publish-publishing-message"></p>
	</div>
	<div class="modal-footer">
		<button id="modal-marketplace-publish-publishing-btn-close" disabled="disabled" class="btn close-modal pull-right">Close</button>
	</div>
</div>

</div>
	<!-- ABOUT MODAL -->
	<div id="about-gamefroot" class="colorbox">
	<div class="modal-header" style="padding-bottom: 0; border-bottom: none">
		<h3>About Gamefroot</h3>
	</div><!--.modal-header-->
	<div class="modal-body">
		<h4>About Gamefroot</h4>

		<p>An HTML5 based online game creator for making platform and top down games.</p>

		<p>
			Gamefroot is the worlds easiest to use game creator and allows fast track creation 
			of online games, and soon mobile games!
		</p>

		<p>
			Gamefroot games are currently powered by the mighty Flixel game engine <small>*cough* </small> until we replace 
			it with the upcoming HTML5 game engine that we're secretly working on! Look at it here <a href="http://www.kiwijs.org"> Kiwi.js </a>
		</p>

		<a href="/support/" target="_blank">Report an issue</a>
		<p>&nbsp;</p>

		<h4>Gamefroot Change Log</h4>
		<br />
		<strong><b>Hotfix - 1.22 - release notes</b></strong> <br />
			<strong> Fixes </strong>
			<div class="about indent">
				<ul>
					<li> Fixed Ghost packs </li>
				</ul>
			</div>	
			<strong> Info </strong>	
			<div class="about indent">
				<ul>
					<li> Removed template games for maintenance </li>
				</ul>
			</div>	
			<br />		
			<br />		
			<br />		
			<br />		
			<br />		
	</div>
	<div class="modal-footer">
		<div class="pull-right">
			<button class="btn close-modal">
				Close			</button>
		</div>
	</div>
</div>

	<!-- MODAL ALERT -->
	<div id="modal-alert" class="colorbox">
	<div class="modal-header"> <!-- style="padding-bottom: 0; border-bottom: none"> -->
		<h3>Modal Alert</h3>
	</div><!--.modal-header-->
	<div class="modal-body">
		<h4>Modal Content</h4>
	</div>
	<div class="modal-footer">
		<div class="pull-right buttons">
			<button class="btn close-modal">Close</button>
		</div>
	</div>
</div>

	<!-- NEW LEVEL MODAL -->
	<div id="modal-new-level" class="colorbox">
	<div class="modal-header">
		<h3>Create New Game</h3>
	</div><!-- .modal-header -->
	
	<div class="modal-body">
		<h4>Blank Game</h4>
		<button id="modal-new-level-platformer" class="btn"><i class="glyphicon glyphicon-cloud"></i>Blank Platformer</button>
		<button id="modal-new-level-top-down" class="btn"><i class="glyphicon glyphicon-tower"></i>Blank Top-Down</button>
		
		<h4>From Template</h4>
		<div class="alert">			
			<p> We've temporarily removed template games for maintenance. They'll be back! </p>
		</div>
		<ul id="template-list">
			<!--<li>Loading</li>-->
		</ul>
	</div><!-- .modal-body -->
	
	<div class="modal-footer">
		<div class="pull-right">
			<button id="modal-new-level-load" class="btn">Load a saved level...</button>
			<!--<button id="new-level-template" class="btn btn-primary">Open Template</button>-->
		</div>
	</div><!-- .modal-footer -->
</div>	
	<!-- BACKDROP MODAL -->
	<div id="modal-backdrop" class="colorbox">
	<div class="modal-header" style="padding-bottom: 0; border-bottom: none">
		<h2>Backdrop Editor</h2>
	</div>
	<div class="modal-body">
		<canvas id="modal-backdrop-preview" height="512" width="768" ></canvas>
		<div id="modal-backdrop-heading" class="control-group">
			<h4>Backdrop Name</h4>
			<input id="modal-backdrop-name" type="text" />
		</div>
		<div id="modal-backdrop-controls">
			<div id="modal-backdrop-parallax-info" class="alert alert-info">
				<button type="button" class="close" data-dismiss="alert">x</button>
				You can have <strong>multiple layers</strong> in a backdrop to acheive a <strong>parallax</strong> effect			</div>
			
			<div class="backdrop-controls form-horizontal">
				<div id="modal-backdrop-layer-1" class="modal-backdrop-layer">
					<div class="control-group">
						<h4>Background</h4>
						<label for="modal-backdrop-visible-1" class="control-label visible">Visible</label>
						<div class="controls">
							<input id="modal-backdrop-visible-1" type="checkbox" checked="checked"/>
						</div>
					</div>
					
					<form id="modal-backdrop-upload-bg-1" action="/?gfdl_api=1&type=upload-sprite">
						<input type="file" id="modal-backdrop-upload-file-1" name="uploaded-file" data-layer="1" />
						<input type="submit" class="btn btn-small bg-upload" id="modal-backdrop-select-image-1" data-loading-text="Uploading..." type="submit" value="Upload image" />
					</form>
					
					<div class="btn-group" data-toggle="buttons-checkbox">
						<button id="modal-backdrop-repeat-horizontal-1" type="button" class="btn btn-mini">Repeat horizontally</button>
						<button id="modal-backdrop-repeat-vertical-1" type="button" class="btn btn-mini">Repeat vertically</button>
					</div>
					<div class="control-group">
						<div class="controls">
							<label for="modal-backdrop-horizontal-scroll-speed-1" class="control-label">x speed</label>
							<input id="modal-backdrop-horizontal-scroll-speed-1" type="number" maxlength="3" />
						</div>
						<div class="controls">
							<label for="modal-backdrop-vertical-scroll-speed-1" class="control-label">y speed</label>
							<input id="modal-backdrop-vertical-scroll-speed-1" type="number" maxlength="3" />
						</div>
					</div>
					<div class="control-group">
						<div class="controls">
							<label for="modal-backdrop-horizontal-offset-1" class="control-label">x pos</label>
							<input id="modal-backdrop-horizontal-offset-1" type="number" maxlength="3" data-layer="1"/>
						</div>
						<div class="controls">
							<label for="modal-backdrop-vertical-offset-1" class="control-label">y pos</label>
							<input id="modal-backdrop-vertical-offset-1" type="number" maxlength="3" data-layer="1"/>
						</div>
					</div>
				</div>
			
				<div id="modal-backdrop-layer-2" class="modal-backdrop-layer">
					<div class="control-group">
						<h4>Midground</h4>
						<label for="modal-backdrop-visible-2" class="control-label visible">Visible</label>
						<div class="controls">
							<input id="modal-backdrop-visible-2" type="checkbox" checked="checked"/>
						</div>
					</div>
					
					<form id="modal-backdrop-upload-bg-2" action="/?gfdl_api=1&type=upload-sprite">
						<input type="file" id="modal-backdrop-upload-file-2" name="uploaded-file" data-layer="2" />
						<button class="btn btn-small bg-upload" id="modal-backdrop-select-image-2" data-loading-text="Uploading..." type="button">Upload image</button>
					</form>
					
					<div class="btn-group" data-toggle="buttons-checkbox">
						<button id="modal-backdrop-repeat-horizontal-2" type="button" class="btn btn-mini">Repeat horizontally</button>
						<button id="modal-backdrop-repeat-vertical-2" type="button" class="btn btn-mini">Repeat vertically</button>
					</div>
					<div class="control-group">
						<div class="controls">
							<label for="modal-backdrop-horizontal-scroll-speed-2" class="control-label">x speed</label>
							<input id="modal-backdrop-horizontal-scroll-speed-2" type="number" maxlength="3" />
						</div>
						<div class="controls">
							<label for="modal-backdrop-vertical-scroll-speed-2" class="control-label">y speed</label>
							<input id="modal-backdrop-vertical-scroll-speed-2" type="number" maxlength="3" />
						</div>
					</div>
					<div class="control-group">
						<div class="controls">
							<label for="modal-backdrop-horizontal-offset-2" class="control-label">x pos</label>
							<input id="modal-backdrop-horizontal-offset-2" type="number" maxlength="3" data-layer="2"/>
						</div>
						<div class="controls">
							<label for="modal-backdrop-vertical-offset-2" class="control-label">y pos</label>
							<input id="modal-backdrop-vertical-offset-2" type="number" maxlength="3" data-layer="2"/>
						</div>
					</div>
				</div>
				
				<div id="modal-backdrop-layer-3" class="modal-backdrop-layer">
					<div class="control-group">
						<h4>Foreground</h4>
						<label for="modal-backdrop-visible-3" class="control-label visible">Visible</label>
						<div class="controls">
							<input id="modal-backdrop-visible-3" type="checkbox" checked="checked"/>
						</div>
					</div>
					
					<form id="modal-backdrop-upload-bg-3" action="/?gfdl_api=1&type=upload-sprite">
						<input type="file" id="modal-backdrop-upload-file-3" name="uploaded-file" data-layer="3"/>
						<button class="btn btn-small bg-upload" id="modal-backdrop-select-image-3" data-loading-text="Uploading..." type="button">Upload image</button>
					</form>
					
					<div class="btn-group" data-toggle="buttons-checkbox">
						<button id="modal-backdrop-repeat-horizontal-3" type="button" class="btn btn-mini">Repeat horizontally</button>
						<button id="modal-backdrop-repeat-vertical-3" type="button" class="btn btn-mini">Repeat vertically</button>
					</div>
					<div class="control-group">
						<div class="controls">
							<label for="modal-backdrop-horizontal-scroll-speed-3" class="control-label">x speed</label>
							<input id="modal-backdrop-horizontal-scroll-speed-3" type="number" maxlength="3" />
						</div>
						<div class="controls">
							<label for="modal-backdrop-vertical-scroll-speed-3" class="control-label">y speed</label>
							<input id="modal-backdrop-vertical-scroll-speed-3" type="number" maxlength="3" />
						</div>
					</div>
					<div class="control-group">
						<div class="controls">
							<label for="modal-backdrop-horizontal-offset-3" class="control-label">x pos</label>
							<input id="modal-backdrop-horizontal-offset-3" type="number" maxlength="3" data-layer="3"/>
						</div>
						<div class="controls">
							<label for="modal-backdrop-vertical-offset-3" class="control-label">y pos</label>
							<input id="modal-backdrop-vertical-offset-3" type="number" maxlength="3" data-layer="3" />
						</div>
					</div>
				</div>

			</div>
		</div>
	</div>
	<div class="modal-footer">
		<div class="pull-right">
			<button id="modal-backdrop-cancel" class="btn close-modal">Cancel</button>
			<button id="modal-backdrop-save-changes" class="btn btn-primary"><i class="icon icon-white icon-ok"></i> Save Changes</button>
		</div>
	</div>
</div>
	<!-- DEVIANTART MURO MODAL -->
	
<div class="muro-container">
	<div class="muro-loading">
		<div class="muro-loading-inner"><div class="loading inline"></div>Loading deviantART muro...</div>
	</div>
	<iframe class="muro"></iframe>
</div>

	<!-- DEVIANTART STASH MODAL -->
	
<div id="modal-da-stash-import" class="colorbox">
	<div class="modal-header" style="padding-bottom: 0; border-bottom: none">
		<h3>Import Sta.sh Image To Asset Pack</h3>
		<p>Import this image as an <strong>Item</strong> to which of your asset packs?</p>
	</div><!--.modal-header-->
	<div class="modal-body" style="min-height: 400px;">
		<ul id='modal-da-stash-import-packs' class='packs'></ul>
	</div><!--.modal-body-->
	<div class="modal-footer">
		<div class='pull-left'>
			<label>
				<input type="checkbox" name="modal-da-stash-import-input-add-to-game" id="modal-da-stash-import-input-add-to-game" checked='checked' value='1'> Add selected asset pack to game			</label>
		</div>
		<div class="pull-right">
			<button class="btn close-modal">
				Cancel			</button>
			<button id="modal-da-stash-import-btn-import" class="btn btn-primary" data-loading-text="Importing..." data-saved-text="Imported!" >
				Import to Pack			</button>
		</div>
	</div>
</div>
	<!-- iPhone DOWNLOAD MODAL -->
	<div id="iphone-modal" class="colorbox">
	<div class="modal-header">
		<h3>Download to iPhone</h3>
	</div>
	<div class="modal-body">
		<h4>Download Files</h4>
		<div id="iphone-modal-unsaved" class="alert alert-error">
			Please save your game before downloading		</div>
		<p>First download the Gamefroot Xcode file and your Level zip file.</p>
		<button id="iphone-download-xcode" class="btn">Download Xcode file</button>
		<button id="iphone-download-zip" class="btn">Download Level Zip file</button>
		
		<h4>Compile Xcode IPA</h4>
		<p>To turn these files into an iPhone app, you will need Xcode (or an equivalent iPhone compilier).</p>
		<p>Read this guide on compiling the IPA.</p>
		
		<h4>Distribute your iPhone Game</h4>
		<p>Read these instructions on installing your own Apps to iPhone via iTunes.</p>
		<p>Read this article that explains how to submit an App to the iTunes App Store.</p>
	</div>
	<div class="modal-footer">
		<div class="pull-right">
			<button id="iphone-close" class="btn btn-primary">Done</button>
		</div>
	</div>
</div>	
	<!-- Pack selector -->
	
<div id="modal-pack-selector" class="colorbox">
	<div class="modal-header" style="padding-bottom: 0; border-bottom: none">
		<h3>Which pack would you like this asset to go to?</h3>
		<p> </p>
	</div><!--.modal-header-->
	<div class="modal-body" style="min-height: 400px;">
		<ul id='modal-pack-selector-packs' class='packs'></ul>
	</div><!--.modal-body-->
	<div class="modal-footer">
		<div class='pull-left'>
			<label>
				<input type="checkbox" name="modal-pack-selector-add-to-game" id="modal-pack-selector-input-add-to-game" checked='checked' value='1'> Add selected asset pack to game			</label>
		</div>
		<div class="pull-right">
			<button class="btn close-modal">
				Cancel			</button>
			<button id="modal-pack-selector-btn-import" class="btn btn-primary" data-loading-text="Importing..." data-saved-text="Imported!" >
				Import to Pack			</button>
		</div>
	</div>
</div>	
	<!-- robot instance properties -->
	
<div id="instance-editor-background">
</div>

<div id="instance-editor" class="form-horizontal">
	<div class="modal-header">
		<button type="button" class="close" aria-hidden="true">&times;</button>
		<div id="instance-editor-heading">
			<img alt="no preview" width="32" height="32"/>
			<h4>undefined</h4>
		</div>
	</div>
	<div class="modal-body">
	</div>
	<div class="modal-footer instanceEditorFooter">
		<a href="#" id="instance-goto-script" class="btn btn-left"><i class="icon-share-alt"></i>Go to Script</a>
		<a href="#" class="btn btn-primary save pull-right"><b>Save Item Variables</b></a>
	</div>
</div>

	<!-- Le javascript
	================================================== -->
	<!-- Placed at the end of the document so the pages load faster -->
	
			<!-- elsewhere -->
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
	
	<script type="text/javascript" src="/js/socket.io.js"></script>

	<!-- Libraries -->
			<!-- elsewhere -->
		<script type="text/javascript" src="http://netdna.bootstrapcdn.com/twitter-bootstrap/2.3.1/js/bootstrap.min.js"></script>
		<script type="text/javascript" src="../js/corelibraries.js"></script>				
		<script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
	


	
	<!--[if lte IE 9]>
	<script type="text/javascript" src="../js/jquery.placeholder.min.js?v=release-1.28"></script>
	<![endif]-->

	<!-- Language Strings -->
	<script type="text/javascript" src="js/translation.php?v=release-1.28"></script>
			<script type="text/javascript" src="http://doublehappy.s3.amazonaws.com/gamefroot-js-files/base.min.js?v=release-1.28"></script>			
		<script type="text/javascript" src="http://platform.twitter.com/widgets.js?v=release-1.28"></script>	
		<script type="text/javascript" src="http://gamefroot.com/wp-content/plugins/da-stash/da-stash.js?v=release-1.28"></script>
	
	<!-- require.js for beginning the move, and the pain :(... too many ajax requests!! -->

	<script type="text/javascript" src="http://gamefroot.com/js/require.js"></script>
	<script type="text/javascript">
		requirejs.config({
			baseUrl: "http://doublehappy.s3.amazonaws.com/gamefroot-js-files/",
			paths: {
				bootstraptour: 'http://gamefroot.com/js/bootstrap-tour',
				plupload: 'http://gamefroot.com/js/plupload/plupload.full',
				underscore: "//cdnjs.cloudflare.com/ajax/libs/underscore.js/1.5.1/underscore-min",
				backbone: "//cdnjs.cloudflare.com/ajax/libs/backbone.js/1.1.0/backbone-min"
			},
			shim: {
				underscore: {
					exports: "_"
				},
				backbone: {
					deps: ["underscore"],
					exports: "Backbone"
				},				
			},
			onstart: function(){				
				$("body").addClass('waiting');
				setTimeout(function(){
					$("body").removeClass('waiting');
				}, 5000)
			},
			onload: function(){
				$("body").removeClass('waiting');
			}
		});	
	</script>

  </body>
</html>
