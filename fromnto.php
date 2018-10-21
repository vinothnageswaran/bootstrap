<?php
use dosamigos\datepicker\DateRangePicker;
?>
<?= $form->field($tour, 'date_from')->widget(DateRangePicker::className(), [
    'attributeTo' => 'date_to', 
    'form' => $form, // best for correct client validation
    'language' => 'es',
    'size' => 'lg',
    'clientOptions' => [
        'autoclose' => true,
        'format' => 'dd-M-yyyy'
    ]
]);?>