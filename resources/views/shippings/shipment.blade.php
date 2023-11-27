<html xmlns:v="urn:schemas-microsoft-com:vml"
xmlns:o="urn:schemas-microsoft-com:office:office"
xmlns:w="urn:schemas-microsoft-com:office:word"
xmlns:x="urn:schemas-microsoft-com:office:excel"
xmlns:m="http://schemas.microsoft.com/office/2004/12/omml"
xmlns="http://www.w3.org/TR/REC-html40">

<head>
<meta http-equiv=Content-Type content="text/html; charset=utf-8">
</head>

<body lang=ZH-TW style='tab-interval:24.0pt;text-justify-trim:punctuation'>

<div class=WordSection1 style='layout-grid:18.0pt'>

<table class=MsoTableGrid border=1 cellspacing=0 cellpadding=0
 style='border-collapse:collapse;border:none;mso-border-alt:solid windowtext .5pt;
 mso-yfti-tbllook:1184;mso-padding-alt:0cm 5.4pt 0cm 5.4pt'>
 <tr style='mso-yfti-irow:0;mso-yfti-firstrow:yes;height:57.75pt'>
  <td width=737 colspan=5 valign=top style='width:553.0pt;border:none;
  border-bottom:solid windowtext 1.0pt;mso-border-bottom-alt:solid windowtext .5pt;
  padding:0cm 5.4pt 0cm 5.4pt;height:57.75pt'>
  <p class=MsoNormal align=center style='text-align:center'><a
  name="RANGE!A1:E15"></a><span class=GramE><span style='mso-bookmark:"RANGE\!A1\:E15"'><span
  style='font-size:24.0pt;font-family:標楷體'>禾昌國際</span></span></span><span
  style='mso-bookmark:"RANGE\!A1\:E15"'><span style='font-size:24.0pt;
  font-family:標楷體'>事業股份有限公司出貨單</span></span><span style='mso-bookmark:"RANGE\!A1\:E15"'><span
  lang=EN-US style='font-family:標楷體'><span
  style='mso-spacerun:yes'>&nbsp;&nbsp;&nbsp;&nbsp; </span></span></span><span
  lang=EN-US style='font-family:標楷體'><o:p></o:p></span></p>
  <p class=MsoNormal align=center style='text-align:center'><span lang=EN-US
  style='font-family:標楷體'><span
  style='mso-spacerun:yes'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  </span><span
  style='mso-spacerun:yes'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><span
  style='mso-spacerun:yes'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></span><span
  style='font-family:標楷體'>訂單編號<span lang=EN-US>:<o:p>{{ $order->id }}</o:p></span></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:1;height:39.75pt'>
  <td width=132 valign=top style='width:99.0pt;border:solid windowtext 1.0pt;
  border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  padding:0cm 5.4pt 0cm 5.4pt;height:39.75pt'>
  <p class=MsoNormal><span style='font-family:標楷體'>客戶編號<span lang=EN-US><o:p></o:p></span></span></p>
  </td>
  <td width=137 valign=top style='width:103.0pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:39.75pt'>
  <p class=MsoNormal><span style='font-family:標楷體'>　<span lang=EN-US><o:p>{{ $order->customer->id }}</o:p></span></span></p>
  </td>
  <td width=105 valign=top style='width:79.0pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:39.75pt'>
  <p class=MsoNormal><span style='font-family:標楷體'>客戶名稱<span lang=EN-US><o:p></o:p></span></span></p>
  </td>
  <td width=155 valign=top style='width:116.0pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:39.75pt'>{{ $order->name }}</td>
  <td width=208 valign=top style='width:156.0pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:39.75pt'>
  <p class=MsoNormal><span style='font-family:標楷體'>出貨日期<span lang=EN-US>:<o:p></o:p></span></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:2;height:39.75pt'>
  <td width=132 valign=top style='width:99.0pt;border:solid windowtext 1.0pt;
  border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  padding:0cm 5.4pt 0cm 5.4pt;height:39.75pt'>
  <p class=MsoNormal><span style='font-family:標楷體'>電話<span lang=EN-US><o:p></o:p></span></span></p>
  </td>
  <td width=137 valign=top style='width:103.0pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:39.75pt'>
  <p class=MsoNormal><span style='font-family:標楷體'>　<span lang=EN-US><o:p>{{ $order->phone }}</o:p></span></span></p>
  </td>
  <td width=468 colspan=3 valign=top style='width:351.0pt;border-top:none;
  border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:39.75pt'>
  <p class=MsoNormal><span lang=EN-US style='font-family:標楷體'>□</span><span
  style='font-family:標楷體'>代理商<span lang=EN-US><span
  style='mso-spacerun:yes'>&nbsp;&nbsp;&nbsp; </span>□</span>經銷商<span
  lang=EN-US><span style='mso-spacerun:yes'>&nbsp;&nbsp;&nbsp; </span>□</span>一般用戶<span
  lang=EN-US><o:p></o:p></span></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:3;height:39.75pt'>
  <td width=132 valign=top style='width:99.0pt;border:solid windowtext 1.0pt;
  border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  padding:0cm 5.4pt 0cm 5.4pt;height:39.75pt'>
  <p class=MsoNormal><span style='font-family:標楷體'>地址<span lang=EN-US><o:p></o:p></span></span></p>
  </td>
  <td width=605 colspan=4 valign=top style='width:454.0pt;border-top:none;
  border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:39.75pt'>
  <p class=MsoNormal><span style='font-family:標楷體'>　<span lang=EN-US><o:p>{{ $order->address }}</o:p></span></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:4;height:23.25pt'>
  <td width=132 valign=top style='width:99.0pt;border:solid windowtext 1.0pt;
  border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  padding:0cm 5.4pt 0cm 5.4pt;height:23.25pt'>
  <p class=MsoNormal><span style='font-family:標楷體'>品名<span lang=EN-US><o:p></o:p></span></span></p>
  </td>
  <td width=137 valign=top style='width:103.0pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:23.25pt'>
  <p class=MsoNormal><span style='font-family:標楷體'>主機機器序號<span lang=EN-US><o:p></o:p></span></span></p>
  </td>
  <td width=105 valign=top style='width:79.0pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:23.25pt'>
  <p class=MsoNormal><span style='font-family:標楷體'>數量<span lang=EN-US><o:p></o:p></span></span></p>
  </td>
  <td width=155 valign=top style='width:116.0pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:23.25pt'>
  <p class=MsoNormal><span style='font-family:標楷體'>單價<span lang=EN-US><o:p></o:p></span></span></p>
  </td>
  <td width=208 valign=top style='width:156.0pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:23.25pt'>
  <p class=MsoNormal><span style='font-family:標楷體'>備註<span lang=EN-US><o:p></o:p></span></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:5;height:38.15pt'>
  <td width=132 valign=top style='width:99.0pt;border:solid windowtext 1.0pt;
  border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  padding:0cm 5.4pt 0cm 5.4pt;height:38.15pt'>{{ $order->product->name."(".$order->product->model.")" }}</td>
  <td width=137 valign=top style='width:103.0pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:38.15pt'>
  <p class=MsoNormal><span style='font-family:標楷體'>　<span lang=EN-US><o:p>SN: </o:p></span></span></p>
  </td>
  <td width=105 nowrap valign=top style='width:79.0pt;border-top:none;
  border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:38.15pt'>
  <p class=MsoNormal><span style='font-family:標楷體'>　<span lang=EN-US><o:p>1</o:p></span></span></p>
  </td>
  <td width=155 valign=top style='width:116.0pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:38.15pt'>
  <p class=MsoNormal><span style='font-family:標楷體'>　<span lang=EN-US><o:p> NT$</o:p></span></span></p>
  </td>
  <td width=208 valign=top style='width:156.0pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:38.15pt'>
  <p class=MsoNormal><span style='font-family:標楷體'>　<span lang=EN-US><o:p>memo</o:p></span></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:6;height:39.75pt'>
  <td width=132 valign=top style='width:99.0pt;border:solid windowtext 1.0pt;
  border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  padding:0cm 5.4pt 0cm 5.4pt;height:39.75pt'>
  <p class=MsoNormal><span style='font-family:標楷體'>
{{ ($order->product->accessory) ? $order->product->accessory->name.'('.$order->product->accessory->model.')' : null }}</p>
  </td>
  <td width=137 valign=top style='width:103.0pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:39.75pt'>
  <p class=MsoNormal><span style='font-family:標楷體'>　<span lang=EN-US><o:p>SN: </o:p></span></span></p>
  </td>
  <td width=105 nowrap valign=top style='width:79.0pt;border-top:none;
  border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:39.75pt'>
  <p class=MsoNormal><span style='font-family:標楷體'>　<span lang=EN-US><o:p>1</o:p></span></span></p>
  </td>
  <td width=155 valign=top style='width:116.0pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:39.75pt'>
  <p class=MsoNormal><span style='font-family:標楷體'>　<span lang=EN-US><o:p>NT$ 0</o:p></span></span></p>
  </td>
  <td width=208 valign=top style='width:156.0pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:39.75pt'>
  <p class=MsoNormal><span style='font-family:標楷體'>　<span lang=EN-US><o:p>memo</o:p></span></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:7;height:43.5pt'>
  <td width=132 valign=top style='width:99.0pt;border:solid windowtext 1.0pt;
  border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  padding:0cm 5.4pt 0cm 5.4pt;height:43.5pt'>
  <p class=MsoNormal><span style='font-family:標楷體'>{{ ($order->extras[0]) ? $order->extras[0]->product->name.'('.$order->extras[0]->product->model.')' : '' }}</p>
  </td>
  <td width=137 valign=top style='width:103.0pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:43.5pt'>
  <p class=MsoNormal><span style='font-family:標楷體'>　<span lang=EN-US><o:p>SN: </o:p></span></span></p>
  </td>
  <td width=105 valign=top style='width:79.0pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:43.5pt'>
  <p class=MsoNormal><span style='font-family:標楷體'>　<span lang=EN-US><o:p>1</o:p></span></span></p>
  </td>
  <td width=155 valign=top style='width:116.0pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:43.5pt'>
  <p class=MsoNormal><span style='font-family:標楷體'>　<span lang=EN-US><o:p> NT$ 0</o:p></span></span></p>
  </td>
  <td width=208 valign=top style='width:156.0pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:43.5pt'>
  <p class=MsoNormal><span style='font-family:標楷體'>　<span lang=EN-US><o:p>memo</o:p></span></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:8;height:38.25pt'>
  <td width=269 colspan=2 valign=top style='width:202.0pt;border:solid windowtext 1.0pt;
  border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  padding:0cm 5.4pt 0cm 5.4pt;height:38.25pt'>
  <p class=MsoNormal align=right style='text-align:right'><span
  style='font-family:標楷體'>小計未稅<span lang=EN-US><o:p></o:p></span></span></p>
  </td>
  <td width=260 colspan=2 valign=top style='width:195.0pt;border-top:none;
  border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:38.25pt'>
  <p class=MsoNormal><span style='font-family:標楷體'>　<span lang=EN-US><o:p></o:p></span></span></p>
  </td>
  <td width=208 valign=top style='width:156.0pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:38.25pt'>
  <p class=MsoNormal><span style='font-family:標楷體'>　<span lang=EN-US><o:p></o:p></span></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:9;height:39.75pt'>
  <td width=269 colspan=2 valign=top style='width:202.0pt;border:solid windowtext 1.0pt;
  border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  padding:0cm 5.4pt 0cm 5.4pt;height:39.75pt'>
  <p class=MsoNormal align=right style='text-align:right'><span
  style='font-family:標楷體'>稅金<span lang=EN-US>5%<o:p></o:p></span></span></p>
  </td>
  <td width=260 colspan=2 valign=top style='width:195.0pt;border-top:none;
  border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:39.75pt'>
  <p class=MsoNormal><span style='font-family:標楷體'>　<span lang=EN-US><o:p></o:p></span></span></p>
  </td>
  <td width=208 valign=top style='width:156.0pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:39.75pt'>
  <p class=MsoNormal><span style='font-family:標楷體'>　<span lang=EN-US><o:p></o:p></span></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:10;height:48.75pt'>
  <td width=269 colspan=2 valign=top style='width:202.0pt;border:solid windowtext 1.0pt;
  border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  padding:0cm 5.4pt 0cm 5.4pt;height:48.75pt'>
  <p class=MsoNormal align=right style='text-align:right'><span
  style='font-family:標楷體'>合計<span lang=EN-US><o:p></o:p></span></span></p>
  </td>
  <td width=260 colspan=2 valign=top style='width:195.0pt;border-top:none;
  border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:48.75pt'>
  <p class=MsoNormal><span style='font-family:標楷體'>　<span lang=EN-US><o:p></o:p></span></span></p>
  </td>
  <td width=208 valign=top style='width:156.0pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:48.75pt'>
  <p class=MsoNormal><span style='font-family:標楷體'>　<span lang=EN-US><o:p></o:p></span></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:11;height:133.9pt'>
  <td width=132 valign=top style='width:99.0pt;border:solid windowtext 1.0pt;
  border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  padding:0cm 5.4pt 0cm 5.4pt;height:133.9pt'>
  <p class=MsoNormal><span style='font-family:標楷體'>備註事項<span lang=EN-US><o:p></o:p></span></span></p>
  </td>
  <td width=605 colspan=4 valign=top style='width:454.0pt;border-top:none;
  border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:133.9pt'>
  <p class=MsoNormal><span style='font-family:標楷體'>　<span lang=EN-US><o:p></o:p></span></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:12;height:23.25pt'>
  <td width=375 colspan=3 valign=top style='width:281.0pt;border:solid windowtext 1.0pt;
  border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  padding:0cm 5.4pt 0cm 5.4pt;height:23.25pt'>
  <p class=MsoNormal><span style='font-family:標楷體'>承辦人員<span lang=EN-US><o:p></o:p></span></span></p>
  </td>
  <td width=363 nowrap colspan=2 valign=top style='width:272.0pt;border-top:
  none;border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:23.25pt'>
  <p class=MsoNormal><span style='font-family:標楷體'>客戶簽名<span lang=EN-US><o:p></o:p></span></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:13;height:15.75pt'>
  <td width=132 valign=top style='width:99.0pt;border:solid windowtext 1.0pt;
  border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  padding:0cm 5.4pt 0cm 5.4pt;height:15.75pt'>
  <p class=MsoNormal><span style='font-family:標楷體'>倉管<span lang=EN-US><o:p></o:p></span></span></p>
  </td>
  <td width=137 valign=top style='width:103.0pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:15.75pt'>
  <p class=MsoNormal><span lang=EN-US style='font-family:標楷體'>QC<o:p></o:p></span></p>
  </td>
  <td width=105 valign=top style='width:79.0pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:15.75pt'>
  <p class=MsoNormal><span style='font-family:標楷體'>領<span lang=EN-US>(</span>送<span
  lang=EN-US>)</span>貨<span lang=EN-US><o:p></o:p></span></span></p>
  </td>
  <td width=363 colspan=2 valign=top style='width:272.0pt;border:none;
  border-right:solid windowtext 1.0pt;mso-border-top-alt:solid windowtext .5pt;
  mso-border-left-alt:solid windowtext .5pt;mso-border-top-alt:solid windowtext .5pt;
  mso-border-left-alt:solid windowtext .5pt;mso-border-right-alt:solid windowtext .5pt;
  padding:0cm 5.4pt 0cm 5.4pt;height:15.75pt'>
  <p class=MsoNormal><span style='font-family:標楷體'>　<span lang=EN-US><o:p></o:p></span></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:14;mso-yfti-lastrow:yes;height:64.5pt'>
  <td width=132 nowrap valign=top style='width:99.0pt;border:solid windowtext 1.0pt;
  border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  padding:0cm 5.4pt 0cm 5.4pt;height:64.5pt'>
  <p class=MsoNormal><span style='font-family:標楷體'>　<span lang=EN-US><o:p></o:p></span></span></p>
  </td>
  <td width=137 nowrap valign=top style='width:103.0pt;border-top:none;
  border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:64.5pt'>
  <p class=MsoNormal><span style='font-family:標楷體'>　<span lang=EN-US><o:p></o:p></span></span></p>
  </td>
  <td width=105 nowrap valign=top style='width:79.0pt;border-top:none;
  border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:64.5pt'>
  <p class=MsoNormal><span style='font-family:標楷體'>　<span lang=EN-US><o:p></o:p></span></span></p>
  </td>
  <td width=363 nowrap colspan=2 valign=top style='width:272.0pt;border-top:
  none;border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-left-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-bottom-alt:solid windowtext .5pt;mso-border-right-alt:solid windowtext .5pt;
  padding:0cm 5.4pt 0cm 5.4pt;height:64.5pt'>
  <p class=MsoNormal><span style='font-family:標楷體'>　<span lang=EN-US><o:p></o:p></span></span></p>
  </td>
 </tr>
</table>

<p class=MsoNormal><span lang=EN-US style='font-family:標楷體'><o:p>&nbsp;</o:p></span></p>

</div>

</body>

</html>
