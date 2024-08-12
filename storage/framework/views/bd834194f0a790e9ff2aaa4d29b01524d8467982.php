<html xmlns:v="urn:schemas-microsoft-com:vml"
xmlns:o="urn:schemas-microsoft-com:office:office"
xmlns:w="urn:schemas-microsoft-com:office:word"
xmlns:m="http://schemas.microsoft.com/office/2004/12/omml"
xmlns="http://www.w3.org/TR/REC-html40">

<head>
<meta http-equiv=Content-Type content="text/html; charset=utf-8">
</head>

<style type="text/css">
    @font-face {
                 font-family: "DFKai";
                 src: url('<?php echo e(storage_path("fonts/MoeStandardKai.otf")); ?>') format('truetype');
                 font-style: normal;
              }
         body {
                tab-interval:24.0pt;
                text-justify-trim:punctuation;
                font-family: "DFKai";
              }
     .content {
                layout-grid:18.0pt;
              }
   .tableGrid {
                 margin-left:9.25pt;
                 border-collapse:collapse;
                 border:none;
                 padding:0cm 5.4pt 0cm 5.4pt;
              }
 .titleHeight {
                 height:57.75pt;
              }
   .dataField {
                 height:35pt;
                 border:solid 1px;
              }
         .tr2 {
                 height:23.75pt;
              }
         .tr3 {
                 height:100pt;
              }
         .tr5 {
                 height:15.75pt;
              }
         .tr6 {
                 height:64.35pt;
              }
  .titleField {
                 width:513.8pt;
                 border:none;
                 border-bottom:solid windowtext 1.0pt;
                 padding:0cm 5.4pt 0cm 5.4pt;
                 height:57.75pt;
                 text-align:center;
              }
         span {
                 font-family:標楷體;
              }
       .title {
                 font-size:24.0pt;
              }
     .orderNo {
                 padding-left: 10.0cm;
              }
     .padding {
                 padding:0cm 5.4pt 0cm 5.4pt;
                 text-align:center;
              }
          .c1 {
                 width:97.9pt;
                 border:solid windowtext 1.0pt;
                 border-top:none;
                 text-align:left;
              }
          .c2 {
                 width:98.85pt;
                 border-top:none;
                 border-left:none;
                 border-bottom:solid windowtext 1.0pt;
                 border-right:solid windowtext 1.0pt;
              }
          .c3 {
                 width:70.55pt;
                 border-top:none;
                 border-left:none;
                 border-bottom:solid windowtext 1.0pt;
                 border-right:solid windowtext 1.0pt;
                 text-align:left;
              }
          .c4 {
                 width:120.45pt;
                 border-top:none;
                 border-left:none;
                 border-bottom:solid windowtext 1.0pt;
                 border-right:solid windowtext 1.0pt;
                 text-align:left;
              }
          .c5 {
                 width:126.05pt;
                 border-top:none;
                 border-left:none;
                 border-bottom:solid windowtext 1.0pt;
                 border-right:solid windowtext 1.0pt;
                 text-align:left;
              }
          .c6 {
                 width:97.9pt;
                 border:solid windowtext 1.0pt;
                 border-top:none;
                 text-align:left;
              }
          .c7 {
                 width:98.85pt;
                 border-top:none;
                 border-left:none;
                 border-bottom:solid windowtext 1.0pt;
                 border-right:solid windowtext 1.0pt;
                 text-align:left;
              }
          .c8 {
                 width:317.05pt;
                 border-top:none;
                 border-left:none;
                 border-bottom:solid windowtext 1.0pt;
                 border-right:solid windowtext 1.0pt;
                 text-align:left;
              }
        .addr {
                 width:97.9pt;
                 border:solid windowtext 1.0pt;
                 text-align:left;
              }
     .address {
                 width:415.9pt;
                 border:solid windowtext 1.0pt;
                 border-right:solid windowtext 1.0pt;
                 text-align:left;
              }
        .prod {
                 width:97.9pt;
                 border:solid windowtext 1.0pt;
              }
        .sno  {
                 width:169.4pt;
                 border:solid windowtext 1.0pt;
              }
      .amount {
                 width:56.6pt;
                 border:solid windowtext 1.0pt;
              }
       .price {
                 width:63.85pt;
                 border:solid windowtext 1.0pt;
              }
      .remark {
                 width:126.05pt;
                 border:solid windowtext 1.0pt;
                 text-align:left;
              }
      .total1 {
                 width:196.75pt;
                 border:solid windowtext 1.0pt;
              }
   .total1val {
                 width:191.0pt;
                 border:solid windowtext 1.0pt;
              }
     .remark2 {
                 width:97.9pt;
                 border:solid windowtext 1.0pt;
              }
     .remarks {
                 width:415.9pt;
                 border:solid windowtext 1.0pt;
              }
         .c20 {
                 width:267.3pt;
                 border:solid windowtext 1.0pt;
              }
         .c21 {
                 width:246.5pt;
                 border:solid windowtext 1.0pt;
              }
         .pos1 {
                 width:97.9pt;
                 border:solid windowtext 1.0pt;
              }
         .pos2 {
                 width:98.85pt;
                 border:solid windowtext 1.0pt;
              }
         .pos3 {
                 width:70.55pt;
                 border:solid windowtext 1.0pt;
              }
         .c25 {
                 width:246.5pt;
                 border:solid windowtext 1.0pt;
              }
