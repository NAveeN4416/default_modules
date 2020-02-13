$('#stat-1').sparkline('html',
	{
		type: 'bar',
		height: '100%',
		width: '100%',
		barColor: 'rgba(0,0,0,0.2)',
		borderColor: 'rgba(0,0,0,0.2)'
	}
);

$('#stat-productivity').sparkline('html',
	{
		type: 'bar',
		height: '100%',
		width: '100%',
		barColor: 'rgba(0,0,0,0.2)',
		borderColor: 'rgba(0,0,0,0.2)'
	}
);

$('#stat-2').sparkline('html', 
	{
		height: '100%',
		width: '100%',
		lineColor: 'rgba(255,255,255,0.5)',
		fillColor: 'rgba(0,0,0,0.2)', 
		minSpotColor: false,
		maxSpotColor: false,
		spotColor: '#fff',
		spotRadius: 3
	}
);

$('#stat-3').sparkline('html',
	{
		height: '100%',
		width: '100%',
		fillColor: false,
		lineColor: 'rgba(0,0,0,0.4)',
		lineWidth: 4,
		changeRangeMin: 0,
		chartRangeMax: 10
	}
);
$('#stat-3').sparkline([4,1,5,7,9,9,8,7,6,6,4,7,8,4,3,2,2,5,6,7], 
    {
    	height: '100%',
		width: '100%',
    	composite: true,
    	fillColor: false,
    	lineColor: 'rgba(0,0,0,0.2)',
    	lineWidth: 4,
    	changeRangeMin: 0,
    	chartRangeMax: 10
    }
);

var serverData = [], totalPoints = 100;
function getServerData() {
	if (serverData.length > 0) serverData = serverData.slice(1);
	while (serverData.length < totalPoints) {
		var prev = serverData.length > 0 ? serverData[serverData.length - 1] : 50, y = prev + Math.random() * 10 - 5;
		if (y < 0) y = 0;
		else if (y > 100) y = 100;
		serverData.push(y);
	}
	var res = [];
	for (var i = 0; i < serverData.length; ++i) res.push([i, serverData[i]])
	return res;
}

$("#stat-server").css("width", $("#stat-server").parent().width() + 30 + "px");


function update() {
/*
	serverPlot.setData([getServerData()]);
	serverPlot.draw();
	setTimeout(update, 100);
*/
}

update();

$(window).resize(function() {
	ServerChart();
});

function ServerChart() {
	$("#stat-server").css("width", $("#stat-server").parent().width() + "px");
	$("#stat-server").empty();
}