<div id="hidden-inputs">
  <input id="table-name-input" type="hidden" value="<?php echo $table_name;?>"/>
</div>
<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
    <h1 class="page-header well pager" >
        <?php
        echo $table_label['label'];
        ?>
    </h1>
    <div class="panel panel-default">
        <div class="panel-heading">
            ფილტრაცია
        </div>
        <div id="view-filters" class="panel-body">
            <?php
            echo $filters;
            echo "<br clear='all'/>";
            echo "<button id='view-filter-btn' class='btn btn-default pull-right'><span class='glyphicon glyphicon-filter'></span> გაფილტრვა</button>";
            ?>
        </div>
    </div>


    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="sub-header"> &nbsp;
                <?php
                $new_entry_button = '<button class="btn btn-default"><span class="glyphicon glyphicon-plus"></span> ჩანაწერის დამატება</button>';

if($this->utils_m->column_attr('tables',$table_name , 'row_lock') != true)
                echo anchor('cms/form/' . $table_name, $new_entry_button, 'class="pull-right"');
                ?>
            </h4>


        </div>
        <div class="panel-body">
            <div class="table-responsive" >
                <div id="view-table">
                    <?php echo $table_data;?>
                </div>
                <ul class="pager">
                    <li><a class="previous">Previous</a></li>
                    <li><a class="next">Next</a></li>
                </ul>

            </div>
        </div></div>

<script type="text/javascript">

</script>

</div>
