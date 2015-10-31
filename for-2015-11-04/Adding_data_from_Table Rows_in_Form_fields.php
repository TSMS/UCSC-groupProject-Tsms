<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8" />
<title>Data from HTML Table Rows in Form fields</title>
<style type="text/css">
#t_id {
  margin: 1% auto;
}
#t_id, #t_id td {
  border: 1px solid #333;
  padding: 1px;
}
#t_id .edit_row {
  background: #fbfb01;
  font-weight: 700;
  cursor: pointer;
}

#edit_form {
  display: none;
  position: relative;
  margin: 1% auto;
  width: 20em;
  background: #f8f9fb;
  text-align: center;
}
#cls_f {
  position: absolute;
  top: -4px;
  right: -4px;
  background: #fbfb01;
  border: 2px solid #e00;
  border-radius: .4em;
  padding: 2px;
  font-size: 14px;
  font-weight: 700;
  cursor: pointer;
}
</style>
</head>
<body>

<table id="t_id">
<tbody>
  <tr>
    <th>Edit</th>
    <th>WebSite</th>
    <th>Title</th>
    <th>Description</th>
  </tr>
  <tr>
    <td class="edit_row">&#x2710;</td>
    <td class="row_s">http://coursesweb.net/</td>
    <td class="row_t">Courses WebDevelopment</td>
    <td class="row_d">Free WebDevelopment courses, Games ...</td>
  </tr>
  <tr>
    <td class="edit_row">&#x2710;</td>
    <td class="row_s">http://www.marplo.net/</td>
    <td class="row_t">MarPlo.net - Free Courses</td>
    <td class="row_d">Free Courses, Games, Spirituality</td>
  </tr>
  <tr>
    <td class="edit_row">&#x2710;</td>
    <td class="row_s">http://php.net/</td>
    <td class="row_t">PHP Programming</td>
    <td class="row_d">PHP Programming language</td>
  </tr>
</tbody></table>

<form action="#" method="post" id="edit_form">
  Website: <input type="text" name="e_site" id="e_site" /><br/>
  Title: <input type="text" name="e_title" id="e_title" /><br/>
  Description: <input type="text" name="e_desc" id="e_desc" /><br/>
  <input type="submit" value="Send" />
  <span id="cls_f">X</span>
</form>

<script>
// JavaScript script from: http://coursesweb.net/javascript/

// gets all the .edit_row cells, registers click to each one
var edit_row = document.querySelectorAll('#t_id .edit_row');
for(var i=0; i<edit_row.length; i++) {
  edit_row[i].addEventListener('click', function(e){
    // get parent row, add data from its cells in form fields
    var tr_parent = this.parentNode;
    document.getElementById('e_site').value = tr_parent.querySelector('.row_s').innerHTML;
    document.getElementById('e_title').value = tr_parent.querySelector('.row_t').innerHTML;
    document.getElementById('e_desc').value = tr_parent.querySelector('.row_d').innerHTML;

    // display the form, and focus on a form field
    document.getElementById('edit_form').style.display = 'block';
    document.getElementById('e_site').focus();
  }, false);
}

// to hide #edit_form when click on #cls_f button
document.getElementById('cls_f').addEventListener('click', function(){ this.parentNode.style.display = 'none';}, false);
</script>
</body>
</html>