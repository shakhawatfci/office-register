<template>
	<div class="modal fade" id="folderModal"  role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<!--Modal: Contact form-->
		<div class="modal-dialog cascading-modal" role="document">

			<!--Content-->
			<div class="modal-content">

				<!--Header-->
				<div class="modal-header pink darken-4 white-text">
					<h4 class="title">
						<i class="fa fa-box-open"></i> Create Folder</h4>
						<button type="button" class="close waves-effect waves-light" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">×</span>
						</button>
					</div>
					<!--Body-->
					<div class="modal-body">
						<form @submit.prevent="submit()">
							<div class="md-form form-sm" v-if="errors">
								<span class="text-danger" v-for="error in errors" >{{ error[0] }}<br></span>
							</div>
							<div class="md-form form-sm">
								<!-- <i class="fa fa-file-signature prefix"></i> -->
								
								<!-- <label for="materialFormNameModalEx1">Box Titel *</label> -->
								<select v-model="form.box" class="browser-default custom-select ">
									<option value="">Chose a box</option>
									<option v-for="(box,index) in boxes" :key="index" :value="box.id">{{ box.box_name }}</option>
					
								</select>
							</div>	

							<div class="md-form form-sm">
								<i class="fa fa-file-signature prefix"></i>
								<input v-model="form.folder_name" type="text" id="materialFormNameModalEx1" class="form-control form-control-sm">
								<label for="materialFormNameModalEx1">Folder Titel *</label>
							</div>


							<!-- Material textarea message -->
							<div class="md-form form-sm">
								<i class="fa fa-envelope-open-text prefix"></i>
								<textarea v-model="form.description" type="text" id="materialFormMessageModalEx1" class="md-textarea form-control"></textarea>
								<label for="materialFormMessageModalEx1">Note Or Description</label>
							</div>

							<div class="text-center mt-4 mb-2">
								<button class="btn btn-outline-pink btn-rounded  my-4 waves-effect z-depth-0">
									 <span v-if="submeting"><i class="fa fa-spinner fa-spin"></i></span>
									 <span v-else>Save </span>
									
								</button>
							</div>
						</form>


					</div>
				</div>
				<!--/.Content-->
			</div>
			<!--/Modal: Contact form-->
		</div>
	</template>

	<script type="text/javascript">
		import {EventBus} from '../../vue-asset';
		import Mixin from '../../mixin';

		export default{
            props : ['boxes'],
			mixins : [Mixin],

			data(){

				return{

					form : {

						box : '',
						folder_name : '',
						description : ''

					},

					errors : null,

					submeting : false,

				}
			},
			methods : {

				submit(){
           // for changing submit button text 
           this.submeting = true;
           axios.post(base_url+'folder',this.form)
           .then(response => {

           	if(response.data.status === 'success'){
                EventBus.$emit('folder-created');
           		this.successMessage(response.data);
           		this.resetForm();
           		$('#folderModal').modal('hide');               
           	  }
           	else{

           		this.successMessage(response.data);

           	}

           	this.submeting = false;

           })
           .catch(err => {

           	if (err.response.status == 422) {
           		this.errors = err.response.data.errors;
           		this.validationMessage();
           	} 
           	else{
           		this.successMessage(err);
           	}

           	this.submeting = false;

           })
       },


       resetForm(){

       	this.form = {
       		box : '',
       		folder_name : '',
       		descripion : ''
       	}
       	this.errors = null;




       }

   }

}
</script>