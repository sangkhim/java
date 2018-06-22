<!DOCTYPE html>
<html lang="en">
  <head>
  
  	<#include "../blocks/head.ftl">
  	
  </head>

  <body>

    <div class="container">
    
  	  <#include "../blocks/header.ftl">      

	  <#include "../views/" + pageName + ".ftl">      

      <#include "../blocks/footer.ftl">

    </div> <!-- /container -->

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="ie10-viewport-bug-workaround.js"></script>
    
  </body>
</html>
