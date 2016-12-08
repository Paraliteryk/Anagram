
var minuta = 0;
var sekunda=0;

function odliczanie()
	{
		var txt = document.getElementById("pole").value;
		sekunda = sekunda + 1;
		
		if (sekunda==60)
		{
			sekunda =0;
			minuta = minuta + 1;
		}
		
		if(sekunda<10 && minuta<10)
		{
			document.getElementById("zegar").innerHTML = 
		"0" + minuta+":"+ "0" +sekunda;
		}
		else if(minuta<10)
		{
			document.getElementById("zegar").innerHTML = 
		"0" + minuta+":"+ sekunda;
		}
		
		else if( sekunda<10)
		{
			document.getElementById("zegar").innerHTML = 
		minuta+":"+ "0" +sekunda;
		}
		else{
			document.getElementById("zegar").innerHTML = 
		 minuta+":"+ sekunda;
		}
		 setTimeout("odliczanie()",1000);
	}