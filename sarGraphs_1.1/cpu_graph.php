<?php
// Pull in SAR data
$handle = fopen("datadir/cpu", "rb");
$ydata = array();
        while (!feof($handle)) {
                 $line=fgets($handle);

                //Validate Variable
                if ($line != NULL) {

                // Get Y Graph Data
                $part=explode(" ", $line);
                        if (!trim($part[2]) == '') {
                        $ydata[]=trim(100 -$part[2]);
                        }

                // Get X Graph Data
                $time=explode(":", $part[0]);
                        if (!trim($time[0]) == '') {
				if ( $count == $time[0] OR $next == $time[0] ) {
	                        	$xdata[]='';
					$count=$time[0];
				}else{
	                        	$xdata[]=trim($time[0]);
					$count=$time[0];
					$next=$time[0];
					$next++;
				}
                        }
                }
        }

  //Close the connection
  fclose($handle);

  // Standard inclusions
  include("pChart/src/pData.class");
  include("pChart/src/pChart.class");
  

  // Dataset definition
  $DataSet = new pData;
  $DataSet->AddPoint($ydata,"Serie1");
  $DataSet->AddPoint($xdata,"Serie3");
  $DataSet->AddSerie("Serie1");
  $DataSet->SetAbsciseLabelSerie("Serie3");
  $DataSet->SetSerieName("Incoming","Serie1");
  #$DataSet->SetYAxisName("Call duration");
  $DataSet->SetYAxisUnit("%");
  #$DataSet->SetXAxisFormat("date");

  // Initialise the graph   
  $Test = new pChart(900,225);
  $Test->setColorPalette(0,126,185,245);
  $Test->setFontProperties("Fonts/tahoma.ttf",8);
  $Test->setGraphArea(50,35,890,190);
  #$Test->drawFilledRoundedRectangle(7,7,450,223,5,240,240,240);
  #$Test->drawRoundedRectangle(5,5,450,225,5,230,230,230);
  $Test->drawGraphArea(255,255,255,FALSE);
  $Test->drawScale($DataSet->GetData(),$DataSet->GetDataDescription(),SCALE_NORMAL,150,150,150,TRUE,0,2);
  $Test->drawGrid(1,TRUE,240,240,240);
  #$Test->drawGrid(4,TRUE);
  
  // Draw the 0 line   
  $Test->setFontProperties("Fonts/tahoma.ttf",6);
  $Test->drawTreshold(0,143,55,72,TRUE,TRUE);
  
  // Draw the line graph
  $Test->drawLineGraph($DataSet->GetData(),$DataSet->GetDataDescription());
  $Test->drawPlotGraph($DataSet->GetData(),$DataSet->GetDataDescription(),1,0);
  
  // Finish the graph
  $Test->setFontProperties("Fonts/tahoma.ttf",8);
  #$Test->drawLegend(90,35,$DataSet->GetDataDescription(),255,255,255);
  $Test->setFontProperties("Fonts/tahoma.ttf",11);
  $Test->drawTitle(325,25,"CPU",150,150,150,585);
  $Test->Stroke();
?>
 
