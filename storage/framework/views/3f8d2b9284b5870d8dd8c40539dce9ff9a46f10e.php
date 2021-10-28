

<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-lg-1 grid-margin "></div>
<div class="col-lg-10 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Liste des Services</h4>
                 
                  <div class="table-responsive">
                    <table class="table table-striped">
                      <thead>
                        <tr>
                          <th>
                            Service
                          </th>
                          <th>
                            Actions
                          </th>
                          
                        </tr>
                      </thead>
                      <tbody>
                          <?php $__currentLoopData = $services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                          <td class="py-1">
                            <?php echo e($service->name); ?>

                          </td>
                          <td >
                              <div class="btn-toolbar" role="group">
                                 <a href="<?php echo e(url('/edit_service')); ?>/<?php echo e($service->id); ?>" class="btn btn-success btn-sm mr-2"><i class="mdi mdi-lead-pencil"></i></a>
                               <form action="<?php echo e(url('/delete_service')); ?>/<?php echo e($service->id); ?>" method="POST"> 
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

            <div class="col-lg-1 grid-margin "></div>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\AGENT\Documents\MyOpla\resources\views/admin/services.blade.php ENDPATH**/ ?>