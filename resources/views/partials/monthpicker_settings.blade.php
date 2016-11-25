<script type="text/javascript">
options = {
    pattern: 'yyyy-mm', // Default is 'mm/yyyy' and separator char is not mandatory
    selectedYear: 2014,
    
    startYear: <?php echo date('Y', strtotime('-4Years')); ?>,
    finalYear: <?php echo date('Y', strtotime('+4Years')); ?>,
    monthNames: ['Ian', 'Feb', 'Mar', 'Apr', 'Mai', 'Iun', 'Iul', 'Aug', 'Sep', 'Oct', 'Noi', 'Dec']
};

$('#luna').monthpicker(options);
</script>