</style>
<body lang=ZH-TW>
  <div class="content" >
    <table class="tableGrid" border="1" cellspacing="0" cellpadding="0">
      <tr class="titleHeight">
        <td width="685" colspan="6" valign="top" class="titleField">
            <p><img src="/hplogo4.png" width="300"></p>
            <p><span class="title">禾昌國際事業股份有限公司出貨單</span></p>
            <p><span class="orderNo">訂單編號 : <?php echo e($order->id); ?></span></p></td>
      </tr>
      <tr class="tr2">
        <td width="131" class="c1 padding" ><p><span>客戶編號</span></p></td>
        <td width="132" class="c2 padding"><?php echo e($order->customer_id); ?></td>
        <td width="94"  class="c3 padding"><p><span>客戶名稱</span></p></td>
        <td width="161" colspan="2" class="c4 padding"><?php echo e($order->name); ?></td>
        <td width="168" class="c5 padding"><p><span>出貨日期 : <?php echo e(($order->shipping) ? $order->shipping->shipping_date : null); ?></span></p></td>
      </tr>
      <tr class="tr2">
        <td width="131" class="c6 padding"><p><span>電話</span></p></td>
        <td width="132" class="c7 padding"><?php echo e($order->phone); ?></td>
        <td width="423" colspan="4" class="c8 padding">
            <p><span lang=EN-US>□</span><span>代理商<span lang=EN-US><span style='mso-spacerun:yes'>&nbsp;&nbsp;&nbsp; </span>□</span>經銷商
               <span lang=EN-US><span style='mso-spacerun:yes'>&nbsp;&nbsp;&nbsp; </span>□</span>一般用戶
               <span lang=EN-US><o:p></o:p></span></span></p>
        </td>
      </tr>
       <tr class="tr2">
         <td width="131" class="addr padding"><p><span>地址</span></p></td>
         <td width="555" colspan="5" class="address padding"><?php echo e($order->address); ?></td>
       </tr>
       <tr class="tr2">
         <td width="131" class="prod padding" ><p><span>品名</span></p></td>
         <td width="226" colspan="2" class="sno padding"><p><span>主機機器序號</span></p></td>
         <td width="75" class="amount padding"><p><span>數量</span></p></td>
         <td width="85" class="price padding"><p><span>單價</span></p></td>
         <td width="168" class="remark padding"><p><span>備註</span></p></td>
       </tr>
       <tr class="dataField" id="product">
             <td width="131" class="prod padding" style="text-align:left">
                 <p><span><?php echo e($order->product->name.'('.$order->product->model.')'); ?></span></p>
             </td>
             <td width="226" colspan="2" class="sno padding"><p><span></span></p></td>
             <td width="75" class="amount padding"><p><span></span>1</p></td>
             <td width="85" class="price padding" style="text-align:right"><p><span><?php echo e("NTD ".$order->price); ?> </span></p></td>
             <td width="168" class="remark padding"><p><span></span></p></td>
       </tr>
       <tr class="dataField" id="accessory">
             <td width="131" class="prod padding" style="text-align:left">
               <p><span><?php echo e(($order->product->accessories > 0) ? $order->product->accessory->name.'('.$order->product->accessory->model.')' : null); ?></span></p>
             </td>
             <td width="226" colspan="2" class="sno padding"><p><span></span></p></td>
             <td width="75" class="amount padding"><p><span><?php echo e(($order->product->accessories > 0) ? "1" : null); ?></span></p></td>
             <td width="85" class="price padding" style="text-align:right"><p><span></span></p></td>
             <td width="168" class="remark padding"><p><?php echo e(($order->product->accessories > 0) ? __('shippings.accessories') : null); ?><span></span></p></td>
       </tr>
       <tr class="dataField" id="extra1">
             <td width="131" class="prod padding" style="text-align:left">
               <p><span>
                 <?php if(isset($order->extras[0]) && ($order->extras[0]->flow == App\Enums\FlowStatus::Shipping) ): ?>
                   <?php echo e($order->extras[0]->product->name.'('.$order->extras[0]->product->model.')'); ?>

                 <?php endif; ?>
               </span></p>
             </td>
             <td width="226" colspan="2" class="sno padding"><p><span></span></p></td>
             <td width="75" class="amount padding">
                <p><span>
                  <?php if(isset($order->extras[0]) && ($order->extras[0]->flow == App\Enums\FlowStatus::Shipping) ): ?>
                    <?php echo e("1"); ?>

                  <?php endif; ?>
                </span></p>
             </td>
             <td width="85" class="price padding" style="text-align:right"><p><span></span></p></td>
             <td width="168" class="remark padding">
                <p><span>
                  <?php if(isset($order->extras[0]) && ($order->extras[0]->flow == App\Enums\FlowStatus::Shipping) ): ?>
                    <?php echo e(__('shippings.extras')); ?>

                  <?php endif; ?>
                </span></p>
             </td>
       </tr>
       <tr class="dataField" id="extra2">
             <td width="131" class="prod padding" style="text-align:left">
               <p><span>
                 <?php if(isset($order->extras[1]) && ($order->extras[1]->flow == App\Enums\FlowStatus::Shipping) ): ?>
                   <?php echo e($order->extras[1]->product->name.'('.$order->extras[1]->product->model.')'); ?>

                 <?php endif; ?>
               </span></p>
             </td>
             <td width="226" colspan="2" class="sno padding"><p><span></span></p></td>
             <td width="75" class="amount padding">
                <p><span>
                  <?php if(isset($order->extras[1]) && ($order->extras[1]->flow == App\Enums\FlowStatus::Shipping) ): ?>
                    <?php echo e("1"); ?>

                  <?php endif; ?>
                </span></p>
             </td>
             <td width="85" class="price padding" style="text-align:right"><p><span></span></p></td>
             <td width="168" class="remark padding">
                <p><span>
                  <?php if(isset($order->extras[1]) && ($order->extras[1]->flow == App\Enums\FlowStatus::Shipping) ): ?>
                    <?php echo e(__('shippings.extras')); ?>

                  <?php endif; ?>
                </span></p>
             </td>
       </tr>
       <tr class="dataField" id="extra3">
             <td width="131" class="prod padding" style="text-align:left">
                 <?php if(isset($order->extras[2]) && ($order->extras[2]->flow == App\Enums\FlowStatus::Shipping) ): ?>
                   <?php echo e($order->extras[2]->product->name.'('.$order->extras[2]->product->model.')'); ?>

                 <?php endif; ?>
             </td>
             <td width="226" colspan="2" class="sno padding"><p><span></span></p></td>
             <td width="75" class="amount padding">
                <p><span>
                  <?php if(isset($order->extras[2]) && ($order->extras[2]->flow == App\Enums\FlowStatus::Shipping) ): ?>
                    <?php echo e("1"); ?>

                  <?php endif; ?>
                </span></p>
             </td>
             <td width="85" class="price padding" style="text-align:right"><p><span></span></p></td>
             <td width="168" class="remark padding">
                <p><span>
                  <?php if(isset($order->extras[2]) && ($order->extras[2]->flow == App\Enums\FlowStatus::Shipping) ): ?>
                    <?php echo e(__('shippings.extras')); ?>

                  <?php endif; ?>
                </span></p>
             </td>
       </tr>
       <tr class="dataField" id="extra4">
             <td width="131" class="prod padding" style="text-align:left">
                 <?php if(isset($order->extras[3]) && ($order->extras[3]->flow == App\Enums\FlowStatus::Shipping) ): ?>
                   <?php echo e($order->extras[3]->product->name.'('.$order->extras[3]->product->model.')'); ?>

                 <?php endif; ?>
             </td>
             <td width="226" colspan="2" class="sno padding"><p><span></span></p></td>
             <td width="75" class="amount padding">
                <p><span>
                  <?php if(isset($order->extras[3]) && ($order->extras[3]->flow == App\Enums\FlowStatus::Shipping) ): ?>
                    <?php echo e("1"); ?>

                  <?php endif; ?>
                </span></p>
             </td>
             <td width="85" class="price padding" style="text-align:right"><p><span></span></p></td>
             <td width="168" class="remark padding">
                <p><span>
                  <?php if(isset($order->extras[3]) && ($order->extras[3]->flow == App\Enums\FlowStatus::Shipping) ): ?>
                    <?php echo e(__('shippings.extras')); ?>

                  <?php endif; ?>
                </span></p>
             </td>
       </tr>
       <tr class="dataField" id="extra4">
             <td width="131" class="prod padding" style="text-align:left">
                 <?php if(isset($order->extras[4]) && ($order->extras[4]->flow == App\Enums\FlowStatus::Shipping) ): ?>
                   <?php echo e($order->extras[4]->product->name.'('.$order->extras[4]->product->model.')'); ?>

                 <?php endif; ?>
             </td>
             <td width="226" colspan="2" class="sno padding"><p><span></span></p></td>
             <td width="75" class="amount padding">
                <p><span>
                  <?php if(isset($order->extras[4]) && ($order->extras[4]->flow == App\Enums\FlowStatus::Shipping) ): ?>
                    <?php echo e("1"); ?>

                  <?php endif; ?>
                </span></p>
             </td>
             <td width="85" class="price padding" style="text-align:right"><p><span></span></p></td>
             <td width="168" class="remark padding">
                <p><span>
                  <?php if(isset($order->extras[4]) && ($order->extras[4]->flow == App\Enums\FlowStatus::Shipping) ): ?>
                    <?php echo e(__('shippings.extras')); ?>

                  <?php endif; ?>
                </span></p>
             </td>
       </tr>
       <tr class="dataField" id="extra4">
             <td width="131" class="prod padding" style="text-align:left">
                 <?php if(isset($order->extras[5]) && ($order->extras[5]->flow == App\Enums\FlowStatus::Shipping) ): ?>
                   <?php echo e($order->extras[5]->product->name.'('.$order->extras[5]->product->model.')'); ?>

                 <?php endif; ?>
             </td>
             <td width="226" colspan="2" class="sno padding"><p><span></span></p></td>
             <td width="75" class="amount padding">
                <p><span>
                  <?php if(isset($order->extras[5]) && ($order->extras[5]->flow == App\Enums\FlowStatus::Shipping) ): ?>
                    <?php echo e("1"); ?>

                  <?php endif; ?>
                </span></p>
             </td>
             <td width="85" class="price padding" style="text-align:right"><p><span></span></p></td>
             <td width="168" class="remark padding">
                <p><span>
                  <?php if(isset($order->extras[3]) && ($order->extras[3]->flow == App\Enums\FlowStatus::Shipping) ): ?>
                    <?php echo e(__('shippings.extras')); ?>

                  <?php endif; ?>
                </span></p>
             </td>
       </tr>
       <tr class="tr2">
         <td width="262" colspan="2" class="total1 padding"><p align="right" style='text-align:right'><span>運費基本安裝</span></p></td>
         <td width="255" colspan="3" class="total1val padding" style="text-align:right"><?php echo e('NTD '.$order->installation_fee); ?></td>
         <td width="168" class="remark"></td>
       </tr>
       <tr class="tr2">
         <td width="262" colspan="2" class="total1 padding"><p align="right" style='text-align:right'><span>合計</span></p></td>
         <td width="255" colspan="3" class="total1val padding"  style="text-align:right"><?php echo e("NTD ".($order->price+$order->installation_fee)); ?></td>
         <td width="168" class="remark"></td>
       </tr>
       <tr class="tr2">
         <td width="262" colspan="2" class="total1 padding"><p align="right" style='text-align:right'><span>璧掛安裝費</span></p></td>
         <td width="255" colspan="3" class="total1val padding"  style="text-align:right"></td>
         <td width="168" class="remark">依現場環境需求估價</td>
       </tr>
       <tr class="tr3">
         <td width="131" class="remark2 padding"><p><span>備註事項</span></p></td>
         <td width="555" colspan="5" class="remarks padding"><p align="right"><?php echo e(QrCode::size(100)->generate($qrdata)); ?></p></td>
       </tr>
       <tr class="tr2">
         <td width="356" colspan="3" class="c20 padding"><p><span>承辦人員</span></p></td>
         <td width="329" nowrap colspan="3" rowspan="2" class="c21 padding"><p><span>客戶簽名</span></p></td>
       </tr>
       <tr class="tr5">
         <td width="131" class="pos1 padding"><p><span>倉管</span></p></td>
         <td width="131" class="pos2 padding"><p><span>QC</span></p></td>
         <td width="94" class="pos3 padding"><p><span>領(送)貨</span></p></td>
       </tr>
       <tr class="tr6">
         <td width="131" nowrap class="pos1 padding"></td>
         <td width="132" nowrap class="pos2 padding"></td>
         <td width="94" nowrap class="pos3 padding"></td>
         <td width="329" nowrap colspan="3" class="c25 padding"></td>
       </tr>
    </table>
  </div>
</body>
</html>
<?php /**PATH /files/www/sales2/resources/views/shippings/shipment.blade.php ENDPATH**/ ?>