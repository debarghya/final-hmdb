<?php

function index(){
?>
<table id="home">
<tr>
<td><img src="template/images/5be490f5017e23a866f5cdae85abb429_full.jpg" alt="" width="340" height="228"></td>
<td><p>
Missing children in India is a major issue which needs much more concerted and systematic
attention than it is getting at the moment. Based on State Police Records, it has been calculated
that every year more than 44,000 children are reported missing all over the country. Of these,
around 11,000 children remain untraced. The numbers can be much higher as, it has been
argued, that many cases of missing children may never be reported because families of these
children are from a marginalized background and may not have the access needed to report a
case of a missing child.

There is evidence to show that across a six year period, the all India trend of reported missing
children has grown by 12% and the percentage of untraced children has also gone up in this
period.
</p></td>
</tr>
<tr>
<td width="420px"><p>"Our Missing Children" maintains a database of missing and abducted children on behalf of law enforcement agencies who request our assistance.

The only children appearing on this website are those which the respective law enforcement authorities request OMC to circulate. Therefore, out of all of the children who go missing yearly, only a few hundred appear here.

There can be nothing more distressing for a parent than to know their child has gone missing. It is OMC's belief that all society must join forces to ensure that children do not go missing and if they do then all efforts must be put into finding them.</p></td>
<td><img src="template/images/child2.jpg" alt="" width="340" height="228"></td>
</tr>
<tr>
<td><img src="template/images/indiangirl.jpg" alt="" width="340" height="228"></td>
<td></td>
</tr>
<tr>
<td></td>
<td><img src="template/images/12indiaink-otherindia-child1-blog480.jpg" alt="" width="340" height="228"></td>
</tr>
</table>

<?php
}

function login(){
echo '<fieldset>
<legend>Login From</legend>
<form action="index.php" method="POST">
USERNAME:<br><input type="text" name="username"  /><br>
PASSWORD:<br/><input type="password" type="password" /><br>
<br><input type="submit" name="submit" value="submit" />
</form>
</fieldset>';
}