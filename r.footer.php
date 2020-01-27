<?php
?>

    <script src="<?=RSITE;?>js/jquery.min.js"></script>
    <script src="<?=RSITE;?>js/bootstrap.min.js"></script>
    <script src="<?=RSITE;?>js/jquery.dcjqaccordion.2.7.js" class="include" type="text/javascript" ></script>
    <script src="<?=RSITE;?>js/jquery.scrollTo.min.js"></script>
    <script src="<?=RSITE;?>js/common-scripts.js"></script>
    <script src="<?=RSITE;?>js/jquery.tablesorter.combined.js"></script>
    <script src="<?=RSITE;?>js/jquery.tablesorter.pager.js"></script>
    <script src="<?=RSITE;?>js/pager-custom-controls.js"></script>
    <script src="<?=RSITE;?>js/popper.min.js"></script>
    <script src="<?=RSITE;?>js/r.js"></script>
    <script type = "text/javascript">
        function active_deactive_user(val, id) {
            $.ajax ({
            type:'post',
            url:'change.php',
            data: {val:val,id:id},
            success: function(ret) {
                if(ret=='active') {
                $('#str'+id).html('active');
                } else {
                $('#str'+id).html('inactive');
                }
            }
            });
        }
    </script>

    </body>
</html>