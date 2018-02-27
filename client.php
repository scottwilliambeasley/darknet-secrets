<!doctype html>
<!---------------------------------------------------------------------------
  Basic client script using JQUERY:AJAX to retrieve database secret entries 
---------------------------------------------------------------------------->
<html lang="en">
    <head>
        <!-- Required bootstrap meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Bootswatch CSS and custom CSS -->
        <link rel="stylesheet" href="bootstrap.min.css">
        <link rel="stylesheet" href="client.css">

        <title>Random Secrets from the Deep Web</title>
    </head>
<!-------------------------------------------------------------------------
   1) Create some html content that can be accessed by jquery
-------------------------------------------------------------------------->
    <body class="">
        <div class="container">
            <h2 style="text-align:center">Random Secrets from the Deep Web </h2>

            <div class="row"><!-- beginning of row -->
                <div class="table-responsive">
                    <table class="table table-bordered table-dark table-hover">
                        <thead></thead>
                        <tbody>
                            <tr>
                                <td id="up_votes"></td>
                                <td id="down_votes"></td>
                                <td id="date_created"></td>
                                <td id="secretId"></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div><!-- end of row -->

            <div class="row"><!-- beginning of row -->
                <div class="table-responsive">
                    <table id="secretTable" class="table table-bordered table-dark  table-hover">
                        <tr>
                            <th>Secret</th>
                        </tr>
                        <tr>
                            <td id="secret"></td>
                        </tr>
                    </table>
                </div>
            </div><!-- end of row -->

            <div class="row"><!-- beginning of row -->
                <div class="table-responsive">
                    <table class="table table-striped table-dark table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th width="75%">Comment</th>
                                <th>Date Created</th>
                            </tr>
                        </thead>
                        <tbody id="commentTable"></tbody>
                    </table>
                </div>
            </div><!-- end of row -->

        </div><!-- beginning of container -->
    </body>
    <!--bootstrap and dependencies -->
    <script language="javascript" type="text/javascript" src="jquery.js"></script>
    <script src="https://npmcdn.com/tether@1.2.4/dist/js/tether.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script id="source" language="javascript" type="text/javascript">
        
        
    $(function() {
//-----------------------------------------------------------------------
// 2) Request secret followed by comments , by way of AJAX http://api.jquery.com/jQuery.ajax/
//-----------------------------------------------------------------------
        $.ajax({
            url: 'api.php', //the script to call to get data          
            data: "", //you can insert url argumnets here to pass to api.php
            //for example "id=5&parent=6"
            dataType: 'json', //data format      
            success: function(data) //on recieve of reply

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
                $('#secretId').html("<b>Submission ID: </b></br>" + secretId);
                $('#up_votes').html("<b>Upvotes: </b></br>" + up_votes);
                $('#down_votes').html("<b>Downvotes: </b></br>" + down_votes);
                $('#date_created').html("<b>Date Created: </b></br>" + date_created);

//--------------------------------------------------------------------
// 5) Dynamically update comment table content
//--------------------------------------------------------------------
                var commentTable = document.getElementById("commentTable");

                for (var i = 1; i < data.length; i++) {

                    var commentNumber = i;
                    var comment = data[i]['comment'];
                    var commentDate = data[i]['date_created'];

                    var commentTr = document.createElement('tr');

                    var commentNumberTd = document.createElement('td');
                    commentNumberTd.setAttribute("id", "comment_number_" + i);

                    var commentTd = document.createElement('td');
                    commentTd.setAttribute("id", "comment_" + i);
                    commentTd.setAttribute("width", "width=75%");

                    var commentDateTd = document.createElement('td');
                    commentDateTd.setAttribute("id", "comment_" + i + "_date");

                    commentTable.appendChild(commentTr);

                    commentTr.appendChild(commentNumberTd);
                    commentTr.appendChild(commentTd);
                    commentTr.appendChild(commentDateTd);

                    $('#comment_number_' + i).html(commentNumber);
                    $('#comment_' + i).html(comment);
                    $('#comment_' + i + '_date').html(commentDate);

                }

            }
        });
    });

    
    </script>
</html>

