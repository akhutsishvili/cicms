<html>
    <head>
        <title>CMS</title>
        <script src="<?php echo base_url()?>script/jquery-1.10.2.min.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>script/underscore-min.js"></script>
<script src="<?php echo base_url();?>script/cms.js"></scipt>

        <script type="text/javascript" src="<?php echo base_url() ?>script/plugins/ckeditor/ckeditor.js"></script>
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">

        <!-- Optional theme -->
        <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap-theme.min.css">
        <link rel="stylesheet" href="<?php echo base_url() ?>style/cms.css">
        <!-- Latest compiled and minified JavaScript -->
        <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>



        <meta charset="UTF-8"/>
    </head>

    <body baseurl="<?php echo base_url();?>">
        <div role="navigation" class="navbar navbar-inverse navbar-fixed-top">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button data-target=".navbar-collapse" data-toggle="collapse" class="navbar-toggle" type="button">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a href="#" class="navbar-brand">CMS</a>
                </div>
                <div class="navbar-collapse collapse">
                    <ul class="nav navbar-nav navbar-right">
                        <li>
                            <?php echo anchor('user/logout','გამოსვლა <span class="glyphicon glyphicon-off"></span>')?>
                        </li>
<!--                         <li>
                            <a href="#">Settings</a>
                        </li>
                        <li>
                            <a href="#">Profile</a>
                        </li>
                        <li>
                            <a href="#">Help</a>
                        </li> -->
                    </ul>
<!--                     <form class="navbar-form navbar-right">
                        <input type="text" placeholder="Search..." class="form-control">
                    </form> -->
                </div>
            </div>
        </div>

        <!-- end navbar -->
        <div class="container-fluid">
            <div class="row">


