<template>
	<div class="row">
        <div class="col-md-4">
          <div class="form-group">
            <input @keyup="getData()" v-model="keyword" type="text" class="form-control" name="" placeholder="Search Box">
          </div>
        </div>    

        <div class="col-md-4">
        	<div class="form-group">
        		  <select @change="getData()" v-model="box" class="browser-default custom-select ">
                  <option value="">Filter By Box</option>
                  <option v-for="(box,index) in boxes" :key="index" :value="box.id">{{ box.box_name }}</option>
          
                </select>
        	</div>
        </div> 
        <div class="col-md-12" v-if="!isLoading">
        	<div class="table-responsive">
			<table class="table   table-condensed">
				<thead >
					<tr>
            <th>Folder Name</th>
						<th>Box</th>
						<th>Note</th>
						<th>Edit</th>
						<th>Delete</th>
					</tr>
				</thead>

				<tbody>
					<tr v-for="(folder,index) in folders.data" :key="index">
            <td>{{ folder.folder_name }}</td>
						<td>{{ folder.box.box_name }}</td>
						<td>{{ folder.description }}</td>
						<td><a @click.prevent="editFolder(folder.id)" class="btn-floating btn-primary" href="" data-toggle="modal" data-target="#updateFolder"><i class="fa fa-pen"></i></a></td>
						<td><a @click.prevent="deleteBox(folder.id)" class="btn-floating btn-danger" href=""><i class="fa fa-trash"></i></a></td>
					</tr>
				</tbody>
			</table>
		</div>
		<div class="wrap text-right">
			<pagination :pageData="folders"></pagination>
		</div>
        </div>

        <div class="col-md-12 text-center" v-else>
        	<img :src="url+'img/loading.gif'">
        </div>

        <div class="col-md-12">
        	<update-folder :boxes="boxes"></update-folder>
        </div>
		
		
	</div>
</template>

<script>
	import {EventBus} from '../../vue-asset';
	import Mixin from '../../mixin';
	import Pagination from '../pagination/Pagination.vue';
	import UpdateFolder from './UpdateFolder.vue';
	export default{
       mixins : [Mixin],
       props : ['boxes'],
       components : {
        'pagination' : Pagination,
        'update-folder' : UpdateFolder
       },
       data(){
       	
       	return {
    
          keyword : '',
          box : '',
          folders : [],
          isLoading : false,
          url : base_url

       	}
       },
       created(){

       	this.getData();
          
         var _this = this;
         EventBus.$on('folder-created',() => {
            
            _this.getData();

         });

       },
       methods : {
       	getData(page = 1){
        this.isLoading = true;
        axios.get(base_url+'folder-list?page='+page+'&box='+this.box+'&keyword='+this.keyword)
        .then(response => {
          this.folders = response.data;
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
          axios.delete(base_url + "folder/" + id).then(res => {
            EventBus.$emit("folder-created",);
            this.successMessage(res.data);
          });
        }
      });
    },

      editFolder(id){
          
          EventBus.$emit('update-folder',id);
     
       }

       }
	}
</script>