<?php
require_once('/headerMenu.php');
require_once('/footerMenu.php');
?>
  <div class="content-wrapper">
    <style media="screen">
      .bg1 {background-color: black; color: red;}
      .bg2 {background-color: red; color: black;}
      .bg3 {background-color: blue; color: yellow;}
      .bg4 {background-color: yellow; color: blue;}
    </style>
    <div class="row">
    <div class="col-xs-6 col-ms-6 col-md-6 col-lg-8 bg1">
      div 1
    </div>
    <div class="col-xs-6 col-ms-6 col-md-6 col-lg-4 bg2">
      div 2
    </div>
      </div>
      <div class="row">
      <div class="col-xs-6 col-ms-6 col-md-6 col-lg-4 offset-lg-2 bg3">
        div 1
      </div>
      <div class="col-xs-6 col-ms-6 col-md-6 col-lg-4 offset-lg-2 bg4">
        div 2
      </div>
        </div>
        <div class="row">
        <div class="col-xs-6 col-ms-6 col-md-6 col-lg-4 bg1">
          div 1
        </div>
        <div class="col-xs-6 col-ms-6 col-md-6 col-lg-8 bg2">
          div 2
        </div>
          </div>
          <div class="row">
          <div class="col-xs-6 col-ms-6 col-md-6 col-lg-4 bg3">
            div 1
          </div>
          <div class="col-xs-6 col-ms-6 col-md-6 col-lg-4 bg4">
            div 2
          </div>
          <div class="col-xs-6 col-ms-6 col-md-6 col-lg-4 bg3">
            div 3
          </div>
            </div>
    <!-- /.container-fluid-->
    <!-- /.content-wrapper-->
