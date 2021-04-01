

function GetErrors(error_list){
	var explain='The Password is Not Valid: \n';
	var i=0;
	while(i<error_list.length){
	explain= explain + error_list[i] + '\n';
	i++;
	}
	return explain;
}
window.onload=function(){
	var form = document.getElementById('sign-up');
	var pass= form.pass;
	var passwordC=form.passwordConfirm;
	
	var validate=function(){
		var error_list=validate_pass(pass.value);
	
		//if (passwordC.value != pass.value){
		//	passwordC.setCustomValidity('The Passwords Must Be The Same.');}
		if (error_list.length >= 1){	
			var problems= GetErrors(error_list);
		
			pass.setCustomValidity(problems);
		}
		else{
			pass.setCustomValidity('');
		}
		
  };
pass.onchange = validate;
passwordC.onchange = validate;
};