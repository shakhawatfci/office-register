export default {

	methods : {

		successMessage(data){
			Swal.fire({
				position: 'top-end',
				type: data.status,
				title: data.message,
				showConfirmButton: false,
				timer: 1500
			})
		},

		validationMessage(){

			Swal.fire("Oops", "please fill the form by correct data!", "error");
		}

	}


}