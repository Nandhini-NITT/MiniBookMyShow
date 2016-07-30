
function isAvailable()
{
	$.ajax({
				url:'checkAvailability.php',
				complete:function(xhr,status)
				{
					booked=$.parseJSON(xhr.responseText);
					for(var i=33;i<48;i++)
					$("#"+i).unbind().click(function() {
							BookSeats(this.id);
							});
					$('td').css("background-color","green");
					for (var i=0;i<booked.length;i++)
					{
						if(booked[i]<64)
						{
							document.getElementById(booked[i]).style.backgroundColor="red";
						}
					}		
				},
			});
}

function BookSeats(id)
{
	var booking_status=1;
	if(document.getElementById(id).style.backgroundColor=="red")
		booking_status=0;
	$.ajax({
				url:'bookSeats.php',
				data:{"id":id,"booking_status":booking_status},
				complete:function(xhr,status)
				{
					if(booking_status==0)
						alert("Booking Cancelled");
					else
						alert("Booked seat");
					isAvailable();
				},
			});
}

function createSeats()
{
	var k=1;
	for(var i=0;i<4;i++)
	{
		$('#quadrant1').append("<tr>");
		for(var j=0;j<4;j++)
		{
		$('#quadrant1').append("<td id='"+k+"'>"+(k)+"</td>");
		k++;
		}
		$('#quadrant1').append("</tr>");
	}
	for(var i=0;i<4;i++)
	{
		$('#quadrant2').append("<tr>");
		for(var j=0;j<4;j++)
		{
		$('#quadrant2').append("<td id='"+k+"'>"+(k)+"</td>");
		k++;
		}
		$('#quadrant2').append("</tr>");
	}
	for(var i=0;i<4;i++)
	{
		$('#quadrant3').append("<tr>");
		for(var j=0;j<4;j++)
		{
		$('#quadrant3').append("<td id='"+k+"'>"+(k)+"</td>");
		k++;
		}
		$('#quadrant3').append("</tr>");
	}
	for(var i=0;i<4;i++)
	{
		$('#quadrant4').append("<tr>");
		for(var j=0;j<4;j++)
		{
		$('#quadrant4').append("<td id='"+k+"'>"+(k)+"</td>");
		k++;
		}
		$('#quadrant4').append("</tr>");
	}
	$("#quadrant4").unbind().click(function() {
							alert("You dont have permission to book this seat");
							});
	$("#quadrant2").unbind().click(function() {
							alert("You dont have permission to book this seat");
							});
	$("#quadrant1").unbind().click(function() {
							alert("You dont have permission to book this seat");
							});
		
isAvailable();
	}
window.onload=function()
{
	setInterval(updateDb,50000);
}
function updateDb()
{
	$.ajax({
				url:'updateDb.php',
				complete:function(xhr,status)
				{
					isAvailable();
				},
				
				
			});
}
