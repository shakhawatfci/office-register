<template>
	<div class="modal fade" id="updateFolder" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<!--Modal: Contact form-->
		<div class="modal-dialog cascading-modal" role="document">

			<!--Content-->
			<div class="modal-content">

				<!--Header-->
				<div class="modal-header pink darken-4 white-text">
					<h4 class="title">
						<i class="fa fa-folder-open"></i> Update folder</h4>
						<button type="button" class="close waves-effect waves-light" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">×</span>
						</button>
					</div>
					<!--Body-->
					<div class="modal-body">
						<form @submit.prevent="update()">
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
								<label for="materialFormNameModalEx1">folder Titel *</label>
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
									 <span v-else>Update</span>
									
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

			mixins : [Mixin],
			props : ['boxes'],

			data(){

				return{

					form : {
                        id : '',
						folder_name : '',
						box : '',
						description : ''

					},

					errors : null,

					submeting : false,

				}
			},
			created(){
                var _this = this;
                EventBus.$on('update-folder',function(id){
                  _this.form.id = id;
                  _this.getEditData(id);
                })

			},

		methods : {
		   getEditData(id){
             axios.get(base_url+'folder/'+id+'/edit')
             .then(response => {
             	this.form.folder_name = response.data.folder_name;
             	this.form.box = response.data.box_id;
             	this.form.description = response.data.description;
             })

		     },	

			update(){

           this.submeting = true;
           axios.put(base_url+'folder/'+this.form.id,this.form)
           .then(response => {

           	if(response.data.status === 'success'){
                EventBus.$emit('folder-created');
           		this.successMessage(response.data);
           		this.resetForm();
           		$('#updateFolder').modal('hide');               
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
       		id : '',
       		folder_name : '',
       		box : '',
       		descripion : ''
       	}
       	this.errors = null;




       }

   }

}
</script>