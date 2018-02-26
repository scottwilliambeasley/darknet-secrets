<!---------------------------------------------------------------------------
  Example client script for JQUERY:AJAX -> PHP:MYSQL example
---------------------------------------------------------------------------->

<html>

    <head>
        <title>Random Secrets from the Deep Web</title>
        <link rel="stylesheet" href="client.css">
        <script language="javascript" type="text/javascript" src="jquery.js"></script>
    </head>
 <!-------------------------------------------------------------------------
   1) Create some html content that can be accessed by jquery
 -------------------------------------------------------------------------->
    <body>
    <center>
    <h2> Random Secrets from the Deep Web </h2>  

    <table id="secretTable">
        <tr>
            <th colspan="3">Secret</th>
        </tr>
        <tr>
            <td id="up_votes"></td>
            <td id="secret" rowspan="2" width="75%"></td>
            <td id="secretId"></td>
        </tr>
        <tr>
            <td id="down_votes"></td>
            <td id="date_created"></td>
        </tr>
    </table>
    
    </br></br>
    
    <table id="commentTable">
        <tr>
            <th>%</th>
            <th width="75%">Comment</th>
            <th>Date Created</th>
        </tr>
        
    </table>
  
    </center>
  </body>  
  <script id="source" language="javascript" type="text/javascript">

  $(function () 
  {
//-----------------------------------------------------------------------
// 2) Request secret followed by comments , by way of AJAX http://api.jquery.com/jQuery.ajax/
//-----------------------------------------------------------------------
    $.ajax({                                      
      url: 'api.php',                  //the script to call to get data          
      data: "",                        //you can insert url argumnets here to pass to api.php
                                       //for example "id=5&parent=6"
      dataType: 'json',                //data format      
      success: function(data)          //on recieve of reply

//--------------------------------------------------------------------
// 3) Set variables used to update secret content
//--------------------------------------------------------------------            
        {

        var secret = data[0]['secret'];
        var secretId = data[0]['id'];
        var up_votes = data[0]['up_votes'];
        var down_votes = data[0]['down_votes'];
        var date_created = data[0]['date_created'];

//--------------------------------------------------------------------
// 4) Update secret content
//--------------------------------------------------------------------
        $('#secret').html(secret);
        $('#secretId').html("<b>id: </b></br>"+secretId);
        $('#up_votes').html("<b>Upvotes: </b></br>"+up_votes);
        $('#down_votes').html("<b>Downvotes: </b></br>"+down_votes);
        $('#date_created').html("<b>Date Created: </b></br>"+date_created);        
       
//--------------------------------------------------------------------
// 5) Dynamically update comment table content
//--------------------------------------------------------------------
        var commentTable = document.getElementById("commentTable");

        for (var i = 1; i < data.length; i++ ) {
            
            var commentNumber = i ;
            var comment = data[i]['comment'];
            var commentDate = data[i]['date_created'];

            var commentTr = document.createElement('tr');

            var commentNumberTd = document.createElement('td');
                commentNumberTd.setAttribute("id", "comment_number_"+i);

            var commentTd = document.createElement('td');
                commentTd.setAttribute("id", "comment_"+i);
                commentTd.setAttribute("width", "width=75%");

            var commentDateTd = document.createElement('td');
                commentDateTd.setAttribute("id", "comment_"+i+"_date");
                
            commentTable.appendChild(commentTr);
            
            commentTr.appendChild(commentNumberTd);
            commentTr.appendChild(commentTd);
            commentTr.appendChild(commentDateTd);
                
            $('#comment_number_'+i).html(commentNumber);    
            $('#comment_'+i).html(comment);        
            $('#comment_'+i+'_date').html(commentDate);        
            
        }

        } 
    });
  }); 


</script>
</html>