<table width="950"  border="0" align="center" cellpadding="10">
  <tr>
    <td><center><h1><a href='index.php'><font color='#666666' face='Arial, Helvetica, sans-serif'>sarGraphs</font></a></h1>
        <font color='#666666' face='Arial, Helvetica, sans-serif'>
                <b>Server Time: </b><?php system('date'); ?>
                <b>Uptime: </b><?php system("uptime | awk '{print $3,$4}'|sed 's/,//g'"); ?></font>
        <br>
        </center>
   </td>
  </tr>
</table>
