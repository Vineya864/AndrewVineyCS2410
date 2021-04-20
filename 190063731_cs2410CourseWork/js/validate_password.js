



function validate_pass(pass){
	
  var minimum_length = 8;
  var errors = [];
  if(!pass.match(/[a-z]/))
    errors.push("Lower case letters required, ");
  if(!pass.match(/[A-Z]/))
    errors.push("Upper case letter required, ");
  if(!pass.match(/[0-9]/))
    errors.push("Number required, "); 
if(pass.length<minimum_length)
    errors.push("Too short, minimum of 8 characters ");


  return errors;
}


