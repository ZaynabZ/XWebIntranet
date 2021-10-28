

<?php $__env->startSection('content'); ?>

<div class="row">
    
    <div class="col-lg-12 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">Les Demandes</h4>
          <h6>Nombre d'éléments trouvés: <?php echo e(count($demandes)); ?></h6>
          <div class="table-responsive" style="overflow: hidden;">
              <table class="table table-striped" width="100%" cellspacing="0" cellpadding="0">
                <thead>
                            <tr> 
                              <th>Date demande</th>
                              <th>Type</th>                              
                              <th></th>                              
                            </tr>
                          </thead>
                          <tbody>
                              <?php $__currentLoopData = $demandes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $demande): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>                              
                              <td><?php echo e($demande->pivot->created_at->format('j F, Y')); ?></td> 
                              <td><?php echo e($demande->type_demande); ?></td>
                              <td>
                                <form action="<?php echo e(url('/demande_realisee')); ?>/<?php echo e($demande->id); ?>/<?php echo e($demande->pivot->user_id); ?>" method="POST"> 
                                        <?php echo csrf_field(); ?>
                                        <input hidden value="<?php echo e($demande->pivot->id); ?>" name="id" />
                                        <button class="btn btn-primary btn-sm ml-2" type="submit">Marquer comme réalisée</button>
                                        </form> 
                                </td> 
                              
                              
                              
                                    
                                        
                                  </div>
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
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\AGENT\Documents\MyOpla\resources\views/superadmin/superadmin_demandes.blade.php ENDPATH**/ ?>