<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo "$title"; ?> - Subhan Blog</title>
    <?php echo "$html_head"; ?>


</head>
<body>
    <div id="wrapper">
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <?php echo "$navigasi" ?>
            <?php echo "$sidebar" ?>
        </nav>
 

        <div id="page-wrapper">
            <?php echo "$konten" ?>
        </div>

         
    </div>
<?php 


 ?>

 

<script>
    $('.btn-tootltip').tooltip({
        selector: "[data-toggle=tooltip]",
        container: "body"
    });

     $(document).ready(function(){
        var base_url="<?php echo base_url() ?>"
         <?php echo "$jquery_file"; ?>
     });


</script>

</body>
</html>