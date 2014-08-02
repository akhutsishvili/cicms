<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
    <h1 class="page-header well" >
        <?php
        echo anchor('cms/view/' . $table_name, '<span class="glyphicon glyphicon-chevron-left"></span> ');
        echo $table_label['label'];
        ?>
    </h1>
    <div class="panel panel-default">
        <div class="panel-heading">
            ფილტრაცია
        </div>
        <div class="panel-body">
            <?php
            echo form_open_multipart('cms/update/' . $table_name);
            echo $input_forms;
            echo form_upload('userfile', NULL, 'class="btn btn-default"');
            echo "<br/><div><div class='btn btn-primary btn-lg' id='add-file-form' ><span class='glyphicon glyphicon-plus'></span>"
            . " ფაილის დამატება</div></div><br/>";
            echo form_submit('', "დადასტურება", "class='btn btn-primary btn-lg pull-right'") . "<br clear='all'/>";
            ?>
        </div>
        <div class="row">
            <?php echo $image_list; ?>
        </div>


    </div>

</div>
