

<?php $__env->startSection('content'); ?>
<div class="row">
  <?php if($message = Session::get('success')): ?>
    <div class="alert alert-success">
      <button type="button" class="close" data-dismiss="alert">×</button>
      <strong><?php echo e($message); ?></strong>
    </div>
  <?php endif; ?>
</div>
<div class="row">
  <div class="col-lg-2"></div>
  <div class="col-lg-8 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">Profile</h4>
          <div class="table-responsive">
            <table class="table">
              <tr>
                <th>Nom Complet</th>
                <th><?php echo e($user->first_name); ?> <?php echo e($user->last_name); ?></th>
              </tr>
              <tr>
                <th>Nom d'utilisateur</th>
                <th><?php echo e($user->username); ?></th>
              </tr>                      
              <tr>
                <th>Email</th>
                <th><?php echo e($user->email); ?></th>                          
              </tr>
              <tr>
                <th>Sexe</th>
                <?php if($user->gender == 'F'): ?>
                  <th>Féminin</th>
                <?php else: ?>
                  <th>Masculin</th>
                <?php endif; ?>  
              </tr>
              <tr>
                <th>Role</th>
                  <th><?php echo e($user->role->role_name); ?></th>
                
              </tr>
              <tr>
                <th>Service</th>
                <th><?php echo e($user->service->name ?? '***'); ?></th>
              </tr>
            </table>
          </div>
      </div>
    </div>
  <div class="col-lg-2"></div>
</div>


<div class="row mb-4">
  <div class="col-md-12">
    <?php if(Route::has('password.request')): ?>
      <a class="btn btn-primary font-weight-medium auth-form-btn" href="<?php echo e(route('password.request')); ?>">Réinitialiser le mot de passe</a>
    <?php endif; ?>
  </div>
  
</div>


<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\AGENT\Documents\MyOpla\resources\views/profile.blade.php ENDPATH**/ ?>