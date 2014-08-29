
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
	<head>
		<title>jGen Map Editor</title>
		<link rel="stylesheet" type="text/css" href="http://jgen.googlecode.com/svn/branches/map-editor/css/stylesheet.css" />
		<script type="text/javascript" src="http://jgen.googlecode.com/svn/branches/map-editor/scripts/oop.js"></script>
		<script type="text/javascript" src="http://jgen.googlecode.com/svn/branches/map-editor/scripts/string.js"></script>
		<script type="text/javascript" src="http://jgen.googlecode.com/svn/branches/map-editor/scripts/html.js"></script>
		<script type="text/javascript" src="http://jgen.googlecode.com/svn/branches/map-editor/scripts/math.js"></script>
		<script type="text/javascript" src="http://jgen.googlecode.com/svn/branches/map-editor/scripts/map.js"></script>
		<script type="text/javascript" src="http://jgen.googlecode.com/svn/branches/map-editor/scripts/editor.js"></script>
		
		<script type="text/javascript">
			var TEngine = Class.create({
				callback: null,
				eventHandler: null,
				gameState: {
					height: 0,
					keys: {},
					mouse: {},
					metaKey: false
				},
				constructor: function(oViewPort, fCallback) {
					var oThis = this;
					this.viewPort = oViewPort;
					this.callback = fCallback;
					this.eventHandler = function(oEvent) {
						// update metakey state
						oThis.gameState.metaKey = oEvent.metaKey;
						if (oEvent.type == 'keydown') oThis.gameState.keys[oEvent.keyCode] = true;
						else if (oEvent.type == 'keyup') oThis.gameState.keys[oEvent.keyCode] = false;
						else if (oEvent.type == 'mousedown') oThis.gameState.mouse.down = true;
						else if (oEvent.type == 'mouseup') oThis.gameState.mouse.down = false;
						else if (oEvent.type == 'mousemove') {
							oThis.gameState.mouse.x = (oEvent.clientX - oThis.viewPort.offsetLeft);
							oThis.gameState.mouse.y = (oEvent.clientY - oThis.viewPort.offsetTop);
						}
					};
				},
				start: function(oViewPort) {
					var oThis = this;
					document.addEventListener('keydown', this.eventHandler, false);
					document.addEventListener('keyup', this.eventHandler, false);
					this.viewPort.addEventListener('mousemove', this.eventHandler, false);
					this.viewPort.addEventListener('mousedown', this.eventHandler, false);
					this.viewPort.addEventListener('mouseup', this.eventHandler, false);
					window.top.testInterval = function() {
						oThis.callback.call(oThis, oThis.gameState);
					}
					for (var c = 0; c < 1; c++) {
						setInterval(window.top.testInterval, 0);
					}
				}
			});
			
		</script>
		
		<script type="text/javascript">
			function start() {
				oEditor = new TEditor();
				oEditor.loadLibrary('http://jgen.googlecode.com/svn/branches/map-editor/library/library.xml', function() {
					
					this.renderPalette(document.querySelector('.leftColumn'));
					this.renderWorkspace(document.querySelector('.viewPort'));
					
					var iHeight = 0;
					var iScrollX = iNewScrollX = 0;
					var iScrollY = iNewScrollY = 0;
					var iCaptureX = iCaptureY = -1;
					
					window.addEventListener('resize', function() {
						oEditor.map.initViewPort(oEditor.map.viewPort.offsetWidth, oEditor.map.viewPort.offsetHeight);
						oEditor.renderMap(iScrollX, iScrollY);
					}, false);
						
					var iSecond = (new Date()).getSeconds();
					var iCounter = 0;
					var oFPSWindow = document.querySelector('.fpsWindow');
						
					(new TEngine(oEditor.map.viewPort.parentNode, function(oGameState) {
						
						iCounter++;
						
						var aCursorPos = oEditor.map.screen2map(
							oGameState.mouse.x,
							oGameState.mouse.y,
							iScrollX,
							iScrollY
						);
						
						
						/*
						var aTilePos = oEditor.map.map2screen(
							aCursorPos[0],
							aCursorPos[1]
						);
						
						oEditor.cursor.setStyle({
							'left': (aTilePos[0] + 'px'),
							'top': (aTilePos[1] + 'px')
						});
						*/
						
						if (oGameState.mouse.down) {
							if ((oGameState.metaKey) && (iCaptureX == -1) && (iCaptureY == -1)) {
								iCaptureX = oGameState.mouse.x + iScrollX;
								iCaptureY = oGameState.mouse.y + iScrollY;
							} else if (oGameState.metaKey) {
								iNewScrollX = (iCaptureX - oGameState.mouse.x);
								iNewScrollY = (iCaptureY - oGameState.mouse.y);
								if ((iNewScrollX != iScrollX) || (iNewScrollY != iScrollY)) {
									oEditor.renderMap(iNewScrollX, iNewScrollY);
									iScrollX = iNewScrollX;
									iScrollY = iNewScrollY;
								}
							} else if (oEditor.selectedObject) {
								
								var sIndex = aCursorPos[1] + '.' + aCursorPos[0];
								var sBrush = oEditor.selectedObject.name;
								if (!oEditor.map.tiles[sBrush]) {
									oEditor.map.tiles[sBrush] = oEditor.map.createTile(
										oEditor.selectedObject.src,
										oEditor.selectedObject.width,
										oEditor.selectedObject.height
									);
								}
								
								oEditor.map.objects[sIndex] = (oEditor.selectedObject.name);
								if (oEditor.map.mapData[sIndex]) {
									oEditor.map.mapData[sIndex].parentNode.removeChild(oEditor.map.mapData[sIndex]);
									delete(oEditor.map.mapData[sIndex]);
								}
								
								oEditor.renderMap(iScrollX, iScrollY);
								
								console.info(oEditor.map.tiles);
							}
						} else {  
							iCaptureX = -1;
							iCaptureY = -1;
						}
						
						var iNewSecond = (new Date()).getSeconds();
						if (iNewSecond != iSecond) {
							iSecond = iNewSecond;
							oFPSWindow.innerHTML = 'FPS: ' + iCounter;
							iCounter = 0;
						}
					
					})).start();
				});
			}
			
			function saveFileDialogInit() {
				document.querySelector('.saveFileDialog object').addEventListener('onsave', function() {
					return {
						'data': oEditor.saveMapData(),
						'filename': 'map.xml'
					};
				}.toString());
			}
			
			function openFileDialogInit() {
				document.querySelector('.openFileDialog object').addEventListener('onload', function(sData) {
					oEditor.loadMapData(window.atob(sData));
				}.toString());
			}
			
		</script>
	</head>
	<body onload="start();">
		<div class="toolbar">
			
			<div class="toolbarButton toolbarButtonLeft openFileDialog">
				<object>
					<param name="movie" value="scripts/fsutils.swf" />
					<param name="allowScriptAccess" value="sameDomain" />
					<param name="FlashVars" value="onload=openFileDialogInit&dialogType=open&fileFilter=*.xml" />
					<param name="wmode" value="transparent" />
				</object>
				<div>Load Map...</div>
			</div>
			
			<div class="toolbarButton toolbarButtonLeft saveFileDialog">
				<object>
					<param name="movie" value="scripts/fsutils.swf" />
					<param name="allowScriptAccess" value="sameDomain" />
					<param name="FlashVars" value="onload=saveFileDialogInit&dialogType=save" />
					<param name="wmode" value="transparent" />
				</object>
				<div>Save Map...</div>
			</div>
			
			<div class="toolbarButton toolbarButtonRight hideGrid">Hide Grid</div>
			<div class="toolbarButton toolbarButtonRight showGrid">Show Grid</div>
			
		</div>
		<div class="leftColumn"></div>
		<div class="viewPort">
			<div class="fpsWindow"></div>
		</div>
	</body>
</html>
