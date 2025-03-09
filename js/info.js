var request = new Request('../js/info.json');

  fetch(request).then(function(response) {
    return response.json();
	  
  }).then(function(json) {
	  let head = JSON.stringify(json.name);
	  let result_head = head.replace(/"/gi,"");
	  
	  let owner = JSON.stringify(json.owner);
	  let result_owner = owner.replace(/"/gi,"");
	  
      document.getElementById("demoI").innerHTML = result_head;
	
		  document.getElementById("demo").innerHTML = result_head;
	
	  
	  document.getElementById("zapati").innerHTML = result_owner;
  });  
