 <!-- Asegúrate de extender una plantilla base -->

<?php $__env->startSection('content'); ?> <!-- Abrimos la sección correctamente -->

<div id="app">
    <mapa-component></mapa-component>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/mapa/mapa.blade.php ENDPATH**/ ?>