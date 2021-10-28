

<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-md-3"></div>
    <div class="col-md-6 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Demande de Document</h4>
                  <p class="card-description">De quel document avez vous besoin?</p>
                  <form action="<?php echo e(route('demandes')); ?>" method="POST">
                      <?php echo csrf_field(); ?>
                    <div class="row">                      
                      <div class="col-md-8">
                        <div class="form-group">
                            <?php $__currentLoopData = $demandes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $demande): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input type="radio" class="form-check-input" 
                                    name="demande_id" id="demande_id" value="<?php echo e($demande->id); ?>">
                                    <?php echo e($demande->type_demande); ?>

                                </label>
                            </div> 
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                   
                        </div>
                      </div>
                      
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <button type="submit" class="btn btn-primary mr-2">Envoyer</button>
                            <a href="<?php echo e(route('home')); ?>" class="btn btn-light">Annuler</a>
                        </div>
                        
                    </div>
                  </form>
            </div>
                
        </div>
    </div>
    <div class="col-md-3"></div>
</div>

<div class="row">
    
    <div class="col-lg-12 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">Mes Demandes</h4>
          <h6>Nombre d'éléments trouvés: <?php echo e(count($user_demandes)); ?></h6>
          <div class="table-responsive" style="overflow: hidden;">
              <table class="table table-striped" width="100%" cellspacing="0" cellpadding="0">
                <thead>
                            <tr>                             
                              <th>Date demande</th>
                              <th>Type</th>                              
                              <th>Etat</th>                              
                            </tr>
                          </thead>
                          <tbody>
                              <?php $__currentLoopData = $user_demandes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user_demande): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                              
                              <td><?php echo e($user_demande->pivot->created_at->format('j F, Y')); ?></td>
                              
                              
                              
                             
                              <td><?php echo e($user_demande->type_demande); ?></td>
                                
                                   
                                                       
                                <td><?php echo e($user_demande->pivot->etat); ?></td>
                                                   
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
  </div>

              
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\AGENT\Documents\MyOpla\resources\views/demandes_form.blade.php ENDPATH**/ ?>