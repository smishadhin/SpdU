<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap 101 Template</title>

    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
    <link href="bootstrap-chosen.css" rel="stylesheet">




    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
    <p><br/></p>
    <div class="container">
      <div class="row">
        <div class="col-md-6">
          <h3>single Select</h3>
          <form>
              <select class="chosen-select">
                 <option>CSE</option>
                 <option>EEE</option>
                 <option>BBA</option>
                 <option>Software</option>
                 <option>Food Nutrition</option>
                 <option>Farmechy</option>
                 <option>ETE</option>
                 <option>Civil</option>
                 <option>Textile</option>
                 <option>Tourism</option>
              </select>
          </form>
        </div>
        <div class="col-md-6">
          <h3>Multiple Select</h3>
          <form>
              <select id="selectcode" multiple class="chosen-select">
                 <option>CSE112</option>
                 <option>MAT111</option>
                 <option>ENG113</option>
                 <option>PHY113</option>
                 <option>MAT121</option>
                 <option>CSE122</option>
                 <option>CSE123</option>
                 <option>PHY123</option>
                 <option>PHY124</option>
                 <option>ENG123</option>
                 <option>CSE131</option>
                 <option>CSE132</option>
                 <option>CSE133</option>
                 <option>CSE134</option>
                 <option>CSE135</option>
                 <option>MAT131</option>
                 <option>MAT211</option>
                 <option>CSE212</option>
                 <option>CSE213</option>
                 <option>CSE214</option>
                 <option>CSE215</option>
                 <option>GED201</option>
                 <option>CSE221</option>
                 <option>CSE222</option>
                 <option>STA133</option>
                 <option>CSE224</option>
                 <option>CSE225</option>
                 <option>CSE231</option>
                 <option>CSE232</option>
                 <option>CSE233</option>
                 <option>CSE234</option>
                 <option>CSE235</option>
                 <option>CSE311</option>
                 <option>CSE312</option>
                 <option>CSE313</option>
                 <option>CSE314</option>
                 <option>ECO314</option>
                 <option>CSE321</option>
                 <option>CSE322</option>
                 <option>CSE323</option>
                 <option>CSE324</option>
                 <option>ECO314</option>
                 <option>CSE421</option>
                 <option>CSE422</option>
                 <option>CSE423</option>
                 <option>CSE433</option>
                 <option>CSE499</option>

              </select>
              <br /><br />
              <div id="divResult"></div>
          </form>

        </div>
      </div>
    </div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <script src="chosen.jquery.js"></script>
    <script>
       $('.chosen-select').chosen();
    </script>
<script type="text/javascript">
$(document).ready(function(){
  $('#selectcode').change(function(){
    var selectedcode= $('#selectcode option:selected');
    if(selectedcode.length > 0)
    {
      var resultString = '';
      selectedcode.each(function(){
        resultString+='Selectedode is = ' + $(this).val() + '<br/>';
      });
      $('#divResult').html(resultString);
    }
  });
});

</script>

  </body>
</html>
