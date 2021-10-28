

<?php $__env->startSection('content'); ?>
<div class="row">
    
    <div class="col-lg-12 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">Liste des Utilisateurs</h4>
          <div class="table-responsive" style="overflow: hidden;">
              <table class="table table-striped" width="100%" cellspacing="0" cellpadding="0">
                <thead>
                            <tr>
                              <th>Matricule</th>
                              <th>Nom Complet</th>
                              <th>Email</th>
                              
                              <th>Rôle</th>
                              <th>Service</th>
                              <th></th>
                            </tr>
                          </thead>
                          <tbody>
                              <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                              <td><?php echo e($user->matricule ?? '***'); ?></td>
                              <td class="py-1">
                                <?php echo e($user->first_name); ?> <?php echo e($user->last_name); ?>

                              </td>
                             
                              <td><?php echo e($user->email); ?></td>
                                
                                   
                                                       
                                <td><?php echo e($user->role->role_name); ?></td>
                                <td>
                                      <?php echo e($user->service->name ?? '***'); ?>

                                </td>     
                              <td >
                                  <div class="btn-toolbar" role="group">
                                    <a href="<?php echo e(url('/edit_user')); ?>/<?php echo e($user->id); ?>" class="btn btn-success btn-sm mr-2"><i class="mdi mdi-lead-pencil"></i></a>
                                  <form action="<?php echo e(url('/delete_user')); ?>/<?php echo e($user->id); ?>" method="POST"> 
                                    <?php echo csrf_field(); ?>
                                    <button class="btn btn-danger btn-sm ml-2" type="submit"><i class="mdi mdi-delete"></i></button>
                                    </form>     
                                  </div>
                              </td>                         
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
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\AGENT\Documents\MyOpla\resources\views/admin/index.blade.php ENDPATH**/ ?>