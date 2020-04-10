<?php $__env->startSection('content'); ?>
<div class="container-fluid app-body">
	<h3>Recent Post sent to Buffer

	




	</h3>

	<div class="row">
		<div class="col-md-12">
			<div class="row">
				<form method="GET" action="<?php echo e(route('search_by_date')); ?>">
					<div class="col-md-4">
						<input type="date" class="form-control" name="search_by_date">
						<button type="submit" class="btn btn-primary">
							Search
							<i class="fas fa-sync"></i>
						</button>
					</div>
				</form>
				<form action="<?php echo e(route('filter_by_group')); ?>" method="get">
					<div class="col-md-4">
						<select class="form-control" name="fileds">
							<option value="">All Group</option>
							<?php $__currentLoopData = $groups; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $group): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<option value="<?php echo e($group->type); ?>"><?php echo e($group->type); ?></option>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						</select>
						<button type="submit" class="btn btn-primary">
							Search
							<i class="fas fa-sync"></i>
						</button>
	
					</div>
				</form>

				<form action="<?php echo e(route('search_data')); ?>" method="get">
					<div class="col-md-4">
						
						<input type="text" class="form-control" name="search_data" placeholder="Search">

						<button type="submit" class="btn btn-primary">
							Search
							<i class="fas fa-sync"></i>
						</button>
					</div>
				</form>

				
			</div>
			<table class="table table-hover social-accounts"> 
				<thead> 
                    <tr>
                        <th>Group Name</th> 
                        <th>Group Type</th>
                        <th>Accout Name</th>
                        <th>Post Text</th>
                        <th>Time</th>
                    </tr> 
				</thead> 
				<tbody> 
				<?php $__currentLoopData = $bufferPosts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $bufferPost): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<tr>
						<td>
                            <?php echo e($bufferPost->groupInfo['name']); ?>

                        </td>
                        <td>
                            <?php echo e($bufferPost->groupInfo['type']); ?>

                        </td>
                        <td>
							<div class="media">
								<div class="media-left">
									<a href="">
										<span class="fa fa-<?php echo e($bufferPost->accountInfo['type']); ?>"></span>
										<img width="50" class="media-object img-circle" src="<?php echo e($bufferPost->accountInfo['avatar']); ?>" alt="">
									</a>
								</div>
							</div>
						</td> 
					
						 
						<td>
                            
                            <?php echo e(strlen($bufferPost->post_text) > 10 ? substr($bufferPost->post_text,0,10)."..." : $bufferPost->post_text); ?>

                        </td>
                        <td>
                            <?php echo e(date('d M Y h:i A', strtotime($bufferPost->sent_at))); ?>

						</td>
                    </tr>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					
				</tbody> 
				
			</table>
			<div class="row">
				<?php echo e($bufferPosts->links()); ?>

			</div>
		</div>
	</div>
</div>
<?php $__env->stopSection(); ?>



<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>