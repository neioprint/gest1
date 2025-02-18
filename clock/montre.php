<html>
<head>
<title>jQuery thooClock Plugin</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href='https://fonts.googleapis.com/css?family=PT+Sans' rel='stylesheet' type='text/css'>
<link rel="stylesheet" media="screen" href="css/main.css"/>
<!--[if lt IE 9]>
<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->		
</head>
<body>
<div class="container">
	<div id="myclock"></div>
	<!-- <div id="alarm1" class="alarm"><a href="javascript:void(0)" id="turnOffAlarm">ALARM OFF</a></div> -->
</div>

<br/><br/>
<!-- <input type="text" id="altime" placeholder="hh:mm"/><br><br> -->
<!-- <a href="javascript:void(0)" id="set">set Alarm</a> -->

<script language="javascript" type="text/javascript" src="https://code.jquery.com/jquery-latest.min.js"></script> 
<script language="javascript" type="text/javascript" src="js/jquery.thooClock.js"></script>  
<script language="javascript">
	var intVal, myclock;

	$(window).resize(function(){
		window.location.reload()
	});

	$(document).ready(function(){

		var audioElement = new Audio("");

		//clock plugin constructor
		$('#myclock').thooClock({
			size:$(document).height()/5,
			sweepingMinutes:true,
			sweepingSeconds:false,
			onAlarm:function(){
				//all that happens onAlarm
				$('#alarm1').show();
				alarmBackground(0);
				//audio element just for alarm sound
				document.body.appendChild(audioElement);
				var canPlayType = audioElement.canPlayType("audio/ogg");
				if(canPlayType.match(/maybe|probably/i)) {
					audioElement.src = 'alarm.ogg';
				} else {
					audioElement.src = 'alarm.mp3';
				}
				// erst abspielen wenn genug vom mp3 geladen wurde
				audioElement.addEventListener('canplay', function() {
					audioElement.loop = true;
					audioElement.play();
				}, false);
			},
			showNumerals:true,
			brandText:'NEIO',
			brandText2:'Algeria',
			onEverySecond:function(){
				//callback that should be fired every second
				//console.log(new Date().getSeconds());
			},
			// alarmTime:'15:30',
			offAlarm:function(){
				$('#alarm1').hide();
				audioElement.pause();
				clearTimeout(intVal);
				$('body').css('background-color','#FCFCFC');
			}
		});

	});



	$('#turnOffAlarm').click(function(){
		$.fn.thooClock.clearAlarm();
	});


	$('#set').click(function(){
		var inp = $('#altime').val();
		$.fn.thooClock.setAlarm(inp);
	});

	
	function alarmBackground(y){
			var color;
			if(y===1){
				color = '#CC0000';
				y=0;
			}
			else{
				color = '#FCFCFC';
				y+=1;
			}
			$('body').css('background-color',color);
			intVal = setTimeout(function(){alarmBackground(y);},100);
	}
</script>

</body>
</html>