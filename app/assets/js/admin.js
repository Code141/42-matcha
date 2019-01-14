window.addEventListener('load', function(){
	var del_buttons = document.getElementsByClassName('delete_user_button');
	for (let button of del_buttons)
	{
		button.addEventListener('click', function (e){
			e.preventDefault();
			if(confirm("You are about to delete all records of this user.\nThis action is irreversible.\nAre you sure you want to proceed?"))
				e.target.parentNode.submit();
		});
	}
});
