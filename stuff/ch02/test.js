var foo = function(x, func){
	return func(x/2);
}

function scripttest(){
	var bar = foo(42, function(x){
		return x * 2;
	});

	alert(bar);
}

function scripttest2(){

		for(var i = 0; i<4; i++){
			setTimeout(function(){
				alert(i);
			}, 1000);
		}
	
}
