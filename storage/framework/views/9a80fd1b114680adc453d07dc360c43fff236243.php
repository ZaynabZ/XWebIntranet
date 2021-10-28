

<?php $__env->startSection('content'); ?>


<!-- Messages section -->
<?php if(Session::get('success') || count($errors) > 0): ?>
  <div class="row">
    
    <div class="col-12 grid-margin stretch-card">
      <?php if($message = Session::get('success')): ?>
        <div class="alert alert-success alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong><?php echo e($message); ?></strong>
        </div>
      <?php endif; ?>
                
      <?php if(count($errors) > 0): ?>
        <div class="alert alert-danger">
          <strong>Whoops!</strong> probleme d'insertion .
          <ul>
            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <li><?php echo e($error); ?></li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </ul>
        </div>
      <?php endif; ?>
    </div>  
  </div>
<?php endif; ?>
<!-- End of messages section -->

<div class="row" id="app">
  <div class="col-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">Chercher un Candidat</h4>       
        <div class="search-wrapper panel-heading col-sm-12">
          <input class="form-control" type="text" v-model="searchQuery" placeholder="Chercher" />
        </div>  
        
        <!-- En cas d'erreur -->
        <section v-if="errored">
                <p>Nous sommes désolés, nous ne sommes pas en mesure de récupérer ces informations pour le moment. Veuillez réessayer ultérieurement.</p>
        </section>
        <!-- Fin cas d'erreur -->

        <!-- Liste des candidats -->
        <div class="modal-body row mt-5">
            <div class="col-md-12">
                <div class="page-header text-center">
                    <h2>Liste des Candidats</h2>
                </div>
                <div v-if="loading">Chargement...</div>
                <div class="list-group" >
                    <div v-if ="item.includes('.pdf')" v-for="item in resultQuery" :key="item"  class="list-group-item" >
                        <a v-bind:href="'/cv_pdf/'+item" >{% item %}</a>
                        <button class="btn btn-danger  float-right ml-2 active" @click="deleteFile(item, $event)"> Delete </button>
                    </div>

                    <div v-if ="!item.includes('.pdf')" v-for="item in resultQuery" :key="item"  class="list-group-item" >
                        <a v-bind:href="'/cv_img/'+item" >{% item %}</a>
                        <button class="btn btn-danger  float-right ml-2 active" @click="deleteFile(item, $event)" > Delete </button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Fin liste des candidats -->

           
      </div>
    </div>
  </div>



  <!-- Formulaire de téléchargement de CV -->
  <div class="col-12 grid-margin stretch-card">
        <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Formulaire Candidature</h4>
                  <p class="card-description">
                    Détails du candidat
                  </p>
                  <form class="forms-sample" method="POST" action="<?php echo e(route('CV_upload_post')); ?>" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <div class="form-group">
                      <label for="nom">Nom</label>
                      <input type="text" class="form-control" 
                              id="nom" name="nom_candidat" placeholder="Nom"
                              autocomplete="off">
                    </div>
                    <div class="form-group">
                      <label for="prenom">Prénom</label>
                      <input type="text" class="form-control" 
                              id="prenom" name="prenom_candidat" placeholder="Prénom"
                              autocomplete="off">
                    </div>
                    
                    <div class="form-group">
                      <label>CV upload</label>                    
                        <div class="row">            
                            <div class="col-md-12">
                                <input type="file" name="cv_file" class="form-control file-upload-info">                                                                
                            </div>
                        </div>
                    </div>
                    
                    
                    <button type="submit" class="btn btn-primary mr-2">Submit</button>
                    <button class="btn btn-light">Cancel</button>
                  </form>
                </div>
        </div>
  </div>
  <!-- Fin Formulaire de téléchargement de CV -->
</div>

 
<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
<script type="text/javascript" language="javascript" src="https://cdn.jsdelivr.net/npm/vue@2.6.12/dist/vue.js"></script>
<script type="text/javascript" language="javascript" src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script> 
<script>
        new Vue({
        delimiters: ['{%', '%}'],
        el: '#app',
        data () {
            return {
            searchQuery: "",
            items: null,
            loading: true,
            errored: false,

            }
        },
        methods :{
            deleteFile : function(item , event) {
            event.preventDefault() // it prevent from page reload
            axios.delete('/delete_cv/'+item)
                .then(response => {
                location.reload();
                }).catch(error => {
                            console.log(error)
                        }); 
        }
        },
        mounted () {
            axios
            .get('/cvs_display')
            .then(response => (this.items = response.data.cv_emplacements)).catch(error => {
                            console.log(error)
                            this.errored = true
                        })
                        .finally(() => this.loading = false)
        },
        computed: {
            resultQuery(){
            if(this.searchQuery){
            return this.items.filter((c)=>{
                return this.searchQuery.toLowerCase().split(' ').every(v => c.toLowerCase().includes(v))
            })
            }else{
                return this.items;
            }
            }
         },
        })
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\AGENT\Documents\MyOpla\resources\views/admin/candidatures.blade.php ENDPATH**/ ?>