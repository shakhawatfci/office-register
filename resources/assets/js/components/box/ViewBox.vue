<template>
	<div class="row">
        <div class="col-md-6">
        	<div class="form-group">
        		<input @keyup="getData()" v-model="keyword" type="text" class="form-control" name="" placeholder="Search Box">
        	</div>
        </div> 
        <div class="col-md-12" v-if="!isLoading">
        	<div class="table-responsive">
			<table class="table   table-condensed">
				<thead >
					<tr>
						<th>Box Name</th>
						<th>Note</th>
						<th>Edit</th>
						<th>Delete</th>
					</tr>
				</thead>

				<tbody>
					<tr v-for="(box,index) in boxes.data" :key="index">
						<td>{{ box.box_name }}</td>
						<td>{{ box.description }}</td>
						<td><a @click.prevent="editBox(box.id)" class="btn-floating btn-primary" href="" data-toggle="modal" data-target="#updateBox"><i class="fa fa-pen"></i></a></td>
						<td><a @click.prevent="deleteBox(box.id)" class="btn-floating btn-danger" href=""><i class="fa fa-trash"></i></a></td>
					</tr>
				</tbody>
			</table>
		</div>
		<div class="wrap text-right">
			<pagination :pageData="boxes"></pagination>
		</div>
        </div>

        <div class="col-md-12 text-center" v-else>
        	<img :src="url+'img/loading.gif'">
        </div>

        <div class="col-md-12">
        	<update-box></update-box>
        </div>
		
		
	</div>
</template>

<script>
	import {EventBus} from '../../vue-asset';
	import Mixin from '../../mixin';
	import Pagination from '../pagination/Pagination.vue';
	import UpdateBox from './UpdateBox.vue';
	export default{
       mixins : [Mixin],
       components : {
        'pagination' : Pagination,
        'update-box' : UpdateBox
       },
       data(){
       	
       	return {
          
          keyword : '',
          boxes : [],
          isLoading : false,
          url : base_url

       	}
       },
       created(){

       	this.getData();
          
         var _this = this;
         EventBus.$on('box-created',() => {
            
            _this.getData();

         });

       },
       methods : {
       	getData(page = 1){
        this.isLoading = true;
        axios.get(base_url+'box-list?page='+page+'&keyword='+this.keyword)
        .then(response => {
          this.boxes = response.data;
          this.isLoading = false;
        });

       	},

      pageClicked(pageNo){
        var vm = this;
        vm.getData(pageNo);
      },

    deleteBox(id) {
      Swal.fire(
        {
          title: "Are you sure?",
          text: "You won't be able to revert this!",
          type: "warning",
          showCancelButton: true,
          confirmButtonColor: "#3085d6",
          cancelButtonColor: "#d33",
          confirmButtonText: "Yes, delete it!"
        },
        () => {}
      ).then(result => {
        if (result.value) {
          axios.delete(base_url + "box/" + id).then(res => {
            EventBus.$emit("box-created",);
            this.successMessage(res.data);
          });
        }
      });
    },

      editBox(id){
          
          EventBus.$emit('update-box',id);
     
       }

       }
	}
</script>